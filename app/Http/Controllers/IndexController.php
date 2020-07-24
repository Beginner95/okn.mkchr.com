<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Filter;
use App\Http\UploadFile;
use Illuminate\Http\Request;
use App\Okn;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $objects = Okn::where('isComplex', null)->orderBy('id', 'desc');
        $objects = (new Filter($objects, $request))->apply();
        $limit = $request['limit'];
        $objects = $objects->paginate($limit);
        $limits = [20, 30, 40, 50];

        return view('user.okn.index', compact('objects', 'limits'));
    }

    public function create()
    {
        return view('user.okn.create');
    }

    public function store(Request $request)
    {
        $complex_id = ComplexController::getComplexId($request['complex']);
        $district_id = DistrictController::getDistrictId($request['district']);
        $fileObj = new UploadFile();
        $file = null;

        if (!empty($request->file)) {
            $file = $fileObj->uploadFile($request->file);
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $okn = Okn::where('id', $id)->first();
        if (!empty($okn->isComplex)) {
            return redirect('/complex/' . $id . '/edit');
        }
        return view('user.okn.edit', compact('okn'));
    }

    public function update(Request $request, $id)
    {
        $okn = Okn::where('id', $id)->first();
        $complex_id = ComplexController::getComplexId($request['complex']);
        $district_id = DistrictController::getDistrictId($request['district']);

        $fileObj = new UploadFile();

        if (!empty($request->file)) {
            $okn->file = $fileObj->uploadFile($request->file);
        } else {
            if (empty($request['file-name'])) {
                $fileObj->deleteCurrentFile($okn->file);
                $okn->file = null;
            }
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

        if (!empty($request['is-complex'])) {
            $okn->isComplex = 1;
        }

        $okn->save();
        return redirect('/');
    }

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
}
