<?php

namespace App\Http\Controllers;

use App\Okn;
use Illuminate\Http\Request;

class ComplexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $limit = $request['limit'];
        $objects = Okn::where('isComplex', '!=', null)->paginate($limit);
        $limits = [2, 10, 20, 30, 40, 50];
        return view('user.okn.index', compact('objects', 'limits'));
    }

    public function create()
    {
        return view('user.okn.create');
    }

    public function edit($id)
    {
        $okn = Okn::where('id', $id)->first();
        return view('user.okn.edit', compact('okn'));
    }

    public function autocompleteComplex(Request $request)
    {
        $searchquery = $request->queryString;
        $data = Okn::where('name','like','%'.$searchquery.'%')->get();

        return response()->json($data);
    }
}
