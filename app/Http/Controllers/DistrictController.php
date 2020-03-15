<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function autocompleteDistrict(Request $request)
    {
        $searchquery = $request->queryString;
        $data = District::where('name','like','%'.$searchquery.'%')->get();

        return response()->json($data);
    }
}
