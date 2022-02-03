<?php

namespace App\Http\Controllers\Internal\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Projects;

class ProjectController extends Controller
{
    public function indexproject()
    {
        return view('/internal/projects/projects/index');
    }

    public function indexprojectdetail()
    {
        return view('/internal/projects/projects/detail');
    }

    public function readproject(Request $request)
    {
        $id = base64_decode($request['id']);
        
        if(!empty($id)){
            $datas = Projects::join('destinations','projects.destination_id','=','destinations.id')->where('projects.id',$id)->select('projects.*','destinations.country_name')->get();
        }else{
            $datas = Projects::join('destinations','projects.destination_id','=','destinations.id')->select('projects.*','destinations.country_name')->get();
        }

        $data = [];
        foreach ($datas as $d) {
            $data[] = array(
                'project_id' => $d['id'],
                'banner' => $d['banner'],
                'title' => $d['title'],
                'destination' => $d['city'].', '.$d['country_name'],
                'agency' => $d['agency'],
                'typeofproject' => $d['typeofproject'],
                'sdgs' => $d['sdgs'],
                'description' => $d['description'],
                'benefit' => $d['benefit'],
                'working_hour' => $d['working_hour'],
                'accomodation' => $d['accomodation'],
                'publish' => $d['publish'],
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

    public function searchproject(Request $request)
    {
        $search = $request['search'];
        
        if(!empty($search)){
            $datas = Projects::join('destinations','projects.destination_id','=','destinations.id')->where('title','LIKE',"%$search%")->orWhere('country_name','LIKE',"%$search%")->orWhere('sdgs','LIKE',"%$search%")->select('projects.*','destinations.country_name')->get();
        }else{
            $datas = Projects::join('destinations','projects.destination_id','=','destinations.id')->select('projects.*','destinations.country_name')->get();
        }

        $data = [];
        foreach ($datas as $d) {
            $data[] = array(
                'project_id' => $d['id'],
                'banner' => $d['banner'],
                'title' => $d['title'],
                'destination' => $d['city'].', '.$d['country_name'],
                'agency' => $d['agency'],
                'typeofproject' => $d['typeofproject'],
                'sdgs' => $d['sdgs'],
                'description' => $d['description'],
                'benefit' => $d['benefit'],
                'working_hour' => $d['working_hour'],
                'accomodation' => $d['accomodation'],
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

    public function createproject(Request $request)
    {
        $banner = $request['banner'];
        $title = $request['title'];
        $destination_id = $request['destination_id'];
        $agency = $request['agency'];
        $city = $request['city'];
        $typeofproject = $request['typeofproject'];
        $sdgs = $request['sdgs'];
        $description = $request['description'];
        $benefits = $request['benefit'];
        $working_hours = $request['working_hour'];
        $accomodation = $request['accomodation'];
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];

        $working_hour = '';
        foreach($working_hours as $key => $i){
            $working_hour .= $i . '|| ';
        }
        $working_hour = rtrim($working_hour,'|| ');

        $benefit = '';
        foreach($benefits as $key => $i){
            $benefit .= $i . '|| ';
        }
        $benefit = rtrim($benefit,'|| ');

		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'destination_id' => 'required',
			'agency' => 'required',
			'city' => 'required',
			'typeofproject' => 'required',
			'sdgs' => 'required',
			'description' => 'required',
			'benefit' => 'required',
			'working_hour' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $cropbanner = $request['cropbanner'];
        $banners=null;
        if(!empty($cropbanner)){
            $banner_array = explode(";",$cropbanner);
            $banner_array2 = explode(",",$banner_array[1]);
            $decode = base64_decode($banner_array2[1]);

            $banners = 'project_'.$banner->getClientOriginalName();
            $destinationPath = 'assets/internal/images/project/'.$banners;
            file_put_contents($destinationPath, $decode);
        }
        

        $data = array(
            'banner' => $banners,
            'title' => $title,
            'destination_id' => $destination_id,
            'agency' => $agency,
            'city' => $city,
            'typeofproject' => $typeofproject,
            'sdgs' => $sdgs,
            'description' => $description,
            'benefit' => $benefit,
            'working_hour' => $working_hour,
            'accomodation' => $accomodation,
            'start_date' => $start_date,
            'end_date' => $end_date,
        );

        Projects::create($data);
        
        $pesan = 'Insert project Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    } 

    public function editproject(Request $request)
    {
        $project_id = $request['project_id'];

        $validator = Validator::make($request->all(), [
			'project_id' => 'required',
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

        $d = Projects::where('id',$project_id)->first();

        $data = array(
            'project_id' => $d['id'],
            'country_name' => $d['country_name'],
        );

        $pesan = 'Get Specific project Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updateproject(Request $request)
    {
        $project_id = $request['project_id'];
        $country_name = $request['country_name'];
        $description = $request['description'];

        $validator = Validator::make($request->all(), [
			'project_id' => 'required',
			'country_name' => 'required',
        ],[
            'project_id.required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $data = array(
            'country_name' => $country_name,
            'description' => $description
        );

        Projects::where('id',$project_id)->update($data);
        
        $pesan = 'Update project Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleteproject(Request $request)
    {
        $project_id = $request['project_id'];

        Projects::where('id',$project_id)->delete();
        $data = [];
        $pesan = 'Delete project Data Success.';
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
