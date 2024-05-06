<?php

namespace App\Imports\DataMigrations;

use App\Models\Ecommerce\PackagePricingHasCourses;
use App\Models\Ecommerce\Packages;
use App\Models\MasterData\Hierarchy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use App\Models\DataMigrations\TempMmPackages;
use App\Models\DataMigrations\MigrationLogs;

class PackagePricingMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
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
                'package_id' => 'required|numeric',
                'actual_price' => 'required|numeric',
                'selling_price' => 'required|numeric',
                'sap_type' => 'required',
                'sap_sub_type' => 'required',
                'sap_ism_amount' => 'required|numeric',
                'sap_ism_product_code' => 'required',
                'subject_ids' => 'required',
            ]);
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }
            $package = Packages::where('old_id', $row['package_id'])->first();
            $data = [
                'old_id' => $row['old_id'],
                'package_id' => $package->id,
                'actual_price' => $row['actual_price'],
                'selling_price' => $row['selling_price'] ? $row['selling_price'] : '',
                'sap_type_id' => $row['sap_type'] ? $row['sap_type'] : '',
                'sap_sub_type_id' => $row['sap_sub_type'] ? $row['sap_sub_type'] : '',
                'sap_ism_amount' => $row['sap_ism_amount'] ? $row['sap_ism_amount'] : '',
                'sap_ism_product_code' => $row['sap_ism_product_code'] ? $row['sap_ism_product_code'] : '',
            ];
            $packagepricing = $package->pricing()->create($data);

            $conditions = ['component' => 'Package Pricing', 'component_status' => 'created', 'raw_data' => serialize($row), 'inserted_data' => serialize($data), 'status' => 1];
            MigrationLogs::create($conditions);

            if ($row['subject_ids']) {
                $courseids = explode('|', $row['subject_ids']);
                foreach($courseids as $course){
                    $actualcourseid = TempMmPackages::where(['packageid' => $row['package_id'], 'subjectid' => $course])->value('mastercourseid');
                    $actualcourse = Hierarchy::where('old_id', $actualcourseid)->value('id');
                    if($actualcourse){
                        $courses[] = [
                            'course_id' => $actualcourse
                        ];
                    }
                }
                $packagepricing->courses()->createUpdateOrDelete($courses);
            }

            $this->imported[] = $response;
        }
    }

    public function rules(): array
    {
        return [
            '*.old_id' => 'required',
            '*.actual_price' => 'required|numeric',
            '*.selling_price' => 'required|numeric',
            '*.sap_type' => 'required',
            '*.sap_sub_type' => 'required',
            '*.sap_ism_amount' => 'required|numeric',
            '*.sap_ism_product_code' => 'required',
            '*.subject_ids' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'actual_price.required' => 'Actual Price is required',
            'actual_price.numeric' => 'Actual Price should be numeric',
            'selling_price.required' => 'Selling Price is required',
            'selling_price.numeric' => 'Selling Price should be numeric',
            'sap_type.required' => 'Sap Type  is required',
            'sap_sub_type.required' => 'Sap Sub Type is required',
            'sap_ism_amount.required' => 'Sap Amount is required',
            'sap_ism_amount.numeric' => 'Sap Amount should be numeric',
            'sap_ism_product_code.required' => 'Sap Product Code is required',
            'subject_ids.required' => 'Subject id is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
