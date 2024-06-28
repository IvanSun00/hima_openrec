<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Dates;

class DatesController extends BaseController
{
    public function __construct(Dates $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}