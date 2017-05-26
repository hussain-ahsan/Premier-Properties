<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Interfaces\SaveObjectsInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use App\Roles;

class User extends Authenticatable implements SaveObjectsInterface
{
    /**
     *The attributes that is used to define table name for this model.
     */
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'address', 'city', 'state',
        'zip', 'payment_address', 'payment_city', 'payment_state', 'payment_zip', 'home_phone', 'cell_phone', 'work_phone', 'fax_phone', 'email',
        'email2', 'password', 'password_expire_date', 'created_by', 'last_login', 'permanent', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * This method is used to format the created_at date.
     * @param $value
     * @return string
     */
    protected function getCreatedAtAttribute($value)
    {
        return CommonService::getDate($value, env('DATE_FORMAT'));
    }

    /**
     * This method is used to format the password_expire_date date.
     * @param $value
     * @return string
     */
    protected function getPasswordExpireDateAttribute($value)
    {
        return CommonService::getDate($value, env('DATE_FORMAT'));
    }

    /**
     * This method is used to format the last_login date.
     * @param $value
     * @return string
     */
    protected function getLastLoginAttribute($value)
    {
        return CommonService::getDate($value, env('DATE_FORMAT'));
    }

    /**
     * This method is set the password_expire_date format to save in database
     * @param $value
     */
    protected function setPasswordExpireDateAttribute($value)
    {
        $this->attributes['password_expire_date'] = CommonService::setDate($value, "Y-m-d H:i:s");
    }

    /**
     * The roles that belongs to user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Roles', 'user_roles', 'user_id', 'role_id');
    }

    /**
     * The companies that belongs to user
     * @return $this
     */
    public function companies()
    {
        return $this->belongsToMany('App\Company', 'user_companies', 'user_id', 'company_id')->withPivot('percent_owned');
    }

    /**
     * The user that created company
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companyCreatedByUser()
    {
        return $this->hasMany('App\Company', 'created_by');
    }

    /**
     * The reports that belongs to user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\UserReports', 'user_id');
    }

    /**
     * The user that created property reports
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propertyReportsCreatedByUser()
    {
        return $this->hasMany('App\PropertyReports', 'created_by');
    }

    /**
     * The user that created the user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdByUser()
    {
        return $this->hasMany('App\User', 'id', 'created_by');
    }

    /**
     * Permissions of Users
     * @param $permission
     * @return mixed
     */
    public function hasPermission($permission)
    {
        foreach ($this->roles()->get() as $role) {
            $result = Roles::where('name', '=', $role->name)->first()->hasPermissionRole($permission);
            return $result;
        }
    }

    /**
     * @param $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == $roleName) {
                return true;
            } else {
                return false;
            }
        }
    }


    /**
     * This method is used to set values for User model object
     * @param $modelObject
     * @param $values
     * @param int $update
     * @return mixed
     */
    public function setObjectValues($modelObject, $values, $update = 0)
    {
        $modelObject['first_name']              = $values['first_name'];
        $modelObject['last_name']               = $values['last_name'];
        $modelObject['address']                 = $values['address'];
        $modelObject['city']                    = $values['city'];
        $modelObject['state']                   = $values['state'];
        $modelObject['zip']                     = $values['zip'];
        $modelObject['payment_address']         = $values['payment_address'];
        $modelObject['payment_city']            = $values['payment_city'];
        $modelObject['payment_state']           = $values['payment_state'];
        $modelObject['payment_zip']             = $values['payment_zip'];
        $modelObject['home_phone']              = $values['home_phone'];
        $modelObject['cell_phone']              = $values['cell_phone'];
        $modelObject['work_phone']              = $values['work_phone'];
        $modelObject['fax_phone']               = $values['fax_phone'];
        $modelObject['email']                   = $values['email'];
        $modelObject['email2']                  = $values['email2'];
        if ($update == 0) {
            $modelObject['password']            = bcrypt($values['password']);
            $modelObject['created_by']          = Auth::user()->id;
        }
        $modelObject['password_expire_date']    = $values['password_expire_date'];
        $modelObject['permanent']               = (int)$values['permanent'];
        $modelObject['status']                  = $values['status'] != "" ? (int)$values['status'] : env('USER_STATUS');

        return $modelObject;
    }


    /**
     * This method is used to save the User model's object
     * @param $modelObject
     * @return mixed
     */
    public function saveObject($modelObject)
    {
        $modelObject->save();
        return $modelObject;
    }


    /**
     * This method is used to save new record of User in database
     * @param $request
     * @return Collection
     */
    public function saveUserRecord($request)
    {
        $fileTypeResult = CommonService::checkFileType('userReport', config('app.allowedFileTypeArray'));
        if ($fileTypeResult) {
            $userObject = $this->setObjectValues(new User(), $request);
            $saveUser = $this->saveObject($userObject);
            $this->assignRole($saveUser, $request['role']);
            $this->assignCompany($saveUser, json_decode($request['companyDataArray']));
            if($request->hasFile('userReport')){
                $this->saveUserReports($saveUser, $request['reportTitle']);
            }
            $userResult = collect(['status' => 'success', 'userObject' => $saveUser]);
        } else {
            $userResult = collect(['status' => 'fail', 'message' => 'Invalid file extension']);
        }
        return $userResult;
    }


    /**
     * This method is used to update existing record of User in database
     * @param $request
     * @return Collection
     */
    public function updateUserRecord($request)
    {
        $userResult = collect(['status' => 'fail', 'message' => 'Nothing to update']);
        if (!empty($request['user_id'])) {
            if ($request['user_id'] == Auth::user()->id && $request['status'] == 0) {
                $userResult = collect(['status' => 'fail', 'message' => 'User cannot deactivate himself', 'bit' => 2]);
            } else {
                $fileTypeResult = CommonService::checkFileType('userReport', config('app.allowedFileTypeArray'));
                if ($fileTypeResult) {
                    $userObject = $this->setObjectValues($this::find($request['user_id']), $request, 1);
                    $saveUser = $this->saveObject($userObject);
                    $this->removeRole($saveUser);
                    $this->assignRole($saveUser, $request['role']);
                    $this->removeCompany($saveUser);
                    $this->assignCompany($saveUser, json_decode($request['companyDataArray']));
                    if($request->hasFile('userReport')){
                        $this->saveUserReports($saveUser, $request['reportTitle']);
                    }
                    $userResult = collect(['status' => 'success', 'userObject' => $saveUser]);
                } else {
                    $userResult = collect(['status' => 'fail', 'message' => 'Invalid file extension']);
                }
            }
        }
        return $userResult;
    }


    /**
     * This method is used to login existing User
     * @param $request
     * @return Collection
     */
    public function loginUser($request)
    {
        $remember = $request['remember'] ? $request['remember'] : 0; /*use for remember me functionality*/
        $email = $request['email'];
        $password = $request['password'];
        $active_status = env('USER_STATUS');
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            if (Auth::User()->status != $active_status) {
                Auth::logout();
                return collect(['status' => 'failure', 'message' => 'Your account is deactivated..!']);
            }
            if (!Auth::User()->permanent || Auth::User()->permanent < 1  && strtotime(Auth::User()->password_expire_date) < 0) {
                return collect(['status' => 'success', 'redirectTo' => '/home']); // logout the user if not permanent and the password is expired
            }
            if (Auth::User()->permanent != 1 && Auth::User()->password_expire_date < Carbon::now()) {
                Auth::logout();
                return collect(['status' => 'failure', 'message' => 'Your password is expired..!']);
            }
            return collect(['status' => 'success', 'redirectTo' => '/home']);
        }
        return collect(['status' => 'failure', 'message' => 'Invalid Credentials']);
    }


    /**
     * This method is used to update the logout time of user
     */
    public function updateLogoutTime()
    {
        $user = Auth::User();
        $user->last_login = Carbon::now();
        $user->save();
    }

    /**
     * This method is used to logout the user
     **/
    public function logoutUser()
    {
        $this->updateLogoutTime();
        Auth::logout();
    }

    /**
     * Assign a role to the user
     * @param $role
     * @return mixed
     */
    public function assignRole($userObject, $role)
    {
        $userObject->roles()->attach($role);
        return $userObject;
    }

    /**
     * Remove all roles from a user
     * @param $role
     * @return mixed
     */
    public function removeRole($userObject)
    {
        $userObject->roles()->detach();
        return $userObject;
    }

    /**
     * Assign a Company to the User
     * @param $company
     * @return mixed
     */
    public function assignCompany($userObject, $company)
    {
        foreach ($company as $companyData) {
            $userObject->companies()->attach($companyData->id, ['percent_owned' => $companyData->percentOwned]);
        }
        return $userObject;
    }

    /**
     * Remove all Companies from a User
     * @param $company
     * @return mixed
     */
    public function removeCompany($userObject)
    {
        $userObject->companies()->detach();
        return $userObject;
    }


    /**
     * This method is used to save user reports
     * @param $userObject
     * @param $reportTitle
     * @return mixed
     */
    public function saveUserReports($userObject, $reportTitle)
    {
        $reportName = CommonService::uploadFile('userReport', env('USER_REPORT_UPLOAD_PATH'));
        $userObject->reports()->create([
            'report' => $reportName,
            'report_date' => Carbon::now(),
            'report_title' => $reportTitle,
            'created_by' => $userObject['created_by'],
        ]);
        return $userObject;
    }


    /**
     * This method is used fetch users information along company and role
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function fetchUsersAndRelatedData()
    {
        $usersAndRelatedData = $this::with(array(
            'roles', 'companies', 'createdByUser', 'companies.properties' => function ($query) {
                $query->select('name');
            }))->orderBy('updated_at', 'desc')->get();
        return $usersAndRelatedData;
    }

    /**
     * This method is used reset user password
     * @param $request
     * @return Collection
     */
    public function resetPassword($request)
    {
        $userResult = collect(['status' => 'fail', 'message' => 'Something went wrong while reset password']);
        if (!empty($request['user_id']) && !empty($request['reset_password'])) {
            $user = $this::find($request['user_id']);
            $user->password = bcrypt($request['reset_password']);
            $saveUser = $this->saveObject($user);
            $userResult = collect(['status' => 'success', 'message' => $saveUser]);
        }
        return $userResult;
    }

}
