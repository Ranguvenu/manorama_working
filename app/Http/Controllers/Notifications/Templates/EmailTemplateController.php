<?php

namespace App\Http\Controllers\Notifications\Templates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\Templates\Email\CreateRequest as CreateTemplateRequest;
use App\Http\Requests\Notifications\Templates\Email\UpdateRequest as UpdateTemplateRequest;
use App\Http\Resources\Notifications\Templates\EmailResource;
use App\Models\Notifications\NotificationType;
use App\Models\Notifications\Templates\EmailTemplate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmailTemplateController extends Controller
{
    public function __construct(){
        $this->middleware(['role_or_permission:view-email_template'])->only('index', 'results');
        $this->middleware(['role_or_permission:create-email_template'])->only('create', 'store');
        $this->middleware(['role_or_permission:edit-email_template'])->only('create', 'update', 'edit');
        $this->middleware(['role_or_permission:delete-email_template'])->only('destroy');
    }

    public function index(Request $request)
    {
        return Inertia::render('Notifications/Templates/Email/index', [
            'notificationtypes' => NotificationType::all(),
        ]);
    }

    public function results(Request $request)
    {
        $perpage = $request->get('perpage') ? $request->get('perpage') : 10;
        $emailtemplates = EmailTemplate::filterBy($request->all())->paginate($perpage);

        return EmailResource::collection($emailtemplates);
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
            $create = EmailTemplate::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Email Template Created Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function edit(EmailTemplate $emailtemplate)
    {
        return response()->json([
            'data' => $emailtemplate,
            'types' => $emailtemplate->notification_type_id,
        ], 200);
    }

    public function update(EmailTemplate $emailtemplate, UpdateTemplateRequest $request)
    {
        try {
            $update = $emailtemplate->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Email Template Updated Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(EmailTemplate $emailtemplate)
    {
        try {
            if ($emailtemplate->logs()->first()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Failed to delete Email Template as it has some logs associated with it',
                ], 422);
            }
            $delete = $emailtemplate->delete();

            return response()->json([
                'success' => true,
                'message' => 'Email Template Deleted Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
