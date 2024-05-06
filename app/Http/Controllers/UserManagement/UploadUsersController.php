<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\SimpleExcel\SimpleExcelReader;

class UploadUsersController extends Controller
{
    public function store(Request $request) {
        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);

        $path = public_path('upload').'/'.$fileName;
        $rows = SimpleExcelReader::create($path)->getRows();
        $totalrows = SimpleExcelReader::create($path)->getRows()->count();
        
        $approved = 0;
        $result = [];

        foreach($rows as $key => $row) {
            $errorslist = self::validateusers($row);
            if (!empty($errorslist)) {
                $row['errorscount'] = COUNT($errorslist);
                $row['error'] = 'Invalid '. implode(',', $errorslist);
                $row['status'] = "Rejected";
                $row['uploadedstatus'] = false;
            } else {
                User::create($row);
                $row['errorscount'] = '-';
                $row['error'] = '-';
                $row['status'] = "Approved";
                $row['uploadedstatus'] = true;
                ++$approved;
            }
            $result[] = $row;
        }
        $approvedrows = $approved;
        $rejectedrows = $totalrows - $approved;

        return ['data' => $result, 'totalrecords' => $totalrows, 'approvedcount' => $approvedrows, 'rejectedcount' => $rejectedrows];
    }
    public function validateusers($users) {
        $errors = [];
        if (User::where('email', $users['email'])->exists()) {
            $errors[] = 'Email';
        }
        if (empty($users['name'])) {
            $errors[] = 'Name';
        }
        if (empty($users['firstname'])) {
            $errors[] = 'Firstname';
        }
        if (empty($users['lastname'])) {
            $errors[] = 'Lastname';
        }
        if (empty($users['phone_number'])) {
            $errors[] = 'Phone number';
        }

        return $errors;
    }
}
