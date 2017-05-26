<?php

namespace App;

use App\Interfaces\SaveObjectsInterface;
use App\Services\CommonService;
use Illuminate\Database\Eloquent\Model;

class Company extends Model implements SaveObjectsInterface
{
    /**
     *The attributes that is used to define table name for this model.
     */
    protected $table = "companies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ein', 'phone', 'email', 'contact', 'address', 'city', 'states', 'zip', 'created_by'
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
     *The investors that belongs to companies.
     */
    public function investors()
    {
        return $this->belongsToMany('App\User', 'user_companies', 'company_id', 'user_id');
    }

    /**
     *The company that created by user.
     */
    public function companyCreatedByUser()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     *The properties that belongs to company.
     */
    public function properties()
    {
        return $this->belongsToMany('App\Property', 'company_properties', 'company_id', 'property_id');
    }

    /**
     * @return company record along user record who created the company
     */
    public function fetchCompanyRecord()
    {
        $company = $this;
        $company_object = $company::with('companyCreatedByUser')->orderBy('id', 'desc')->get();
        return $company_object;
    }

    /**
     *This method is used to set values for company model object
     */
    public function setObjectValues($model_object, $values)
    {
        $model_object['name']           = $values['name'];
        $model_object['ein']            = $values['ein'];
        $model_object['phone']          = $values['phone'];
        $model_object['email']          = $values['email'];
        $model_object['contact']        = $values['contact'];
        $model_object['address']        = $values['address'];
        $model_object['city']           = $values['city'];
        $model_object['states']         = $values['states'];
        $model_object['zip']            = $values['zip'];
        $model_object['created_by']     = \Auth::user()->id;
        return $model_object;
    }

    /**
     *This method is used to save the company model's object
     */
    public function saveObject($model_object)
    {
        $model_object->save();
        return $model_object;
    }

    /**
     * This method is used to save new record of company in database
     */
    public function saveCompanyRecord($request)
    {
        $company_object = $this->setObjectValues(new Company(), $request);
        return $this->saveObject($company_object);
    }

    /**
     * This method is used to update existing record of company in database
     */
    public function updateCompanyRecord($request)
    {
        $company_object = $this->setObjectValues(Company::find($request['company_id']), $request);
        return $this->saveObject($company_object);
    }

    /**
     * This method is used to fetch all companies
     */
    public function fetchCompanies($columnArray = '*')
    {
        $companies = Company::orderBy('name', 'asc')->get();;
        return $companies;
    }

    /**
     *
     */
    public function companyAssociatedWith()
    {
        $companyData = $this::with(array(
            'investors'
        ))->get();
        return $companyData;
    }

}
