<?php

namespace App\Imports\DataMigrations;

use App\Models\DataMigrations\MigrationLogs;
use App\Models\MasterData\Category;
use App\Models\MasterData\Country;
use App\Models\MasterData\State;
use App\Models\User;
use App\Services\Moodle\Users as UsersService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UsersMigrations implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable;
    use SkipsFailures;
    public $startRow;

    public $imported = [];

    public $failed_imports = [];

    public $service;

    public function __construct(int $startRow = 1)
    {
        $this->startRow = $startRow;
        $this->service = new UsersService();
    }

    public function startRow(): int
    {
        return $this->startRow;
    }

    public function collection(Collection $collection)
    {
        $usertype = Category::where('slug', 'subscribers')->firstorfail();
        foreach ($collection as $row => $value) {
            $state = 0;
            $country = 0;
            $user = 0;
            $user = User::where('old_id', $value['old_id'])->first();
            Log::info('MIGRATION STARTED');
            if (array_key_exists('state', $value->toArray())) {
                $state = State::where('name', $value['state'])->value('id');
                Log::info('STATE '.$state);
                if (!$state) {
                    $state = 0;
                }
            } else {
                $state = 0;
            }

            if (array_key_exists('country', $value->toArray())) {
                $country = Country::where('name', $value['country'])->value('id');
                if (!$country) {
                    $country = 0;
                }
            } else {
                $country = 0;
            }

            $response = [];
            $excel_row = $this->startRow + $row + 1;
            $response['row'] = $excel_row;

            $str = uniqid();

            $data = [
                'old_id' => $value['old_id'],
                'name' => !empty($value['name']) ? $value['name'] : $str,
                'email' => !empty($value['email']) ? $value['email'] : (!empty($value['name']) ? $value['name'].'@mailinator.com' : $str.'@mailinator.com'),
                'password' => \Hash::make($value['password']),
                'country_code' => $value['country_code'],
                'phone_number' => $value['phone_number'],
                'firstname' => !empty($value['firstname']) ? $value['firstname'] : ' ',
                'lastname' => !empty($value['lastname']) ? $value['lastname'] : ' ',
                'address' => !empty($value['address']) ? $value['address'] : null,
                'address2' => $value['address2'],
                'pincode' => $value['pincode'],
                'country' => $country,
                'state' => $state,
                'city' => !empty($value['city']) ? $value['city'] : 0,
                'dob' => !empty($value['dob']) ? $value['dob'] : 0,
                'user_type_id' => !empty($value['user_type_id']) ? $value['user_type_id'] : 0,
                'profile_id' => !empty($value['profile_id']) ? $value['profile_id'] : 0,
                'mdl_user' => !empty($value['mdl_user']) ? $value['mdl_user'] : 0,
                'remember_token' => !empty($value['remember_token']) ? $value['remember_token'] : 0,
                'user_type_id' => !empty($value['user_type_id']) ? $value['user_type_id'] : 0,
                'profile_id' => !empty($value['profile_id']) ? $value['profile_id'] : 0,
            ];

            $validator = Validator::make($value->toArray(), [
                'old_id' => 'required|integer',
                'name' => 'required|unique:'.User::class,
                'email' => 'nullable|unique:users,email',
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:'.User::class,
                // 'country_code' => 'required|exists:country_codes,code',
                'password' => 'required',
            ]);

   
            // if($value['country_code']){
            //     switch($value['country_code']){
            //         case '91':
            //             $validator->after(function ($validator) use ($data) {
            //                 if(strlen($data['phone_number']) != 10  ){
            //                     $validator->errors()->add('phone_number', 'The phone number must be  10 characters long for country code +91.');
            //                 }
            //             });
            //         break;
            //         case '971':
            //             $validator->after(function ($validator) use ($data) {
            //                 if(strlen($data['phone_number']) != 7){
            //                     $validator->errors()->add('phone_number', 'The phone number must be  7 characters long for country code +971.');
            //                 }
            //             });
            //         break;
            //         case '974':                
            //             $validator->after(function ($validator) use ($data) {
            //                 if(strlen($data['phone_number']) != 8 ){
            //                     $validator->errors()->add('phone_number', 'The phone number must be  3 characters long for country code +974.');
            //                 }
            //             });
            //         break;
            //         case '968':      
    
            //        $validator->after(function ($validator) use ($data) {
            //                 if(strlen($data['phone_number']) != 8 ){
            //                     $validator->errors()->add('phone_number', 'The phone number must be  8 characters long for country code +968.');
            //                 }
            //             });
            //         break;
            //         case '966':                  
            //             $validator->after(function ($validator) use ($data) {
            //                 if(strlen($data['phone_number']) != 9  ){
            //                     $validator->errors()->add('phone_number', 'The phone number must be  9 characters long for country code +966.');
            //                 }
            //             });
            //         break;
            //         case '973':                   
            //             $validator->after(function ($validator) use ($data) {
            //                 if(strlen($data['phone_number']) != 8 ){
            //                     $validator->errors()->add('phone_number', 'The phone number must be  8 characters long for country code +973.');
            //                 }
            //             });
            //         break;
            //         case '965':                 
            //             $validator->after(function ($validator) use ($data) {
            //                 if(strlen($data['phone_number']) != 8 ){
            //                     $validator->errors()->add('phone_number', 'The phone number must be 8 characters long for country code +965.');
            //                 }
            //             });
            //         break;                      
            //     }
    

            // }
    
    
           $response['values'] = $data;
            $response['values']['password'] = $value['password'];
            if ($validator->fails()) {
                $response['has_errors'] = true;
                $response['errors'] = $validator->errors();
                $this->imported[] = $response;
                continue;
            }

            if (empty($user)) {
                $user = User::create($data);
                $user->created_at = !empty($value['created_on']) ? $value['created_on'] : time();
                $user->save();

                if ($user) {
                    $message = "User having old_id". $value['old_id'] ." has been created";
                    Log::info($message);

                    $conditions = ['component' => 'Users', 'component_status' => 'created', 'raw_data' => serialize($value), 'inserted_data' => serialize($data), 'status' => 1];
                    MigrationLogs::create($conditions);
                }

                $user->assignRole('subscriber');

                $message = "Role Subscriber is assigned to the User having old_id". $value['old_id'];
                Log::info($message);
            } else {
                $response['values'] = $data;
                $data['dob'] = Carbon::parse($data['dob'])->timestamp;
                unset($data['email']); 
                unset($data['phone_number']); 
                
                $user->update($data);
                $user->created_at = !empty($value['created_on']) ? $value['created_on'] : time();
                $user->save();

                $message = "User having old_id". $value['old_id'] ." is Updated";
                Log::info($message);

                $conditions = ['component' => 'Users', 'component_status' => 'updated', 'raw_data' => serialize($value), 'inserted_data' => serialize($data), 'status' => 1];
                MigrationLogs::create($conditions);
            }

            $response['errors'] = [];
            $response['has_errors'] = false;
            $this->imported[] = $response;
        }
    }

    public function validate($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|unique:'.User::class,
            'email' => 'nullable|unique:users,email',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            // 'country_code' => 'required|exists:country_codes,code',
            'password' => 'required',
        ]);
        // if($data['country_code']){
        //     switch($data['country_code']){
        //         case '91':
        //             $validator->after(function ($validator) use ($data) {
        //                 if(strlen($data['phone_number']) != 10  ){
                        
        //                     $validator->errors()->add('phone_number', 'The phone number must be  10 characters long for country code +91.');
        //                 }
        //             });
        //         break;
        //         case '971':
        //             $validator->after(function ($validator) use ($data) {
        //                 if(strlen($data['phone_number']) != 7 ){
        //                     $validator->errors()->add('phone_number', 'The phone number must be  5 characters long for country code +971.');
        //                 }
        //             });
        //         break;
        //         case '974':                
        //             $validator->after(function ($validator) use ($data) {
        //                 if(strlen($data['phone_number'])  != 8  ) {
        //                     $validator->errors()->add('phone_number', 'The phone number must be  3 characters long for country code +974.');
        //                 }
        //             });
        //         break;
        //         case '968':
                    

        //        $validator->after(function ($validator) use ($data) {
        //                 if(strlen($data['phone_number'])  != 8  ){
        //                     $validator->errors()->add('phone_number', 'The phone number must be  8 characters long for country code +968.');
        //                 }
        //             });
        //         break;
        //         case '966':                  
        //             $validator->after(function ($validator) use ($data) {
        //                 if(strlen($data['phone_number'])  != 9  ){
        //                     $validator->errors()->add('phone_number', 'The phone number must be  9 characters long for country code +966.');
        //                 }
        //             });
        //         break;
        //         case '973':                   
        //             $validator->after(function ($validator) use ($data) {
        //                 if(strlen($data['phone_number'])  != 8 ){
        //                     $validator->errors()->add('phone_number', 'The phone number must be  8 characters long for country code +973.');
        //                 }
        //             });
        //         break;
        //         case '965':                 
        //             $validator->after(function ($validator) use ($data) {
        //                 if(strlen($data['phone_number'])  != 8  ){
        //                     $validator->errors()->add('phone_number', 'The phone number must be  8 characters long for country code +965.');
        //                 }
        //             });
        //         break;                      
        //     }
        // }


        return $validator;
    }

    public function rules(): array
    {
        $rules =  [
            '*.name' => 'required',
            '*.email' => 'nullable|unique:users,email',
            '*.phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            // '*.country_code' => 'required|exists:country_codes,code',
            '*.password' => 'required',
        ];
        // switch ('*.country_code') {
        //     case '91':
        //         $rules['phone_number'] .= '|digits:10';
        //         break;
        //     case '971':
        //         $rules['phone_number'] .= '|digits:7';
        //         break;
        //     case '974':
        //         $rules['phone_number'] .= '|digits:8';
        //         break;
        //     case '968':
        //         $rules['phone_number'] .= '|digits:8';
        //             break;                    
        //     case '966':
        //         $rules['phone_number'] .= '|digits:9';
        //         break;
        //     case '973':
        //         $rules['phone_number'] .= '|digits:8';
        //         break;
        //     case '965':
        //          $rules['phone_number'] .= '|digits:8';
        //          break;       

        // }

        return $rules;
    }

    public function customValidationMessages()
    {
        return  [
            'name.required' => 'Name is required',
            'name.unique' => 'Duplicate username',
            'email.unique' => 'Duplicate Email',
            'phone_number.required' => 'Phonenumber is required',
            'phone_number.regex' => 'Invalid Phonenumber',
            'phone_numer.min' => 'Invalid Phonenumber',
            'password.required' => 'Password is required',
        ];

    }

    public function onFailure(Failure ...$failures)
    {
        // Handle the exception how you'd like.
        $this->failed_imports = array_merge($this->failed_imports, $failures);
    }
}
