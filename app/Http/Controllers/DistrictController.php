<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public static function getDistrictId($districtName)
    {
        if (!empty($districtName)) {
            $district = District::where('name', $districtName)->first();
            if (!empty($district)) {
                $district = $district->id;
            } else {
                $district = new District();
                $district->name = $districtName;
                $district->save();
                $district = $district->id;
            }
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
