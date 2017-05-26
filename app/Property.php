<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use App\Interfaces\SaveObjectsInterface;
use Illuminate\Support\Facades\DB;

class Property extends Model implements SaveObjectsInterface
{
    /**
     *The attributes that is used to define table name for this model.
     */
    protected $table = "properties";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'street_address', 'city', 'state', 'zip', 'lender', 'interest_rate', 'rate_structure', 'mezz_lender',
        'mezz_interest_rate', 'refinance_date', 'refinance_loan_amount', 'refinance_interest_rate',
        'irr', 'holding_period', 'roi', 'original_debt', 'original_equity_investment',
        'current_equity_balance', 'purchased_price', 'original_occupancy_rate', 'current_occupancy_rate',
        'block_lot', 'date_purchase', 'year_built', 'year_renovated', 'lot_area', 'building_type',
        'building_class', 'managed_by', 'market', 'stories',
        'description_investment_property', 'property_investment_status', 'image', 'sale_price', 'property_class',
    ];

    /**
     * This method is used to format the refinance_date date.
     * @param $value
     * @return string
     */
    protected function getRefinanceDateAttribute($value)
    {
        return CommonService::getDate($value, env('DATE_FORMAT'));
    }

    /**
     * This method is used to format the date_purchase date.
     * @param $value
     * @return string
     */
    protected function getDatePurchaseAttribute($value)
    {
        return CommonService::getDate($value, env('DATE_FORMAT'));
    }


    /**
     * This method is used to format the refinance_date date.
     * @param $value
     * @return string
     */
    protected function setRefinanceDateAttribute($value)
    {
        $this->attributes['refinance_date'] = CommonService::setDate($value, "Y-m-d H:i:s");
    }

    /**
     * This method is used to format the created_at date.
     * @param $value
     * @return string
     */
    protected function setDatePurchaseAttribute($value)
    {
        $this->attributes['date_purchase'] = CommonService::setDate($value, "Y-m-d H:i:s");
    }

    /**
     *The companies that belongs to property.
     */
    public function companies()
    {
        return $this->belongsToMany('App\Company', 'company_properties', 'property_id', 'company_id')->withPivot('investment_percent', 'investment_amount');
    }

    /**
     *The reports that belongs to property reports.
     */
    public function reports()
    {
        return $this->hasMany('App\PropertyReports', 'property_id')->orderBy('id', 'desc');
    }

    /**
     *This method is used to set values for property model object
     */
    public function setObjectValues($model_object, $values)
    {
        $model_object['name']                               = $values['property_name'];
        $model_object['street_address']                     = $values['street_address'];
        $model_object['city']                               = $values['city'];
        $model_object['state']                              = $values['state'];
        $model_object['zip']                                = $values['zip'];
        $model_object['lender']                             = $values['lender'];
        $model_object['interest_rate']                      = $values['interest_rate'];
        $model_object['rate_structure']                     = $values['rate_structure'];
        $model_object['mezz_lender']                        = $values['mezz_lender'];
        $model_object['mezz_interest_rate']                 = $values['mezz_interest_rate'];
        $model_object['refinance_date']                     = $values['refinance_date'];
        $model_object['refinance_loan_amount']              = $values['refinance_loan_amount'];
        $model_object['refinance_interest_rate']            = $values['refinance_interest_rate'];
        $model_object['irr']                                = $values['irr'];
        $model_object['holding_period']                     = $values['holding_period'];
        $model_object['roi']                                = $values['roi'];
        $model_object['original_debt']                      = $values['original_debt'];
        $model_object['original_equity_investment']         = $values['original_equity_investment'];
        $model_object['current_equity_balance']             = $values['current_equity_balance'];
        $model_object['purchased_price']                    = $values['purchased_price'];
        $model_object['original_occupancy_rate']            = $values['original_occupancy_rate'];
        $model_object['current_occupancy_rate']             = $values['current_occupancy_rate'];
        $model_object['block_lot']                          = $values['block_lot'];
        $model_object['date_purchase']                      = $values['date_purchase'];
        $model_object['year_built']                         = $values['year_built'];
        $model_object['year_renovated']                     = $values['year_renovated'];
        $model_object['lot_area']                           = $values['lot_area'];
        $model_object['building_type']                      = $values['building_type'];
        $model_object['building_class']                     = $values['building_class'];
        $model_object['managed_by']                         = $values['managed_by'];
        $model_object['market']                             = $values['market'];
        $model_object['stories']                            = $values['stories'];
        $model_object['description_investment_property']    = $values['description_investment_property'];
        $model_object['property_investment_status']         = $values['property_investment_status'];
        $model_object['image']                              = $values['new_image_name'];
        $model_object['sale_price']                         = $values['sale_price'];
        $model_object['property_class']                     = $values['property_class'];
        return $model_object;
    }

    /**
     *This method is used to save the property model's object
     */
    public function saveObject($model_object)
    {
        $model_object->save();
        return $model_object;
    }


    /**
     * This method is used to save property.
     * @param $request
     * @return saved object of property
     */
    public function saveProperty($request)
    {
        $fileTypeResult = CommonService::checkFileType('uploadImage', config('app.allowedFileTypeForImage'));
        if ($fileTypeResult) {
            $request['new_image_name'] = CommonService::uploadFile('uploadImage', env('PROPERTY_IMAGE_PATH'));
            $property_object = $this->setObjectValues(new Property(), $request);
            $property_object = $this->saveObject($property_object);
            $this->attachCompanies($property_object, json_decode($request['companyDataArray']));
            $this->setPropertyImages(env('PROPERTY_IMAGE_PATH'), $request['new_image_name'], $property_object->id);
            $propertyResult = collect(['status' => 'success', 'userObject' => $property_object]);
        } else {
            $propertyResult = collect(['status' => 'fail', 'message' => 'Invalid file extension']);
        }
        return $propertyResult;
    }

    /**
     * This method is used to update existing record of property in database
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function updateProperty($request)
    {
        $propertyResult = collect(['status' => 'fail', 'message' => 'Nothing to update']);
        if (!empty($request['property-dd'])) {
            $propertyOldRecord = Property::find($request['property-dd']);
            $fileTypeResult = CommonService::checkFileType('uploadImage', config('app.allowedFileTypeForImage'));
            if ($fileTypeResult) {
                $request['new_image_name'] = CommonService::uploadFile('uploadImage', env('PROPERTY_IMAGE_PATH'));
                $this->setPropertyImages(env('PROPERTY_IMAGE_PATH'), $request['new_image_name'], $propertyOldRecord->id, $propertyOldRecord['image']);
                if (empty($request['new_image_name']) && !empty($propertyOldRecord['image'])) {
                    $request['new_image_name'] = $propertyOldRecord['image'];
                }
                if (!empty($request['new_image_name']) && !empty($propertyOldRecord['image'])) {
                    CommonService::unlinkFile(public_path() . env('PROPERTY_IMAGE_PATH') . $propertyOldRecord['image']);
                }
                $property_object = $this->setObjectValues($propertyOldRecord, $request);
                $this->saveObject($property_object);
                $this->removeCompany($property_object);
                $this->attachCompanies($property_object, json_decode($request['companyDataArray']));
                $propertyResult = collect(['status' => 'success', 'userObject' => $property_object]);
            } else {
                $propertyResult = collect(['status' => 'fail', 'message' => 'Invalid file extension']);
            }
        }
        return $propertyResult;
    }

    /**
     * This method is used to get complete information about a property
     * @return mixed
     */
    public function getPropertiesForUser()
    {
        $properties = DB::table('properties')
            ->selectRaw('properties.*, notifications.id as notifications_id')
            ->leftJoin('company_properties', 'company_properties.property_id', '=', 'properties.id')
            ->leftJoin('companies', 'companies.id', '=', 'company_properties.company_id')
            ->leftJoin('user_companies', 'user_companies.company_id', '=', 'companies.id')
            ->leftJoin('users', 'users.id', '=', 'user_companies.user_id')
            ->leftJoin('property_reports', 'property_reports.property_id', '=', 'properties.id')
            ->leftJoin('notifications', function ($notificationJoin) {
                $notificationJoin->on('notifications.property_report_id', '=', 'property_reports.id')
                    ->where('notifications.user_id', '=', Auth::User()->id);
            })
            ->where(function ($whereCondition) {
                if (!Auth::User()->hasRole(env('ADMIN_ROLE'))) {
                    $whereCondition->where('users.id', '=', Auth::User()->id);
                }
            })
            ->groupBy('properties.id')
            ->orderBy('properties.updated_at', 'desc')
            ->get();

        return $properties;
    }

    public function attachCompanies($property, $companyDataArray)
    {
        foreach ($companyDataArray as $companyData) {
            $property->companies()->attach($companyData->companyId, ['investment_amount' => $companyData->investmentAmount, 'investment_percent' => $companyData->investmentPercent]);
        }
    }

    /**
     * Remove all Companies from a User
     *
     * @param $company
     * @return mixed
     */
    public function removeCompany($property)
    {
        $property->companies()->detach();
        return $property;
    }

    /**
     * This method is used to fetch all information about a property and its related data.
     * @param $request
     * @return mixed
     */
    public function fetchPropertyRelatedInformation($request)
    {
        $propertyAndRelatedData = $this::with(array(
            'companies.investors' => function ($query) {
                $query->find(Auth::user()->id);
            }, 'reports.notifications' => function ($query) {
                $query->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc');
            }))->where('id', $request->id)->get();
        return $propertyAndRelatedData;
    }

    /**
     * This method is used to fetch all properties.
     * @param string $columnArray
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function fetchProperties($columnArray = '*')
    {
        $properties = Property::all($columnArray);
        return $properties;
    }

    /**
     * This method is used to fetch all investors.
     * @param $request
     * @return mixed
     */
    public function fetchPropertyInvestors($propertyId)
    {
        $propertyInvestors = $this::with(array(
            'companies.investors'))->where('id', $propertyId)->get();
        return $propertyInvestors;
    }

    /**
     * This method is used to resize image, make image thumbnail in different sizes and remove previous image
     * @param $path
     * @param $imageName
     * @param $id
     * @return mixed
     */
    public function setPropertyImages($path, $imageName, $id, $oldImageName = '')
    {
        if(!empty($imageName)){
            $savePath = $path.$id.'/';
            if(!empty($oldImageName)){
                CommonService::unlinkFile(public_path().$path.$id.'/'.$oldImageName);
                CommonService::unlinkFile(public_path().$path.$id.'/'.env('PORTFOLIO_WIDTH').'*'. env('PORTFOLIO_HEIGHT').'_'.$oldImageName);
                CommonService::unlinkFile(public_path().$path.$id.'/'.env('LISTING_WIDTH').'*'. env('LISTING_HEIGHT').'_'.$oldImageName);
                CommonService::unlinkFile(public_path().$path.$id.'/'.env('DETAIL_WIDTH').'*'. env('DETAIL_HEIGHT').'_'.$oldImageName);
            }
            CommonService::resizeImage($path, $imageName, $savePath);
            CommonService::thumbnailImage($savePath, env('PORTFOLIO_WIDTH'), env('PORTFOLIO_HEIGHT'), $imageName);
            CommonService::thumbnailImage($savePath, env('LISTING_WIDTH'), env('LISTING_HEIGHT'), $imageName);
            CommonService::thumbnailImage($savePath, env('DETAIL_WIDTH'), env('DETAIL_HEIGHT'), $imageName);
            CommonService::unlinkFile(public_path().$path.$imageName);
        }
        return $imageName;
    }

}
