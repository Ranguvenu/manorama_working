<?php

namespace App\Imports\UserManagement;

use App\Models\MasterData\Category;
use App\Models\User;
use App\Models\UserManagement\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\DB;
use App\Services\Moodle\Users as UsersService;

class RegisteredUserImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
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

    public function collection(Collection $collection)
    {
        $usertype = Category::where('slug', 'subscribers')->firstorfail();
        foreach ($collection as $row => $value) {
            $response = [];
            $excel_row = $this->startRow + $row + 1;
            $response['row'] = $excel_row;

            $data = [
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => $value['password'],
                'country_code' => '+'.$value['country_code'],
                'phone_number' => $value['phone_number'],
                'firstname' => $value['firstname'],
                'lastname' => $value['lastname'],
            ];
            $value['lms'] = '';
            $data['phone']['number'] = $value['phone_number'];

            $validator = Validator::make($value->toArray(), [
                'name' => 'required|alpha_dash|unique:'.User::class,
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10|unique:'.User::class,
                'country_code' => 'required|exists:App\Models\MasterData\CountryCode,code',
                'email' => 'required|email|unique:'.User::class,
                'password' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'lms'     => 'nullable'
            ]);
            $response['values'] = $data;
            $response['values']['password'] = $value['password'];
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }
            DB::beginTransaction();
             $mdlroles = [];         
                $mdlrole = Role::where('name', 'subscriber')->first();
                if ($mdlrole !== null && $mdlrole->mdlrole != null) {
                    $mdlroles[] = $mdlrole->mdlrole;
                }
                $userservice = new UsersService();
                $mdl_id = $userservice->createorupdate_user($data, null, $mdlroles);               
                if ($mdl_id) {    
                    $user = $usertype->users()->create($data);
                    $user->assignRole('subscriber');           
                    $user->mdl_user = $mdl_id['data']['id'];
                    $user->save();
                    DB::commit();
                    $response['errors'] = [];
                    $response['has_errors'] = false;
                    $this->imported[] = $response;
                } else{
                    DB::rollback();           
                        $response['has_errors'] = true;
                        $response['errors']['lms'][] = "Failed to Create user in LMS";                   
                        $this->imported[] = $response;
                        continue;                 
                }
                   
            }
         }
    

    public function validate($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|alpha_dash|unique:'.User::class,
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10|unique:'.User::class,
            'country_code' => 'required|regex:/^\d{1,3}$/|exists:App\Models\MasterData\CountryCode,code',
            'email' => 'required|email|unique:'.User::class,
            'password' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'lms' =>    'nullable'
        ]);

        return $validator;
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required|alpha_dash|unique:'.User::class,
            '*.phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10|unique:'.User::class,
            '*.country_code' => 'required|regex:/^\d{1,3}$/|exists:App\Models\MasterData\CountryCode,code',
            '*.email' => 'required|email|unique:'.User::class,
            '*.password' => 'required',
            '*.firstname' => 'required',
            '*.lastname' => 'required',
            '*.lms'=> 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'name.unique' => 'Duplicate username',
            'phone_number.required' => 'Phonenumber is required',
            'phone_number.regex' => 'Invalid Phonenumber',
            'phone_number.min' => 'Invalid Phonenumber',
            'phone_number.max' => 'Invalid Phonenumber',
            'country_code.required' => 'Country code is required',
            'country_code.regex' => 'Invalid country code',
            'country_code.exists' => 'Country code doesn\'t exists',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter valid email',
            'email.unique' => 'Duplicate email',
            'password.required' => 'Password is required',
            'firstname.required' => 'Firstname is required',
            'lastname.required' => 'Lastname is required',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the exception how you'd like.
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
