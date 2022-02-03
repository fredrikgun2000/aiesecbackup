<?php

namespace App\Http\Controllers\Internal\Infosessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Infosessionprograms;

class ProgramController extends Controller
{
    public function indexprogram()
    {
        return view('/internal/infosessions/programs/index');
    }

    public function indexprogramdetail()
    {
        return view('/internal/infosessions/programs/detail');
    }

    public function readprogram(Request $request)
    {
        $id = base64_decode($request['id']);
        
        if(!empty($id)){
            $datas = infosessionprograms::where('id',$id)->get();
        }else{
            $datas = infosessionprograms::all();
        }

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'program_id' => $d['id'],
                'theme' => $d['theme'],
                'sdgs' => $d['sdgs'],
                'faculty' => $d['faculty'],
                'poster' => $d['poster'],
                'datetime' => $d['datetime'],
                'description' => $d['description'],
                'link_meet' => $d['link_meet'],
                'link_content' => $d['link_content'],
                'publish' => $d['publish'],
            );
        }

        $pesan = 'Read program Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function createprogram(Request $request)
    {
        $theme = $request['theme'];
        $sdgs = $request['sdgs'];
        $facultys = $request['faculty'];
        $poster = $request['poster'];
        $datetime = $request['datetime'];
        $description = $request['description'];
        $link_meet = $request['link_meet'];
        $link_content = $request['link_content'];

		$validator = Validator::make($request->all(), [
			'theme' => 'required',
			'sdgs' => 'required',
			'faculty' => 'required',
			'datetime' => 'required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $faculty = '';
        foreach($facultys as $key => $i){
            $faculty .= $i . '|| ';
        }
        $faculty = rtrim($faculty,'|| ');

        $destinationPath = 'assets/internal/images/infosession/poster/';
        $posters = 'poster_'.$poster->getClientOriginalName();
        $poster->move($destinationPath, $posters);

        $data = array(
            'theme' => $theme,
            'sdgs' => $sdgs,
            'faculty' => $faculty,
            'poster' => $posters,
            'datetime' => $datetime,
            'description' => $description,
            'link_meet' => $link_meet,
            'link_content' => $link_content,
        );

        infosessionprograms::create($data);
        
        $pesan = 'Insert Program Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    } 

    public function updateprogram(Request $request)
    {
        $program_id = base64_decode($request['program_id']);
        $theme = $request['theme'];
        $sdgs = $request['sdgs'];
        $facultys = $request['faculty'];
        $poster = $request['poster'];
        $hiddenposter = $request['hiddenposter'];
        $datetime = $request['datetime'];
        $description = $request['description'];
        $link_meet = $request['link_meet'];
        $link_content = $request['link_content'];

		$validator = Validator::make($request->all(), [
			'theme' => 'required',
			'sdgs' => 'required',
			'faculty' => 'required',
			'datetime' => 'required',
        ],[
            'program_id.required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $faculty = '';
        foreach($facultys as $key => $i){
            $faculty .= $i . '|| ';
        }
        $faculty = rtrim($faculty,'|| ');

        if(empty($hiddenposter)){
            $destinationPath = 'assets/internal/images/infosession/poster/';
            $posters = 'poster_'.$poster->getClientOriginalName();
            $poster->move($destinationPath, $posters);
        }else{
            $posters = $hiddenposter;
        }

        $data = array(
            'theme' => $theme,
            'sdgs' => $sdgs,
            'faculty' => $faculty,
            'poster' => $posters,
            'datetime' => $datetime,
            'description' => $description,
            'link_meet' => $link_meet,
            'link_content' => $link_content,
        );

        infosessionprograms::where('id',$program_id)->update($data);
        
        $pesan = 'Update Program Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleteprogram(Request $request)
    {
        $program_id = base64_decode($request['program_id']);

        infosessionprograms::where('id',$program_id)->delete();
        $data = [];
        $pesan = 'Delete program Data Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function publishprogram(Request $request)
    {
        $program_id = base64_decode($request['program_id']);
        $publishs = $request['publish'];

        $validator = Validator::make($request->all(),[
			'publish' => 'required',
        ],[
            'program_id.required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $publish = $publishs == 'publish' ? '1' : '0';
        $data = array(
            'publish' => $publish,
        );

        infosessionprograms::where('id',$program_id)->update($data);
        
        $pesan = $publishs . ' Program Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoveryprogram()
    {
        return view('/internal/infosessions/programs/recovery');
    }

    public function indexrecoverydetailprogram()
    {
        return view('/internal/infosessions/programs/recoverydetail');
    }
    
    public function readrecoveryprogram(Request $request)
    {
        $id = base64_decode($request['id']);

        if(!empty($id)){
            $datas = infosessionprograms::onlyTrashed('deleted_at')->where('id',$id)->get();;
        }else{
            $datas = infosessionprograms::onlyTrashed('deleted_at')->get();;
        }

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'program_id' => $d['id'],
                'theme' => $d['theme'],
                'sdgs' => $d['sdgs'],
                'faculty' => $d['faculty'],
                'poster' => $d['poster'],
                'datetime' => $d['datetime'],
                'description' => $d['description'],
                'link_meet' => $d['link_meet'],
                'link_content' => $d['link_content'],
            );
        }


        $pesan = 'Read program Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }
    

    public function deleterecoveryprogram(Request $request)
    {
        $program_id = base64_decode($request['program_id']);

        $data = [];
        if(!empty($program_id)){
            infosessionprograms::where('id',$program_id)->forceDelete();
            $pesan = 'Delete program Data Success.';
            $status = true;
        }else if(empty($program_id)){
            infosessionprograms::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All programs Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoveryprogram(Request $request)
    {
        $program_id = base64_decode($request['program_id']);

        $data = [];
        if(!empty($program_id)){
            infosessionprograms::withTrashed()->where('id',$program_id)->restore();
            $pesan = 'Restore program Data Success.';
            $status = true;
        }else if(empty($program_id)){
            infosessionprograms::withTrashed()->restore();
            $pesan = 'Restore All programs Data Success.';
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
