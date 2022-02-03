<?php

namespace App\Http\Controllers\Internal\Infosessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Infosessionspeakers;

class SpeakerController extends Controller
{
    public function indexspeaker()
    {
        return view('/internal/infosessions/speakers/index');
    }

    public function readspeaker(Request $request)
    {
        $id = base64_decode($request['id']);
        
        if(!empty($id)){
            $datas = infosessionspeakers::join('infosessionprograms','infosessionspeakers.program_id','=','infosessionprograms.id')->select('infosessionprograms.theme','infosessionspeakers.*')->where('infosessionprograms.id',$id)->get();
        }else{
            $datas = infosessionspeakers::join('infosessionprograms','infosessionspeakers.program_id','=','infosessionprograms.id')->select('infosessionprograms.theme','infosessionspeakers.*')->get();
        }
        

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'speaker_id' => $d['id'],
                'program_id' => $d['program_id'],
                'theme' => $d['theme'],
                'full_name' => $d['full_name'],
                'profession' => $d['profession'],
                'title' => $d['title'],
                'contact' => $d['contact'],
                'description' => $d['description'],
                'photo' => $d['photo'],
                'publish' => $d['publish'],
            );
        }

        $pesan = 'Read Speaker Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function createspeaker(Request $request)
    {
       $program_id = $request['program_id'];
       $full_name = $request['full_name'];
       $professions = $request['profession'];
       $titles = $request['title'];
       $contacts = $request['contact'];
       $description = $request['description'];
       $photo = $request['photo'];

		$validator = Validator::make($request->all(), [
            'program_id' => 'required',
            'full_name' => 'required',
            'profession' => 'required',
            'title' => 'required',
            'photo' => 'required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $profession = '';
        foreach($professions as $key => $i){
            $profession .= $i . '|| ';
        }
        $profession = rtrim($profession,'|| ');

        $title = '';
        foreach($titles as $key => $i){
            $title .= $i . '|| ';
        }
        $title = rtrim($title,'|| ');

        $contact = '';
        foreach($contacts as $key => $i){
            $contact .= $i . '|| ';
        }
        $contact = rtrim($contact,'|| ');

        $cropphoto = $request['cropphoto'];
        $photos=null;
        if(!empty($cropphoto)){
            $photo_array = explode(";",$cropphoto);
            $photo_array2 = explode(",",$photo_array[1]);
            $decode = base64_decode($photo_array2[1]);

            $photos = 'photo_'.$photo->getClientOriginalName();
            $destinationPath = 'assets/internal/images/infosession/speaker/'.$photos;
            file_put_contents($destinationPath, $decode);
        }

        $data = array(
          'program_id' => $program_id,
          'full_name' => $full_name,
          'profession' => $profession,
          'title' => $title,
          'contact' => $contact,
          'description' => $description,
          'photo' => $photos,
        );

        infosessionspeakers::create($data);
        
        $pesan = 'Insert Speaker Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    } 

    public function editspeaker(Request $request)
    {
        $speaker_id = $request['speaker_id'];

        $validator = Validator::make($request->all(), [
			'speaker_id' => 'required',
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

        $d = infosessionspeakers::where('id',$speaker_id)->first();

        $data = array(
            'speaker_id' => $d['id'],
            'program_id' => $d['program_id'],
            'full_name' => $d['full_name'],
            'profession' => $d['profession'],
            'title' => $d['title'],
            'contact' => $d['contact'],
            'description' => $d['description'],
            'photo' => $d['photo'],
            'publish' => $d['publish'],
        );

        $pesan = 'Get Specific speaker Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updatespeaker(Request $request)
    {
        $speaker_id = $request['speaker_id'];
        $program_id = $request['program_id'];
        $full_name = $request['full_name'];
        $professions = $request['profession'];
        $titles = $request['title'];
        $contacts = $request['contact'];
        $description = $request['description'];
        $photo = $request['photo'];
        $hiddenphoto = $request['hiddenphoto'];

        $validator = Validator::make($request->all(), [
			'program_id' => 'required',
            'full_name' => 'required',
            'profession' => 'required',
            'title' => 'required',
        ],[
            'speaker_id.required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $profession = '';
        foreach($professions as $key => $i){
            $profession .= $i . '|| ';
        }
        $profession = rtrim($profession,'|| ');

        $title = '';
        foreach($titles as $key => $i){
            $title .= $i . '|| ';
        }
        $title = rtrim($title,'|| ');

        $contact = '';
        foreach($contacts as $key => $i){
            $contact .= $i . '|| ';
        }
        $contact = rtrim($contact,'|| ');
        
        if(empty($hiddenphoto)){
            $cropphoto = $request['cropphoto'];
            $photos=null;
            if(!empty($cropphoto)){
                $photo_array = explode(";",$cropphoto);
                $photo_array2 = explode(",",$photo_array[1]);
                $decode = base64_decode($photo_array2[1]);

                $photos = 'photo_'.$photo->getClientOriginalName();
                $destinationPath = 'assets/internal/images/infosession/speaker/'.$photos;
                file_put_contents($destinationPath, $decode);
            }
        }else{
            $photos = $hiddenphoto;
        }

        $data = array(
            'program_id' => $program_id,
            'full_name' => $full_name,
            'profession' => $profession,
            'title' => $title,
            'contact' => $contact,
            'description' => $description,
            'photo' => $photos,
        );

        infosessionspeakers::where('id',$speaker_id)->update($data);
        
        $pesan = 'Update speaker Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function publishspeaker(Request $request)
    {
        $speaker_id = $request['speaker_id'];
        $publishs = $request['publish'];

        $validator = Validator::make($request->all(),[
			'publish' => 'required',
        ],[
            'speaker_id.required' => 'Please refresh your page.'
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

        infosessionspeakers::where('id',$speaker_id)->update($data);
        
        $pesan = $publishs . ' Speaker Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deletespeaker(Request $request)
    {
        $speaker_id = $request['speaker_id'];

        infosessionspeakers::where('id',$speaker_id)->delete();
        $data = [];
        $pesan = 'Delete speaker Data Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoveryspeaker()
    {
        return view('/internal/infosessions/speakers/recovery');
    }
    
    public function readrecoveryspeaker()
    {
        $datas = infosessionspeakers::join('infosessionprograms','infosessionspeakers.program_id','=','infosessionprograms.id')->select('infosessionprograms.theme','infosessionspeakers.*')->onlyTrashed('deleted_at')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' => $no,
                'speaker_id' => $d['id'],
                'program_id' => $d['program_id'],
                'theme' => $d['theme'],
                'full_name' => $d['full_name'],
                'profession' => $d['profession'],
                'title' => $d['title'],
                'contact' => $d['contact'],
                'description' => $d['description'],
                'photo' => $d['photo'],
                'publish' => $d['publish'],
            );
        }

        $pesan = 'Read Speaker Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleterecoveryspeaker(Request $request)
    {
        $speaker_id = $request['speaker_id'];

        $data = [];
        if(!empty($speaker_id)){
            infosessionspeakers::where('id',$speaker_id)->forceDelete();
            $pesan = 'Delete speaker Data Success.';
            $status = true;
        }else if(empty($speaker_id)){
            infosessionspeakers::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All speakers Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoveryspeaker(Request $request)
    {
        $speaker_id = $request['speaker_id'];

        $data = [];
        if(!empty($speaker_id)){
            infosessionspeakers::withTrashed()->where('id',$speaker_id)->restore();
            $pesan = 'Restore speaker Data Success.';
            $status = true;
        }else if(empty($speaker_id)){
            infosessionspeakers::withTrashed()->restore();
            $pesan = 'Restore All speakers Data Success.';
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
