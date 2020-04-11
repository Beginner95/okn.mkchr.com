<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public static function getDistrictId($districtName)
    {
        if (!empty($districtName)) {
            $district = new District();
            $district = $district->getFindByName($districtName);
            $district = !empty($district) ? $district->id : null;
        } else {
            $district = null;
        }
        return $district;
    }

    public function autocompleteDistrict(Request $request)
    {
        $searchquery = $request->queryString;
        $data = District::where('name','like','%'.$searchquery.'%')->get();

        return response()->json($data);
    }
}
