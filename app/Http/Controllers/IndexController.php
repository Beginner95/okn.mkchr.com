<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\UploadFile;
use Illuminate\Http\Request;
use App\Okn;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request['limit'];
        $objects = Okn::paginate($limit);
        $limits = [20, 30, 40, 50];

        return view('user.okn.index', compact('objects', 'limits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.okn.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $complex_id = $this->getComplexId($request['complex']);
        $district_id = $this->getDistrictId($request['district']);

        $file = null;
        if (!empty($request->file)) {
            $file = $this->getFileName($request->file);
        }


        $okn = new Okn();
        $okn->name = $request['okn-name'];
        $okn->name_chr = $request['okn-name-chr'];
        $okn->complex_id = $complex_id;
        $okn->date_okn = $request['date-okn'];
        $okn->act = $request['act'];
        $okn->district_id = $district_id;
        $okn->address = $request['address'];
        $okn->category = $request['category'];
        $okn->owner = $request['owner'];
        $okn->latitude = $request['latitude'];
        $okn->longitude = $request['longitude'];
        $okn->sum_npd = $request['sum-npd'];
        $okn->start_job = $request['start-job'];
        $okn->end_job = $request['end-job'];
        $okn->finance = $request['finance'];
        $okn->npd = $request['npd'];
        $okn->state = $request['state'];
        $okn->status = $request['status'];
        $okn->comment = $request['comment'];
        $okn->file = $file;

        if (!empty($request['is-complex'])) {
            $okn->isComplex = 1;
        }

        $okn->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $okn = Okn::where('id', $id)->first();
        if (!empty($okn->isComplex)) {
            return redirect('/complex/' . $id . '/edit');
        }
        return view('user.okn.edit', compact('okn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $okn = Okn::where('id', $id)->first();
        $complex_id = $this->getComplexId($request['complex']);
        $district_id = $this->getDistrictId($request['district']);

        $file = null;
        if (!empty($request->file)) {
            $file = $this->getFileName($request->file);
        } else {
            $this->deleteFile($okn->file);
        }

        $okn->name = $request['okn-name'];
        $okn->name_chr = $request['okn-name-chr'];
        $okn->complex_id = $complex_id;
        $okn->date_okn = $request['date-okn'];
        $okn->act = $request['act'];
        $okn->district_id = $district_id;
        $okn->address = $request['address'];
        $okn->category = $request['category'];
        $okn->owner = $request['owner'];
        $okn->latitude = $request['latitude'];
        $okn->longitude = $request['longitude'];
        $okn->sum_npd = $request['sum-npd'];
        $okn->start_job = $request['start-job'];
        $okn->end_job = $request['end-job'];
        $okn->finance = $request['finance'];
        $okn->npd = $request['npd'];
        $okn->state = $request['state'];
        $okn->status = $request['status'];
        $okn->comment = $request['comment'];
        $okn->file = $file;

        if (!empty($request['is-complex'])) {
            $okn->isComplex = 1;
        }

        $okn->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $okn = Okn::where('id', $id)->first();
        $this->deleteFile($okn->file);
        $statusDelete = $okn->delete();
        if ($statusDelete === true) {
            return response()->json('ok');
        }
        return response()->json('error');
    }

    public function getComplexId($complexName)
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

    public function getDistrictId($districtName)
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

    public function getFileName($file)
    {
        $fileObj = new UploadFile();
        return $fileObj->uploadFile($file);
    }

    public function deleteFile($file)
    {
        $fileObj = new UploadFile();
        $fileObj->deleteCurrentFile($file);
    }
}
