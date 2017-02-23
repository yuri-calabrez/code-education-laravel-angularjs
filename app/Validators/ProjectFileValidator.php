<?php

namespace CodeProject\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:255',
            'description' => 'required',
            'project_id' => 'required',
            'file' => 'required|max:2000|mimes:jpeg,jpg,png,pdf,zip'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:255',
            'description' => 'required',
            'project_id' => 'required',
        ]
    ];
}