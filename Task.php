<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends BaseModel
{
    use SoftDeletes;

    /**
     * Declare rules for validation
     *
     * @var array|null
     */
    protected $rules = [
        'content' => 'required',
        'status' => 'required'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'status', 'order'
    ];


    /******************************************************************
     * MODEL RELATIONSHIPS
     ******************************************************************/




    /******************************************************************
     * ATTRIBUTE ACCESSORS
     ******************************************************************/



    /******************************************************************
     * ATTRIBUTE MUTATORS
     ******************************************************************/



    /******************************************************************
     * CUSTOM  PROPERTIES
     ******************************************************************/



    /******************************************************************
     * CUSTOM ORM METHODS
     ******************************************************************/


    /******************************************************************
     * MODEL BOOT METHOD
     ******************************************************************/

}
