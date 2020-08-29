<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Filter;
use App\Http\UploadFile;
use Illuminate\Http\Request;
use App\Models\Okn;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('home');
    }
}
