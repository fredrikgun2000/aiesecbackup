<?php

namespace App\Http\Controllers\Internal\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Activities;

class ActivityController extends Controller
{
    public function indexactivity()
    {
        return view('/internal/projects/activities/index');
    }

    public function readactivity(Request $request)
    {   
        $id = base64_decode($request['id']);

        if(!empty($id)){
            $datas = Activities::join('projects','activities.project_id','=','projects.id')->select('activities.*','projects.title AS project_title')->where('project_id',$id)->get();
        }else{
            $datas = Activities::join('projects','activities.project_id','=','projects.id')->select('activities.*','projects.title AS project_title')->get();
        }

        $data = [];
        $no = 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' => $no,
                'activity_id' => $d['id'],
                'project_title' => $d['project_title'],
                'activity_title' => $d['title'],
                'time' => $d['time'],
                'detail' => $d['detail'],
            );
        }

        $pesan = 'Read Activity Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function createactivity(Request $request)
    {
        $project_id = $request['project_id'];
        $time = $request['time'];
        $title = $request['title'];
        $detail = $request['detail'];


		$validator = Validator::make($request->all(), [
			'project_id' => 'required',
			'time' => 'required',
			'title' => 'required',
			'detail' => 'required',
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
            'time' => $time,
            'title' => $title,
            'detail' => $detail,
        );

        Activities::create($data);
        
        $pesan = 'Insert Activity Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function editactivity(Request $request)
    {
        $activity_id = $request['activity_id'];

        $validator = Validator::make($request->all(), [
			'activity_id' => 'required',
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

        $d = Activities::where('id',$activity_id)->first();

        $data = array(
            'activity_id' => $d['id'],
            'project_id' => $d['project_id'],
            'time' => $d['time'],
            'title' => $d['title'],
            'detail' => $d['detail'],
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

    public function updateactivity(Request $request)
    {
        $activity_id = $request['activity_id'];
        $project_id = $request['project_id'];
        $time = $request['time'];
        $title = $request['title'];
        $detail = $request['detail'];

        $validator = Validator::make($request->all(), [
			'activity_id' => 'required',
			'project_id' => 'required',
			'time' => 'required',
			'title' => 'required',
			'detail' => 'required',
        ],[
            'activity_id.required' => 'Please refresh your page.'
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
            'time' => $time,
            'title' => $title,
            'detail' => $detail
        );

        Activities::where('id',$activity_id)->update($data);
        
        $pesan = 'Update Activities Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleteactivity(Request $request)
    {
        $activity_id = $request['activity_id'];

        Activities::where('id',$activity_id)->delete();
        $data = [];
        $pesan = 'Delete Activity Data Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoveryproject()
    {
        return view('/internal/projects/recovery');
    }
    
    public function readrecoveryproject()
    {
        $datas = Projects::onlyTrashed('deleted_at')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' => $no,
                'project_id' => $d['id'],
                'country_name' => $d['country_name'],
                'description' => $d['description'],
            );
        }

        $pesan = 'Read project Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleterecoveryproject(Request $request)
    {
        $project_id = $request['project_id'];

        $data = [];
        if(!empty($project_id)){
            Projects::where('id',$project_id)->forceDelete();
            $pesan = 'Delete project Data Success.';
            $status = true;
        }else if(empty($project_id)){
            Projects::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All projects Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoveryproject(Request $request)
    {
        $project_id = $request['project_id'];

        $data = [];
        if(!empty($project_id)){
            Projects::withTrashed()->where('id',$project_id)->restore();
            $pesan = 'Restore project Data Success.';
            $status = true;
        }else if(empty($project_id)){
            Projects::withTrashed()->restore();
            $pesan = 'Restore All projects Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }
}
