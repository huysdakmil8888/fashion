<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends NewsController
{
    protected $pathViewController = '';
    protected $controllerName     = '';
    protected $params             = [];
    protected $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
        $this->params["pagination"]["totalItemsPerPage"] = 6;
    }

 
}