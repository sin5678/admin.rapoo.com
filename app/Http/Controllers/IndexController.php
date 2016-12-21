<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommonService;
use App\Services\ArticleService;
use App\Http\Controllers\AbstractController as AbstractController;
class IndexController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {	
        return view('index.index');
    }

    
}//