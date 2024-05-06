<?php

namespace App\Imports\LeadManagement;

use App\Models\LeadManagement\Lead;
use App\Models\MasterData\Category;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class LeadsImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
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
                'name' => 'required',
                'country_code' => 'required|numeric',
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
                'email' => 'required|email:rfc,dns',
                'source' => 'required',
                'tags' => 'nullable',
                'agent_email' => 'nullable',
            ]);

            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }

            $source = Category::where('code', $row['source'])->first();

            if (!$source) {
                $response['has_errors'] = true;
                $response['errors']['source'][] = "Source Doesn't exists, Please create sourrce";
                $errors = true;
            }

            if ($row && isset($row['agent_email'])) {
                $agent = User::where('email', $row['agent_email'])->first();
                if ($agent && $agent->hasAnyRole(['ccagent'])) {
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
                    ['email' => $row['email']],
                    [
                        'country_code' => '+'.$row['country_code'],
                        'phone_number' => $row['phone_number'],
                        'name' => $row['name'],
                    ]);
                $intrests = $lead->interests()->create([
                    'source_id' => $source->id,
                    'category_id' => $category->id,
                    'tags' => $row['tags'],
                    'meta' => $metadata,
                ]);
                if ($intrests) {
                    if ($row && isset($row['agent_email'])) {
                        $agent = User::where('email', $row['agent_email'])->first();
                        if ($agent) {
                            $assignagent = $intrests->assignment()->updateOrCreate(['interested_in_id' => $intrests->id], ['assigned_to_id' => $agent->id]);
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
            '*.phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            '*.email' => 'required|email:rfc,dns',
            '*.tags' => 'nullable',
            '*.source' => 'required',
            '*.agent_email' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'phone_number.required' => 'Phonenumber is required',
            'phone_number.min' => 'Phonenumber is invalid',
            'phone_number.max' => 'Phonenumber is invalid',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter valid email',
            'received_from.required' => 'Received from is required',
            'source.required' => 'Source is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the exception how you'd like.
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
