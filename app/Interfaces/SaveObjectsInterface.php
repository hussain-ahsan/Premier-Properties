<?php

namespace App\Interfaces;


/**
 *This interface is used to set values for models object to save or update records
 */
interface SaveObjectsInterface
{

    /**
     *This method is used to set values for model object
     */
    public function setObjectValues($modelObject, $values);

    /**
     *This method is used to save the model's object
     */
    public function saveObject($modelObject);

}