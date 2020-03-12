<?php

namespace App\Http\Controllers;

use App\Okn;
use Illuminate\Http\Request;

class ComplexController extends Controller
{
    public function create()
    {
        return view('user.okn.create');
    }

    public function autocompleteComplex(Request $request)
    {
        $searchquery = $request->queryString;
        $data = Okn::where('name','like','%'.$searchquery.'%')->get();

        return response()->json($data);
    }
}
