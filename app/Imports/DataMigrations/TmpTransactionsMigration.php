<?php
namespace App\Imports\DataMigrations;

use App\Models\DataMigrations\TmpTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
class TmpTransactionsMigration implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
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
                'transaction_id' => 'required',
                'package_id' => 'required',
                'user_id' => 'required',
                'status' => 'nullable',
            ]);            
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }  
            $recenttransaction = TmpTransactions::where('transaction_id', $row['transaction_id'])->first();

            if($recenttransaction){
                $recenttransaction->update(
                    [
                        'package_id' => $row['package_id'] ,
                        'user_id' => $row['user_id'] ,
                        'status' => $row['status'] ? $row['status'] : 0 , 
                    ]
                    );

            } else{                
                TmpTransactions::create(
                    [
                        'transaction_id' => $row['transaction_id'],
                        'package_id' => $row['package_id'] ,
                        'user_id' => $row['user_id'] ,
                        'status' => $row['status'] ? $row['status'] : 0 ,
                  
                    ]
                    );
            }


 
                $this->imported[] = $response;


        }
    }
    public function rules(): array
    {
        return [
                '*.transaction_id' => 'required',
                '*.package_id' => 'required',
                '*.user_id' => 'required',
                '*.status' => 'nullable',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'transaction_id.required' => 'Transaction Id  is required',
            'package_id.required' => 'Package Id is required',
            'user_id.required' => 'User Id is required',        
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }

}
