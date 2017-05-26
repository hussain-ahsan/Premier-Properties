<?php

namespace App\Http;

if (! function_exists('userCompany')) {

    function userCompany($companies)
    {
        $companyLength = count($companies);
        $companyName = 'N/A';
        if($companyLength == 1){
            $companyName = $companies[0]->name;
        }else if($companyLength > 1){
            $companyName = 'Multiple';
        }
        return $companyName;
    }
}

if (! function_exists('userProperty')) {

    function userProperty($companies)
    {
        $companyLength = count($companies);
        $propertyLength = 'N/A';
        if($companyLength > 0){
            $propertyLength = 0;
            foreach($companies as $company){
                $propertyLength += count($company->properties);
            }
        }
        return $propertyLength;
    }
}

if (! function_exists('userPasswordExpireDate')) {

    function userPasswordExpireDate($user)
    {
        $pwExpire = ' N/A';
        if($user->permanent == 1){
            $pwExpire = 'Never';
        }else if(!empty($user->password_expire_date)){
            $pwExpire = $user->password_expire_date;
        }
        return $pwExpire;
    }
}

if (! function_exists('createdByUser')) {

    function createdByUser($user)
    {
        return count($user->createdByUser)> 0 ? $user->createdByUser[0]->first_name . ' ' . $user->createdByUser[0]->last_name : 'N/A';
    }
}

if (! function_exists('editUser')) {

    function editUser($user) {
        $companyArray = array();
        foreach($user->companies as $company){
            $companyObject = new \stdClass();
            $companyObject->id = $company->id;
            $companyObject->name = $company->name;
            $companyObject->percentOwned = $company->pivot->percent_owned;
           array_push($companyArray, $companyObject);
        }
      $jsonObject = array(
          "user_id" => $user->id,
          "first_name" => $user->first_name,
          "last_name" => $user->last_name,
          "address" => $user->address,
          "city" => $user->city,
          "state" => $user->state,
          "zip" => $user->zip,
          "home_phone" => $user->home_phone,
          "cell_phone" => $user->cell_phone,
          "work_phone" => $user->work_phone,
          "fax_phone" => $user->fax_phone,
          "email" => $user->email,
          "email2" => $user->email2,
          "payment_address" => $user->payment_address,
          "payment_city" => $user->payment_city,
          "payment_state" => $user->payment_state,
          "payment_zip" => $user->payment_zip,
          "password_expire_date" => $user->password_expire_date,
          "permanent" => $user->permanent,
          "role" => count($user->roles) > 0 ? $user->roles[0]->id: '',
          "status" => $user->status,
          "companyObject" => $companyArray
    );
    $data = json_encode($jsonObject);
    return $data;
  }
}