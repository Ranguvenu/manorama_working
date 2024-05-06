<?php
namespace App\Imports\DataMigrations;

use App\Models\Ecommerce\Coupons;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use App\Models\DataMigrations\MigrationLogs;

class CouponsMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
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
        foreach($rows as $index => $row){
            $response = [];
            $excel_row = $this->startRow + $index + 1;
            $response['row'] = $excel_row;
            $response['values'] = $row->toArray();
            $response['has_errors'] = false;
            $response['errors'] = [];
            $errors = false;
            $validator = Validator::make($row->toArray(), [
                'old_id' => 'nullable',
                'code' => 'required|unique:App\Models\Ecommerce\Coupons,code',
                'discount_type' => 'required',
                'discount_value' => 'required',
                'valid_from' => 'required',
                'valid_to' => 'required',   
                'created_at' => 'required',
                'updated_at' => 'required',
            ]);            
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }
            $data = [
                'code' => $row['code'] ? $row['code']: '',
                'discount_type' => $row['discount_type'] ? $row['discount_type']:'',
                'discount_value' => $row['discount_value'] ? $row['discount_value'] : '',
                'valid_from' => $row['valid_from'],
                'valid_to'  =>  $row['valid_to'] ,
                'coupon_usage_limit' => 1,
                'user_usage_limit' => 1,
                'created_by_id' => 0,
                'created_at'   =>  $row['created_at'],
                'updated_at' =>  $row['updated_at']
            ];
            $coupon = Coupons::create($data);

            if ($coupon->id) {
                $conditions = ['component' => 'Coupons', 'component_status' => 'created', 'raw_data' => serialize($row), 'inserted_data' => serialize($data), 'status' => 1];
                MigrationLogs::create($conditions);
            } else {
                $conditions = ['component' => 'Coupons', 'component_status' => 'creation failed', 'raw_data' => serialize($row), 'inserted_data' => serialize($data), 'status' => 0];
                MigrationLogs::create($conditions);
            }
            $this->imported[] = $response;
        }
    }
    public function rules(): array
    {
        return [

            '*.code' => 'required|unique:App\Models\Ecommerce\Coupons,code',
            '*.discount_type' => 'required',
            '*.discount_value' => 'required',
            '*.valid_from' => 'required',
            '*.valid_to' => 'required',
            '*.created_at' => 'required',
            '*.updated_at' => 'required',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'code.required' => 'Code is required',
            'code.unique' => 'Given code already exists',
            'discount_type.required' => 'Discount Type is required',
            'discount_value.required' => 'Discount Value  is required',
            'valid_from.required'   => 'Valid From is required',
            'valid_to.required'   => 'Valid To  is required',
            'created_at.required' => 'Created At is required',
            'updated_at.required' => 'Updated At required',  
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }

}
