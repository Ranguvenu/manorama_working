<?php

namespace App\Utilities\UserManagement\Users;

use App\Contracts\FilterContract;

class Status implements FilterContract {

    protected $query;

    public function __construct($query) {
        $this->query = $query;
    }

    public function handle($value): void 
    {
       
        if($value > -1){
            $six_months_ago = date('Y-m-d', strtotime("-6 months")); 
            if ($value == 1) {
                $this->query->whereDate('last_login', '>', $six_months_ago)->where('is_deleted', 0);
            } elseif($value == 2) {
                $this->query->whereDate('last_login', '<', $six_months_ago)->where('is_deleted', 0);
            }elseif($value == 3){
                $this->query->where('is_deleted',1);            
            }
        }else{
            $this->query->where('is_deleted',0);     
        }
    }

}
