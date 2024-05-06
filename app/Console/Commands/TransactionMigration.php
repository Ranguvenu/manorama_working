<?php

namespace App\Console\Commands;

use App\Models\DataMigrations\TmpTransactions;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Content\Courses;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\PackagePricing;
use App\Models\User;
use App\Models\Content\Enrollment;
use App\Models\Content\EnrollmentHasCourses;
use App\Models\Ecommerce\Batches;
use App\Models\Ecommerce\Packages;
use Illuminate\Support\Facades\Log;
use App\Services\Moodle\EnrollmentService;
use App\Models\DataMigrations\MigrationLogs;
use Illuminate\Support\Facades\DB;

class TransactionMigration extends Command
{
    private $client;
    public $service;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transaction-migration {transaction_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'transaction_id' => $this->argument('transaction_id'),
        ];

        $transaction = TmpTransactions::where('transaction_id', $data['transaction_id'])->first();

        $this->info("Import Process Started ".$transaction->transaction_id);
        $this->client = new Client(['http_errors' => false, 'verify' => false]);
        $payload = [];

        $token = '3I563ghDI5V';
        $payload['headers'] = [
            'MIGRATEAPI' => 'ZTPLBUUSPZ',
            'Authorization' => 'Bearer ' . $token,
        ];

        $transactionid = $transaction->transaction_id;
        
        $url = "https://api.manoramahorizon.com/payment_package/transaction-data-detail?from_id=" . $transactionid . "&to_id=" . $transactionid;
        $post = $this->client->request(
            'POST',
            $url,
            $payload
        );

        $response = ($post->getStatusCode() == 200) ? json_decode($post->getBody(), true) : false;
        
        if ($response && $response['status'] == 'success') {
            $values = $response['response'];
            foreach ($values as  $value) {
                $this->info($value['student']['id']);
                $this->service = new EnrollmentService();
                $cuser = User::where('old_id', $value['student']['id'])->first();
                $exists = Order::where('old_id', $value['hrzn_order_id'])->first();
                if (!$exists && $cuser) {
                    DB::beginTransaction();

                    if ($value && isset($value['student']) && isset($value['student']['id'])) {
                        $user = User::where('old_id', $value['student']['id'])->first();
                        $package_id = $value['payment_transaction'][0]['package'][0];
                        $package = Packages::where('old_id', $package_id['id'])->first();

                        if ($user && $package) {
                            $packagepricing = PackagePricing::where('package_id', $package->id)->first();
                            $offerprice = !empty($value['chargetotal']) ? $value['chargetotal'] : 0;
                            $orderdata = [
                                'old_id' => $value['hrzn_order_id'],
                                'order_key' => $value['merchant_txn_id'],
                                'reference_key' => $value['merchant_txn_id'],
                                'package_id' => $packagepricing->package_id,
                                'package_pricing_id' => $packagepricing->id,
                                'user_id' => $user->id,
                                'order_amount' => $offerprice,
                                'discount_amount' => $package_id['price'] - $offerprice,
                                'net_payable' => $offerprice,
                                'status' => 3,
                                'transaction_id' => $value['endpointTransactionId'],
                                'is_trial_order' => 0,
                            ];
                            $order = Order::create($orderdata);
                            $order->created_at = !empty($value['txndatetime']) ? $value['txndatetime'] : time();
                            $order->save();

                            if ($order->id) {
                                $message = "Order has been created for this user id " . $value['student']['id'] . " with Order id " . $order->id;
                                Log::info($message);
                                $logs[] = $message;
                                $this->info($message);

                                $enrollmentdata = [
                                    "package_id" => $package->id,
                                    "package_pricing_id" => $packagepricing->id,
                                    "order_id" => $order->id,
                                    "user_id" => $user->id,
                                    "enrollment_type" => 1,
                                    "start_date" => $value['student_subscription'][0]['valid_from'],
                                    "end_date" => $value['student_subscription'][0]['valid_to'],
                                ];

                                $enrollment = Enrollment::create($enrollmentdata);
                                $enrollment->created_at = !empty($value['txndatetime']) ? $value['txndatetime'] : time();
                                $enrollment->save();

                                if ($enrollment->id) {
                                    $message = "Enrollment has been created for this user id " . $value['student']['id'] . " with Enrollment id " . $enrollment->id;
                                    Log::info($message);
                                    $logs[] = $message;
                                    $this->info($message);

                                    $user_enrollments = $value['student_subscription'][0]['student_enrollment'];
                                    foreach ($user_enrollments as $user_enrollment) {
                                        $batch = Batches::where('old_id', $user_enrollment['batch'])->first();
                                        if ($batch) {
                                            $coursesdata = [
                                                "enrollment_id" => $enrollment->id,
                                                "batch_id" => $batch->id,
                                                "status" => 0,
                                            ];
                                            $enrollmentcourse = EnrollmentHasCourses::create($coursesdata);

                                            $courseid = Courses::where('id', $batch->course_id)->value('mdl_id');
                                            $order->userid = $user->mdl_user;
                                            $order->courseid = $courseid;
                                            $order->timestart = strtotime($user_enrollment['enroled_on']);
                                            $order->timeend = strtotime($user_enrollment['valid_till']);

                                            $this->service->migrration_enroll_subscriber($order);

                                            if ($enrollmentcourse->id) {
                                                $message = "Enrollment course has been created";
                                                Log::info($message);
                                                $logs[] = $message;
                                                $this->info($message);
                                            }

                                            if ($order->id && $enrollment->id && $enrollmentcourse->id) {
                                                $transaction->status = 1;
                                                $transaction->save();

                                                DB::commit();
                                                $this->info("Transaction is created successfully");
                                                $conditions = ['component' => 'Transaction', 'component_status' => 'created', 'raw_data' => serialize($value), 'inserted_data' => serialize($orderdata), 'status' => 1];
                                                MigrationLogs::create($conditions);
                                            } else {
                                                DB::rollback();

                                                $this->info("Transaction is not created");

                                                $conditions = ['component' => 'Transaction', 'component_status' => 'failed', 'raw_data' => serialize($value), 'inserted_data' => serialize($orderdata), 'status' => 0];
                                                MigrationLogs::create($conditions);
                                            }
                                        }
                                    }
                                    // $this->service->migrration_enroll_subscriber($order);
                                } else {
                                    DB::rollback();

                                    $this->info("Transaction is not created");

                                    $message = "Order is created with id " . $order->id . " but Enrollment is not created for this user id " . $value['student']['id'];
                                    Log::info($message);
                                    $logs[] = $message;

                                    $this->info($message);
                                }
                            } else {
                                DB::rollback();
                                $this->info("Transaction is not created");

                                $message = "Order is not created for this user id " . $value['student']['id'];
                                Log::info($message);
                                $logs[] = $message;

                                $this->info($message);
                            }
                        } else {
                            if ($exists) {
                                $message = "Order is already exists for this user id " . $value['student']['id'] . " with order id " . $value['hrzn_order_id'];
                                Log::info($message);
                                $logs[] = $message;

                                $this->info($message);
                            } else {
                                $message = "User having this id " . $value['student']['id'] . " is not present in the system";
                                Log::info($message);
                                $logs[] = $message;

                                $this->info($message);
                            }
                        }
                        $response['data'] = $logs;
                    }
                } else {
                    $this->info("Transaction is not created");
                }
            }
            
        } else {
            $this->info("No Data Available");
            
        }
        $this->info("Import Process Completed".$transaction->transaction_id);
    }
}
