<?php

namespace App\Imports\DataMigrations;

use App\Models\DataMigrations\MigrationLogs;
use App\Models\LeadManagement\Lead;
use App\Models\LeadManagement\LeadUserResponse;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class CallRequestsMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable;
    use SkipsFailures;
    public $startRow;

    public $imported = [];

    public $failed_imports = [];

    public function __construct(int $startRow = 1)
    {
        $this->startRow = $startRow;
    }

    public function startRow(): int
    {
        return $this->startRow;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $response = [];
            $excel_row = $this->startRow + $index + 1;
            $response['row'] = $excel_row;
            $response['values'] = $row->toArray();
            $response['has_errors'] = false;
            $response['errors'] = [];
            $errors = false;

            $validator = Validator::make($row->toArray(), [
                'old_id' => 'required',
                'lead_contact' => 'required',
                'status' => 'required',
                'response' => 'nullable',
                'created_at' => 'nullable',
                'updated_at' => 'nullable',
                'agent_email' => 'nullable',
            ]);

            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }

            if ($row && isset($row['agent_email'])) {
                $agent = User::where('email', $row['agent_email'])->first();
                if ($agent && $agent->hasAnyRole(['ccagent', 'cclead'])) {
                    $row['agent_id'] = $agent->id;
                } else {
                    // $response['has_errors'] = true;
                    // $response['errors']['agent_email'][] = "Agent doesn't exists in the system";
                    // $errors = false;
                }
            }

            if ($errors) {
                $this->imported[] = $response;
                continue;
            }

            $lead = Lead::where('phone_number', $row['lead_contact'])->first();
            if ($lead) {
                $intrests = $lead->interests()->first();
                $interestedid = $intrests ? $intrests->id : 0;
                if ($interestedid) {
                    $data = [
                        'old_id' => $row['old_id'],
                        'status' => !empty($row['status']) ? $row['status'] : 0,
                        'interested_in_id' => !empty($interestedid) ? $interestedid : 0,
                        'captured_from' => !empty($row['captured_from']) ? $row['captured_from'] : 0,
                        'call_id' => uniqid(),
                        'response' => !empty($row['response']) ? $row['response'] : '',
                        'callback' => !empty($row['callback']) ? $row['callback'] : 0,
                        'callback_on' => !empty($row['callback_on']) ? $row['callback_on'] : 0,
                        // 'agent_id' => !empty($row['agent_id']) ? $row['agent_id'] : 0,
                    ];

                    if ($row && isset($row['agent_email'])) {
                        $agent = User::where('email', $row['agent_email'])->first();
                        if ($agent) {
                            $data['agent_id'] = $agent->id;
                        }
                    }

                    $userresponse = LeadUserResponse::create($data);
                    $userresponse->created_at = !empty($row['created_at']) ? $row['created_at'] : time();
                    $userresponse->updated_at = !empty($row['updated_at']) ? $row['updated_at'] : time();
                    $userresponse->save();
                    if ($userresponse->id) {
                        $conditions = ['component' => 'CallRequests', 'component_status' => 'created', 'raw_data' => serialize($row), 'inserted_data' => serialize($data), 'status' => 1];
                        MigrationLogs::create($conditions);
                    } else {
                        $conditions = ['component' => 'CallRequests', 'component_status' => 'creation failed', 'raw_data' => serialize($row), 'inserted_data' => serialize($data), 'status' => 0];
                        MigrationLogs::create($conditions);
                    }

                    $this->imported[] = $response;
                }
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.old_id' => 'required',
            '*.lead_contact' => 'required',
            '*.status' => 'required',
            '*.response' => 'nullable',
            '*.created_at' => 'nullable',
            '*.updated_at' => 'nullable',
            '*.agent_email' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'old_id.required' => 'Name is required',
            'lead_contact.required' => 'Leadcontact is required',
            'status.required' => 'Status is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the exception how you'd like.
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
