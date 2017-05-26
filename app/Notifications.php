<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    /**
     *The attributes that is used to define table name for this model.
     */
    protected $table = "notifications";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'property_id', 'property_report_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propertyReports()
    {
        return $this->belongsTo('App\PropertyReports', 'property_report_id');
    }

    /**
     * Delete notifications
     * @param $propertyReportsObject
     * @return mixed
     */
    public function removeNotifications($request)
    {
        if (!empty($request['id']))
            return $this::destroy($request['id']);
        else
            return '';
    }

}