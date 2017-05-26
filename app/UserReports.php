<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReports extends Model
{
    /**
     *The attributes that is used to define table name for this model.
     */
    protected $table = "user_reports";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report', 'report_date', 'created_by', 'report_title'
    ];

    /**
     *The reports that belongs to user.
     */
    public function userReports()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     *This will return the user reports from the user_reports table
     */
    public function getUserReports()
    {
        return $this->where(function($whereCondition){
            if (!\Auth::User()->hasRole(env('ADMIN_ROLE'))) {
                $whereCondition->where('user_id', '=', \Auth::User()->id);
            }
        })->orderBy('id', 'desc')->get();
    }
}
