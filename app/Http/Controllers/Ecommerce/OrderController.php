<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\OrderNotes\CreateRequest as OrderNotesCreateRequest;
use App\Http\Requests\Ecommerce\Orders\CreateRequest as OrderCreateRequest;
use App\Http\Requests\Ecommerce\Orders\UpdateRequest as OrderUpdateRequest;
use App\Http\Resources\Ecommerce\EditOrderResource;
use App\Http\Resources\Ecommerce\OrderNotesResource;
use App\Http\Resources\Ecommerce\OrdersResource;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\PackagePricing;
use App\Models\Ecommerce\Packages;
use App\Services\Ecommerce\CheckoutService;
use App\Services\Moodle\EnrollmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:view-orders'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-orders'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-orders'])->only('create', 'update', 'edit');
    }

    public function index(Request $request)
    {
        $packages = Packages::all();
        $orders = new Order();

        return Inertia::render(
            'Ecommerce/Orders/index',
            [
                'data' => [
                    'packages' => $packages,
                    'status' => $orders->statuses(),
                    'agents' => [],
                ],
            ]
        );
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $orders = Order::filterBy($request->all())->latest()->paginate($perpage);

        return OrdersResource::collection($orders);
    }

    public function create()
    {
        $order = new Order();

        $data = [
            'users' => [],
            'packages' => [],
            'courses' => [],
            'batches' => [],
            'agents' => [],
            'orderstatus' => $order->statuses(),
        ];

        return Inertia::render('Ecommerce/Orders/create', [
            'data' => $data,
        ]);
    }

    public function store(OrderCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $price = PackagePricing::find($request->get('package_pricing_id'));
            $data['order_amount'] = $price->selling_price;
            $data['net_payable'] = $price->selling_price;
            $data['coupon_discount'] = 0;
            $data['total'] = $price->selling_price;
            $data['selling_price'] = $price->selling_price;
            $data['status'] = $request->get('status');
            $data['cheque'] = $request->get('cheque');
            $data['batches'] = $request->get('batches');
            $data['days'] = $request->get('days');
            $service = new CheckoutService($price);
            $order = $service->create_manual_order($data);

            return response()->json([
                'id' => $order,
                'success' => true,
                'message' => 'Order created successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage(),
                'message' => 'Failed to create Order',
            ], 200);
        }
    }

    public function add_note(Order $order, OrderNotesCreateRequest $request)
    {
        try {
            $order->notes()->create([
                'note' => $request->get('note'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order Note created successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Order Note',
            ], 200);
        }
    }

    public function get_notes(Order $order)
    {
        $notes = $order->notes()->latest()->get();

        return OrderNotesResource::collection($notes);
    }

    public function getpricings(Packages $package)
    {
        $pricings = $package->pricing->groupBy('package_pricing_id')->map(function ($group) {
            return $group->pluck('courses')->flatten()->unique('id')->values();
        })->collapse();

        $pricings = collect($pricings)->groupBy('package_pricing_id')->map(function ($group) {
            return $group->pluck('course_id')->unique()->values()->toArray();
        });

        return response()->json([
            'data' => $pricings,
        ], 200);
    }

    public function edit(Order $order)
    {
        // $batches = ($order->enrollment && $order->enrollment->courses) ? $order->enrollment->courses->map(function ($batch) {
        //     return [
        //         'id' => $batch->id,
        //         'name' => $batch->batch->name,
        //     ];
        // }) : [];
        // $courses = ($order->package_pricing && $order->package_pricing->courses) ? $order->package_pricing->courses->map(function ($course) {
        //     return [
        //         'id' => $course->id,
        //         'name' => $course->course->title,
        //     ];
        // }) : [];
        $info = [
            'users' => Collection::wrap($order->user)->toArray(),
            'agents' => Collection::wrap($order->agent)->toArray(),
            'packages' => Collection::wrap($order->package)->toArray(),
            'courses' => [],
            'batches' => [],
            'orderstatus' => $order->statuses(),
            'pricing' => [
                'selling_price' => $order->package_pricing ? $order->package_pricing->selling_price : '',
                'actual_price' => $order->package_pricing ? $order->package_pricing->actual_price : '',
                'code' => $order->coupon_claim ? $order->coupon_claim->coupon_code->code : '',
                'coupon_discount' => $order->coupon_claim ? $order->coupon_claim->coupon_amount : '',
            ],
        ];

        return Inertia::render('Ecommerce/Orders/create', [
            'edit' => true,
            'data' => $info,
            'order' => new EditOrderResource($order),
        ]);
    }

    public function update(Order $order, OrderUpdateRequest $request)
    {
        try {
            $current = $order->statusname;
            $order->agent_id = $request->get('agent_id');

            if ($order->status != $request->get('status')) {
                $order->update(['status' => $request->get('status')]);
                $order->notes()->create([
                    'note' => 'Order status updated from '.$current.' to '.$order->statusname,
                ]);

                if ($request->get('status') == 3) {
                    $enrollmentservice = new EnrollmentService();
                    $enrollmentservice->enroll_subscriber($order);
                }
            }
            $order->save();

            return response()->json([
                'id' => $request->get('id'),
                'success' => true,
                'message' => 'Order updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Update Order',
                'log' => $e->getMessage(),
            ], 200);
        }
    }
}
