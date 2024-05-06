<?php

namespace App\Imports\DataMigrations;

use App\Models\Content\Courses;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\PackagePricing;
use App\Models\User;
use App\Models\Content\Enrollment;
use App\Models\Content\EnrollmentHasCourses;
use App\Models\Ecommerce\Batches;
use App\Models\Ecommerce\Packages;
use App\Services\Moodle\EnrollmentService;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Facades\Log;

class TransactionsMigration
{
    public $service;

    public function __construct()
    {
        $this->service = new EnrollmentService();
    }

    public function import($data)
    {
        $responsedata = $data;
        $response = [];

        foreach ($responsedata as $key => $value) {
            $cuser = User::where('old_id', $value['student']['id'])->first();

            $exists = Order::where('old_id', $value['hrzn_order_id'])->first();

            if (!$exists && $cuser) {
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
                            $message = "Order has been created for this user id ".$value['student']['id'] ." with Order id ". $order->id;
                            Log::info($message);
                            $logs[] = $message;

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
                            if ($enrollment->id) {
                                $message = "Enrollment has been created for this user id ".$value['student']['id'] ." with Enrollment id ". $enrollment->id;
                                Log::info($message);
                                $logs[] = $message;

                                $user_enrollments = $value['student_subscription'][0]['student_enrollment'];
                                foreach($user_enrollments as $user_enrollment) {
                                    $batch = Batches::where('old_id', $user_enrollment['batch'])->first();
                                    // if ($value['student_subscription'][0]['package_type'] == 2) { // Package Type = 2(test) as per the comment 
                                    //     $batch = Batches::where('old_id', $user_enrollment['master_course'])->first();
                                    // }

                                    if ($batch) {
                                        $coursesdata = [
                                            "enrollment_id" => $enrollment->id,
                                            "batch_id" => $batch->id,
                                            "status" => 0,
                                        ];
                                        EnrollmentHasCourses::create($coursesdata);

                                        $courseid = Courses::where('id', $batch->course_id)->value('mdl_id');
                                        $order->userid = $user->mdl_user;
                                        $order->courseid = $courseid;
                                        $order->timestart = strtotime($user_enrollment['enroled_on']);
                                        $order->timeend = strtotime($user_enrollment['valid_till']);

                                        $this->service->migrration_enroll_subscriber($order);

                                        $message = "Enrollment course has been created";
                                        Log::info($message);
                                        $logs[] = $message;
                                    }
                                }
                                // $this->service->migrration_enroll_subscriber($order);
                            } else {
                                $message = "Order is created with id ". $order->id ." but Enrollment is not created for this user id ".$value['student']['id'];
                                Log::info($message);
                                $logs[] = $message;
                            }
                        } else {
                            $message = "Order is not created for this user id ".$value['student']['id'];
                            Log::info($message);
                            $logs[] = $message;
                        }
                    } else {
                        if ($exists) {
                            $message = "Order is already exists for this user id ". $value['student']['id'] ." with order id ". $value['hrzn_order_id']; 
                            Log::info($message);
                            $logs[] = $message;
                        } else {
                            $message = "User having this id ". $value['student']['id'] ." is not present in the system";
                            Log::info($message);
                            $logs[] = $message;
                        }

                    }
                    $response['data'] = $logs;
                }
            }
        }

        return $response;
    }
}
