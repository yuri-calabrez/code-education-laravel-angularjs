<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 06/12/2016
 * Time: 19:29
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required|max:255',
        'start_date' => 'required|date',
        'due_date' => 'date',
        'status' => 'required|integer'
    ];
}