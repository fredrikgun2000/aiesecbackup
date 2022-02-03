<?php

namespace App\Http\Controllers\Internal\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Fees;

class FeeController extends Controller
{

    public function indexfee()
    {
        return view('/internal/projects/fees/index');
    }

    public function readfee(Request $request)
    {   
        $id = base64_decode($request['id']);

        if(!empty($id)){
            $datas = fees::join('projects','fees.project_id','=','projects.id')->select('fees.*','projects.title AS project_title')->where('project_id',$id)->get();
        }else{
            $datas = fees::join('projects','fees.project_id','=','projects.id')->select('fees.*','projects.title AS project_title')->get();
        }

        $data = [];
        $no = 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' => $no,
                'fee_id' => $d['id'],
                'project_title' => $d['project_title'],
                'fee_title' => $d['title'],
                'description' => $d['description'],
                'price' => $d['price'],
            );
        }

        $pesan = 'Read fee Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function createfee(Request $request)
    {
        $project_id = $request['project_id'];
        $title = $request['title'];
        $description = $request['description'];
        $price = $request['price'];


		$validator = Validator::make($request->all(), [
			'project_id' => 'required',
			'title' => 'required',
			'description' => 'required',
			'price' => 'required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $data = array(
            'project_id' => $request['project_id'],
            'title' => $request['title'],
            'description' => $request['description'],
            'price' => $request['price'],
        );

        Fees::create($data);
        
        $pesan = 'Insert Fee Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function editfee(Request $request)
    {
        $fee_id = $request['fee_id'];

        $validator = Validator::make($request->all(), [
			'fee_id' => 'required',
        ],[
            'required' => 'please replace your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $d = Fees::where('id',$fee_id)->first();

        $data = array(
            'fee_id' => $d['id'],
            'project_id' => $d['project_id'],
            'title' => $d['title'],
            'description' => $d['description'],
            'price' => $d['price'],
        );

        $pesan = 'Get Specific Activity Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updatefee(Request $request)
    {
        $fee_id = $request['fee_id'];
        $project_id = $request['project_id'];
        $title = $request['title'];
        $description = $request['description'];
        $price = $request['price'];

        $validator = Validator::make($request->all(), [
			'fee_id' => 'required',
			'project_id' => 'required',
			'title' => 'required',
			'description' => 'required',
			'price' => 'required',
        ],[
            'fee_id.required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $data = array(
            'project_id' => $project_id,
            'title' => $title,
            'description' => $description,
            'price' => $price,
        );

        Fees::where('id',$fee_id)->update($data);
        
        $pesan = 'Update Fee Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deletefee(Request $request)
    {
        $fee_id = $request['fee_id'];

        Fees::where('id',$fee_id)->delete();
        $data = [];
        $pesan = 'Delete Fee Data Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }
}
