<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 06/12/2016
 * Time: 19:29
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required|max:255',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required|date'
    ];
}