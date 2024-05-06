<?php

namespace App\Imports\DataMigrations;

use App\Models\LeadManagement\InterestedIn;
use App\Models\LeadManagement\Lead;
use App\Models\MasterData\Category;
use App\Models\MasterData\Taxonomy;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class LeadsMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
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
            $category = Category::where('slug', 'marketing')->first();

            $validator = Validator::make($row->toArray(), [
                'old_id' => 'required',
                'name' => 'required',
                'country_code' => 'required',
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => 'nullable|email',
                'source' => 'nullable',
                'tags' => 'nullable',
                'agent_email' => 'nullable',
            ]);

            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }
            $taxonomy = Taxonomy::findOrFail('lead_source');
            $source = $taxonomy->categories()->where('name', $row['source'])->first();

            if (!$source) {
                if ($row['source']) {
                    $source = $taxonomy->categories()->create([
                        'name' => $row['source'],
                        'code' => uniqid(),
                    ]);

                    $message = 'Category has been created with source name '.$row['source'];
                    Log::info($message);
                }
            }

            if ($row && isset($row['agent_email'])) {
                $agent = User::where('email', $row['agent_email'])->first();
                if ($agent && $agent->hasAnyRole(['ccagent', 'cclead'])) {
                } else {
                    $response['has_errors'] = true;
                    $response['errors']['agent_email'][] = "Agent doesn't exists in the system";
                    $errors = true;
                }
            }

            if ($errors) {
                $this->imported[] = $response;
                continue;
            }

            if ($source) {
                $metadata = [];
                foreach ($row as $key => $value) {
                    if (Str::contains($key, 'addl_')) {
                        $metadata[$key] = $value;
                    }
                }
                $lead = Lead::updateOrCreate(
                    ['phone_number' => $row['phone_number']],
                    [
                        'country_code' => $row['country_code'],
                        'phone_number' => $row['phone_number'],
                        'email' => $row['email'],
                        'name' => $row['name'],
                    ]);
                $lead->created_at = !empty($row['created_on']) ? $row['created_on'] : time();
                $lead->updated_at = !empty($row['updated_on']) ? $row['updated_on'] : time();
                $lead->save();

                $message = 'Record is inserted/updated in Lead table having old_id '.$row['old_id'].' is Created';
                Log::info($message);

                $exists = InterestedIn::where('old_id', $row['old_id'])->value('id');
                if (!$exists) {
                    $intrests = $lead->interests()->create([
                        'source_id' => $source ? $source->id : '',
                        'old_id' => $row['old_id'],
                        'category_id' => $category->id,
                        'received_from' => !empty($row['received_from']) ? $row['received_from'] : null,
                        'tags' => $row['tags'],
                        'meta' => $metadata,
                    ]);

                    $intrests->created_at = !empty($row['created_on']) ? $row['created_on'] : time();
                    $intrests->updated_at = !empty($row['updated_on']) ? $row['updated_on'] : time();
                    $intrests->save();

                    $message = 'Interested_In having old_id '.$row['source'].' is Created';
                    Log::info($message);
                } else {
                    $intrests = InterestedIn::where('old_id', $row['old_id'])->first();
                    // $intrests->update([
                    //     // 'source_id' => $source ? $source->id : '',
                    //     // 'category_id' => $category->id,
                    //     // 'received_from' => !empty($row['received_from']) ? $row['received_from'] : null,
                    //     'tags' => $row['tags'],
                    // ]);

                    $intrests->created_at = !empty($row['created_on']) ? $row['created_on'] : time();
                    $intrests->updated_at = !empty($row['updated_on']) ? $row['updated_on'] : time();
                    $intrests->save();

                    $message = 'Interested_In having old_id '.$row['source'].' is Updated';
                    Log::info($message);
                }

                if ($intrests) {
                    if ($row && isset($row['agent_email'])) {
                        $agent = User::where('email', $row['agent_email'])->first();
                        if ($agent) {
                            $assignagent = $intrests->assignment()->updateOrCreate(['interested_in_id' => $intrests->id], ['assigned_to_id' => $agent->id]);

                            $assignagent->created_at = !empty($row['created_on']) ? $row['created_on'] : time();
                            $assignagent->updated_at = !empty($row['updated_on']) ? $row['updated_on'] : time();
                            $assignagent->save();

                            $message = 'Lead Assignment is Created/Updated';
                            Log::info($message);
                        }
                    }
                }
            }

            $this->imported[] = $response;
        }
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required',
            '*.country_code' => 'required',
            '*.phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            '*.email' => 'nullable|email',
            '*.tags' => 'nullable',
            '*.source' => 'nullable',
            '*.agent_email' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'phone_number.required' => 'Phonenumber is required',
            'email.email' => 'Please enter valid email',
            'received_from.required' => 'Received from is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the exception how you'd like.
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
