<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\PackagePricing;
use App\Services\Ecommerce\PaymentGateway\RazorpayService;
use App\Services\Moodle\EnrollmentService;
use App\Services\SAPService;
use Carbon\Carbon;

class CheckoutService
{
    protected $order;

    protected $payment;

    public function __construct(PackagePricing $variation = null)
    {
        if ($variation) {
            $this->order = $variation->orders();
        }
        $this->payment = new RazorpayService();
    }

    public function fetch_payment($payment_id)
    {
        return $this->payment->verify_payment($payment_id);
    }

    public function set_order(Order $order)
    {
        $this->order = $order;
    }

    public function create_manual_order($data)
    {
        $order = $this->order->create([
            'order_key' => uniqid(),
            'package_id' => $data['package_id'],
            'reference_key' => uniqid(),
            'order_amount' => $data['selling_price'],
            'discount_amount' => $data['coupon_discount'],
            'user_id' => $data['user_id'],
            'net_payable' => $data['total'],
            'transaction_id' => $data['cheque'],
            'gateway' => 'manual',
            'status' => $data['status'],
        ]);

        $batches = array_map(function ($batch) {
            return [
                'batch_id' => $batch,
                'status' => 0,
            ];
        }, $data['batches']);

        if ($data && isset($data['coupon']) && $data['coupon']) {
            $order->coupon_claim()->create([
                'coupon_code_id' => $data['coupon'],
                'coupon_amount' => $data['coupon_discount'],
            ]);
        }

        $enrolmentdates = [
            'start' => Carbon::now(),
        ];
        if ($data['status'] == 6) {
            $enrolmentdates['end'] = Carbon::now()->addDays($data['days']);
        } else {
            if ($order->package->validity_type == 'days') {
                $enrolmentdates['end'] = Carbon::now()->addDays($order->package->valid_for);
            } else {
                $timestamp = strtotime($order->package->valid_for);
                $enrolmentdates['end'] = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
            }
        }
        $enrollment = $order->package->enrollments()->create([
            'package_pricing_id' => $order->package_pricing->id,
            'order_id' => $order->id,
            'user_id' => $data['user_id'],
            'start_date' => $enrolmentdates['start'],
            'end_date' => $enrolmentdates['end'],
            'enrollment_type' => ($data['status'] == 6) ? 2 : 1,
        ]);

        $enrollment->courses()->createMany($batches);

        if ($data['status'] == 3 || $data['status'] == 6) {
            $enrollmentservice = new EnrollmentService();
            $enrollmentservice->enroll_subscriber($order);

            $variables = [
                '{{gateway}}' => 'Offline Payment',
                '{{reference}}' => $data['cheque'],
                '{{charge}}' => $data['total'],
            ];
            $this->create_note($order, 'completed', $variables);
        }

        $order->save();

        return $order->id;
    }

    public function create_order($request)
    {
        $user = auth()->user()->update($request['profile']);
        $data = $request['summary'];
        try {
            $apiorder = [];
            if (!$data['trial'] && $data['total']) {
                $netpayable = $data['total'];
                $apiorder = $this->payment->create_order($netpayable);
            } else {
                $netpayable = 0;
            }

            $order = $this->order->create([
                'order_key' => uniqid(),
                'package_id' => $data['package_id'],
                'reference_key' => $netpayable ? $apiorder['id'] : uniqid(),
                'order_amount' => $data['selling_price'],
                'discount_amount' => $data['coupon_discount'],
                'net_payable' => $netpayable,
                'status' => 1,
            ]);

            $batches = array_map(function ($batch) {
                return [
                    'batch_id' => $batch,
                    'status' => 0,
                ];
            }, $data['batches']);

            $enrolmentdates = [
                'start' => Carbon::now(),
            ];

            if ($data['trial']) {
                $enrolmentdates['end'] = Carbon::now()->addDays($data['trial']);
            } else {
                if ($order->package->validity_type == 'days') {
                    $enrolmentdates['end'] = Carbon::now()->addDays($order->package->valid_for);
                } else {
                    $timestamp = strtotime($order->package->valid_for);
                    $enrolmentdates['end'] = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
                }
            }

            $enrollment = $order->package->enrollments()->create([
                'package_pricing_id' => $order->package_pricing->id,
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'start_date' => $enrolmentdates['start'],
                'end_date' => $enrolmentdates['end'],
                'enrollment_type' => $data['trial'] ? 2 : 1,
                'status' => 0,
            ]);

            $enrollment->courses()->createMany($batches);

            if ($data && isset($data['coupon']) && $data['coupon']) {
                $claimdata = [
                    'coupon_code_id' => $data['coupon'],
                    'coupon_amount' => $data['coupon_discount'],
                    'status' => 1,
                ];
                if ($netpayable) {
                    $claimdata['status'] = 0;
                }
                $order->coupon_claim()->create($claimdata);
            }
            if (!$netpayable) {
                if ($data['trial']) {
                    $order->status = 6;
                    $order->is_trial_order = 1;
                    $this->create_note($order, 'freetrial', []);
                } elseif ($data && isset($data['coupon']) && $data['coupon']) {
                    $variables = [
                        '{{gateway}}' => 'Coupon',
                        '{{reference}}' => $data['coupon'],
                        '{{charge}}' => $data['coupon'],
                    ];
                    $order->status = 3;
                    $this->create_note($order, 'completed', $variables);
                } else {
                    $order->status = 4;
                }
                $enrollmentservice = new EnrollmentService();
                $enrollmentservice->enroll_subscriber($order);
            } else {
                $variables = [
                    '{{amount}}' => $netpayable,
                    '{{reference}}' => $apiorder['id'],
                ];
                $this->create_note($order, 'processing', $variables);
            }
            $order->save();

            return [
                'key' => $netpayable ? $this->payment->api_key() : 0,
                'amount' => $netpayable,
                'order' => $netpayable ? $apiorder['id'] : 0,
                'package' => $order->package->slug,
                'order_key' => $order->order_key,
            ];
        } catch (Exception $e) {
            return [
                'key' => '',
                'amount' => 0,
                'order' => 0,
            ];
        }
    }

    public function payment_success($response)
    {
        $sapservice = new SAPService();
        try {
            $this->order->status = 3;
            $this->order->transaction_id = $response['id'];
            $this->order->save();
            if ($this->order->coupon_claim) {
                $this->order->coupon_claim()->update(['status' => 1]);
            }
            $variables = [
                '{{gateway}}' => 'Razorpay',
                '{{reference}}' => $this->order->reference_key,
            ];
            $this->create_note($this->order, 'completed', $variables);

            $islead = $this->order->is_lead_user;
            if ($islead) {
                $this->order->interests()->where('lead_id', $islead->lead_id)->update(['status' => 4]);
            }

            $enrollmentservice = new EnrollmentService();
            $enrollmentservice->enroll_subscriber($this->order);
            $sapservice->upload_order_file($this->order);
            $sapservice->upload_reconcilation_file($this->order);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function payment_pending($response)
    {
        try {
            $this->order->status = 4;
            $this->order->save();
            $variables = [];
            $this->create_note($this->order, 'pendingpayment', $variables);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function cancel_order($reference, $user)
    {
        try {
            $order = $this->order->where('reference_key', $reference)->first();
            $order->status = 2;
            $order->save();
            $order->enrollment->update(['status' => 3]);
            $order->enrollment->courses()->update(['status' => 3]);

            $variables = [
                'user' => $user,
                'reference' => $reference,
            ];
            $this->create_note($order, 'cancelled', $variables);

            return $order;
        } catch (Exception $e) {
            return false;
        }
    }

    public function create_note($order, $type, $variables)
    {
        $order->notes()->create([
            'note' => $this->note($type, $variables),
        ]);
    }

    public function note($type, $variables)
    {
        $notes = $this->notes();
        $note = ($notes && isset($notes[$type])) ? $notes[$type] : '';
        $content = $note;
        foreach ($variables as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $content;
    }

    public function notes()
    {
        return [
            'processing' => 'Order created to receive an amount of {{amount}} with reference id {{reference}}',
            'pendingpayment' => 'Waiting for payout from payment gateway {{gateway}} with reference {{reference}}',
            'cancelled' => 'Payment for the order with reference id {{reference}} has been cancelled by the user {{user}}',
            'completed' => '{{gateway}} charge complete for {{reference}} with charge id {{charge}}',
            'failed' => 'Payment pending from gateway',
            'freetrial' => 'No Payment Collected as user is subscribed to free trial',
        ];
    }
}
