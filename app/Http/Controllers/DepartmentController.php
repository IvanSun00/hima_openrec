<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Department;

class DepartmentController extends BaseController
{
    public function __construct(Department $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}