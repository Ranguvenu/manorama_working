<?php

namespace App\Http\Controllers\Notifications\Templates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\Templates\SMS\CreateRequest as CreateTemplateRequest;
use App\Http\Requests\Notifications\Templates\SMS\UpdateRequest as UpdateTemplateRequest;
use App\Http\Resources\Notifications\Templates\SmsResource;
use App\Models\Notifications\NotificationType;
use App\Models\Notifications\Templates\SmsTemplate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SMSTemplateController extends Controller
{
    public function __construct(){
        $this->middleware(['role_or_permission:view-sms_template'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-sms_template'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-sms_template'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-sms_template'])->only('destroy');
    }

    public function index(Request $request)
    {
        return Inertia::render('Notifications/Templates/SMS/index', [
            'notificationtypes' => NotificationType::all(),
        ]);
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $smstemplates = SmsTemplate::filterBy($request->all())->paginate($perpage);

        return SmsResource::collection($smstemplates);
    }

    public function create()
    {
        return response()->json([
            'notificationtypes' => NotificationType::all(),
        ], 200);
    }

    public function store(CreateTemplateRequest $request)
    {
        try {
            $create = SmsTemplate::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'SMS Template Created Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(SmsTemplate $smstemplate)
    {
        return response()->json([
            'data' => $smstemplate,
            'types' => $smstemplate->notification_type_id,
        ], 200);
    }

    public function update(SmsTemplate $smstemplate, UpdateTemplateRequest $request)
    {
        try {
            $update = $smstemplate->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'SMS Template Updated Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(SmsTemplate $smstemplate)
    {
        try {
            if ($smstemplate->logs()->first()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Failed to delete SMS Template as it has some logs associated with it',
                ], 422);
            }
            $delete = $smstemplate->delete();

            return response()->json([
             'success' => true,
             'message' => 'SMS Template Deleted Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
