<?php

namespace App\Http\Controllers;

use App\Http\UploadFile;
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
        return view('user.complex.index', compact('objects', 'limits'));
    }

    public function create()
    {
        return view('user.okn.create');
    }

    public function store(Request $request)
    {
        $district_id = DistrictController::getDistrictId($request['district']);
        $fileObj = new UploadFile();
        $file = null;

        if (!empty($request->file)) {
            $file = $fileObj->uploadFile($request->file);
        }

        $complex = new Okn();
        $complex->name = $request['complex-name'];
        $complex->name_chr = $request['complex-name-chr'];
        $complex->isComplex = 1;
        $complex->date_okn = $request['date-complex'];
        $complex->act = $request['act'];
        $complex->district_id = $district_id;
        $complex->address = $request['address'];
        $complex->category = $request['category'];
        $complex->owner = $request['owner'];
        $complex->latitude = $request['latitude'];
        $complex->longitude = $request['longitude'];
        $complex->comment = $request['comment'];
        $complex->file = $file;
        $complex->save();
        return redirect('/complex');
    }

    public function edit($id)
    {
        $okn = Okn::where('id', $id)->first();
        return view('user.okn.edit', compact('okn'));
    }

    public static function getComplexId($complexName)
    {
        if (!empty($complexName)) {
            $complex = new Okn();
            $complex = $complex->getFindByName($complexName);
            $complex = !empty($complex) ? $complex->id : null;
        } else {
            $complex = null;
        }
        return $complex;
    }

    public function autocompleteComplex(Request $request)
    {
        $searchquery = $request->queryString;
        $data = Okn::where('name','like','%'.$searchquery.'%')->get();

        return response()->json($data);
    }
}
