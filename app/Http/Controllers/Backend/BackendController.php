<?php

namespace App\Http\Controllers\Backend ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{

    protected $limit = 5;
    public function __construct()
    {
        $this->middleware('auth');
    }

}
