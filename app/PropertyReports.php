<?php

namespace App;

use App\Interfaces\SaveObjectsInterface;
use Illuminate\Database\Eloquent\Model;
use App\Services\CommonService;

class PropertyReports extends Model implements SaveObjectsInterface
{
    /**
     *The attributes that is used to define table name for this model.
     **/
    protected $table = "property_reports";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'comments', 'notify_investor', 'date', 'created_by', 'file_name', 'property_id'
    ];

    /**
     * This method is set the date format to save in database
     * @param $value
     */
    protected function setDateAttribute($value)
    {
        $this->attributes['date'] = CommonService::setDate($value, "Y-m-d H:i:s");
    }

    /**
     * This method is used to format the date value.
     * @param $value
     * @return string
     */
    protected function getDateAttribute($value)
    {
        return CommonService::getDate($value, env('DATE_FORMAT'));
    }

    /**
     * The reports that belongs to property.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function propertyReports()
    {
        return $this->belongsTo('App\Property', 'property_id');
    }

    /**
     * The reports that created by user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reportsCreatedByUser()
    {
        return $this->belongsTo('App\User', 'created_by');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Notifications', 'property_report_id');
    }

    /**
     * This method is used to set values for PropertyReports model object
     * @param $modelObject
     * @param $values
     * @param int $update
     * @return mixed
     */
    public function setObjectValues($modelObject, $values)
    {
        $modelObject['name']                = $values['name'];
        $modelObject['comments']            = $values['comments'];
        $modelObject['notify_investor']     = $values['notify_investor'] ? $values['notify_investor'] : 0;
        $modelObject['date']                = $values['date'];
        $modelObject['file_name']           = $values['new_file_name'];
        $modelObject['created_by']          = \Auth::user()->id;
        $modelObject['property_id']         = $values['property_id'];

        return $modelObject;
    }

    /**
     * This method is used to save the PropertyReports model's object
     * @param $modelObject
     * @return mixed
     */
    public function saveObject($modelObject)
    {
        $modelObject->save();
        return $modelObject;
    }

    /**
     * This method is used to save new record of PropertyReports in database
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function savePropertyReportsRecord($request)
    {
        $fileTypeResult = CommonService::checkFileType('file_name', config('app.allowedFileTypeArray'));
        if ($fileTypeResult) {
            $request['new_file_name'] = CommonService::uploadFile('file_name', env('PROPERTY_REPORT_UPLOAD_PATH'));
            $propertyReportsObject = $this->setObjectValues(new PropertyReports(), $request);
            $savePropertyReports = $this->saveObject($propertyReportsObject);
            if ($savePropertyReports['notify_investor'] == 1) {
                $this->saveNotifications($propertyReportsObject);
            }
            $propertyReportsResult = collect(['status' => 'success', 'propertyReportsObject' => $savePropertyReports]);
        } else {
            $propertyReportsResult = collect(['status' => 'fail', 'message' => 'Invalid file extension']);
        }
        return $propertyReportsResult;
    }

    /**
     * This method is used to save existing record of PropertyReports in database
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function updatePropertyReportsRecord($request)
    {
        $propertyReportsResult = collect(['status' => 'fail', 'message' => 'Nothing to update']);
        if (!empty($request['id'])) {
            $propertyReports = $this::find($request['id']);
            $fileTypeResult = CommonService::checkFileType('file_name', config('app.allowedFileTypeArray'));
            if ($fileTypeResult) {
                $request['new_file_name'] = CommonService::uploadFile('file_name', env('PROPERTY_REPORT_UPLOAD_PATH'));
                if(empty($request['new_file_name']) && !empty($propertyReports['file_name'])){
                    $request['new_file_name'] = $propertyReports['file_name'];
                }
                if (!empty($request['new_file_name']) && !empty($propertyReports['file_name'])) {
                    CommonService::unlinkFile(public_path() . env('PROPERTY_REPORT_UPLOAD_PATH') . $propertyReports['file_name']);
                }
                $propertyReportsObject = $this->setObjectValues($propertyReports, $request);
                $savePropertyReports = $this->saveObject($propertyReportsObject);
                if ($savePropertyReports['notify_investor'] == 1) {
                    $this->removeNotifications($propertyReportsObject);
                    $this->saveNotifications($propertyReportsObject);
                }
                $propertyReportsResult = collect(['status' => 'success', 'propertyReportsObject' => $savePropertyReports]);
            } else {
                $propertyReportsResult = collect(['status' => 'fail', 'message' => 'Invalid file extension']);
            }
        }
        return $propertyReportsResult;
    }

    /**
     * Save notifications
     * @param $propertyReportsObject
     * @return mixed
     */
    public function saveNotifications($propertyReportsObject)
    {
        $property = new Property();
        $allInvestors = $property->fetchPropertyInvestors($propertyReportsObject['property_id']);
        foreach ($allInvestors[0]->companies as $company) {
            foreach ($company->investors as $investor) {
                $propertyReportsObject->notifications()->create([
                    'property_id' => $propertyReportsObject['property_id'],
                    'user_id' => $investor->id
                ]);
            }
        }
        return $propertyReportsObject;
    }

    /**
     * Delete notifications
     * @param $propertyReportsObject
     * @return mixed
     */
    public function removeNotifications($propertyReportsObject)
    {
        return $propertyReportsObject->notifications()->delete();
    }

}
