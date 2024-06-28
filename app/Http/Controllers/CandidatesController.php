<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Candidates;

class CandidatesController extends BaseController
{
    public function __construct(Candidates $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}