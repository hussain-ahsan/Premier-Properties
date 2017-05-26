<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class States extends Model
{
    /**
     *The attributes that is used to define table name for this model.
     */
    protected $table = "states";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state_name', 'state_code'
    ];

    /**
     * This method is used to get states (static)
     */
    public function getStates()
    {
        $states = States::all();
        return $states;
    }
}
