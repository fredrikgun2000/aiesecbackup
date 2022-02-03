<?php

namespace App\Http\Controllers\Internal\Infosessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Infosessionforms;

class FormController extends Controller
{
    public function indexform()
    {
        return view('/internal/infosessions/forms/index');
    }

    public function indexformdetail()
    {
        return view('/internal/infosessions/forms/detail');
    }

    public function readform(Request $request)
    {
        $id = base64_decode($request['id']);
        
        if(!empty($id)){
            $datas = infosessionforms::where('id',$id)->orWhere('section_id',$id)->get();
        }else{
            $datas = infosessionforms::WhereNull('section_id')->get();
        }

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'form_id' => $d['id'],
                'program_id' => $d['program_id'],
                'theme' => $d['theme'],
                'banner' => $d['banner'],
                'title' => $d['title'],
                'description' => $d['description'],
                'section_id' => $d['section_id'],
                'type' => $d['type'],
                'publish' => $d['publish'],
            );
        }

        $pesan = 'Read Form Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function createform(Request $request)
    {
       $program_id = $request['program_id'];
       $banner = $request['banner'];
       $title = $request['title'];
       $description = $request['description'];
       $section_id = $request['section_id'];
       $type = $request['type'];

        $cropbanner = $request['cropbanner'];
        $banners=null;
        if(!empty($cropbanner)){
            $banner_array = explode(";",$cropbanner);
            $banner_array2 = explode(",",$banner_array[1]);
            $decode = $banner_array2[1];

            $banners = 'banner_'.$banner->getClientOriginalName();
            $destinationPath = 'assets/internal/images/infosession/banner/'.$banners;
            file_put_contents($destinationPath, $decode);
        }

        $data = array(
            'program_id' => $program_id,
            'banner' => $banners,
            'title' => $title,
            'description' => $description,
            'section_id' => $section_id,
            'type' => $type,
        );

        infosessionforms::create($data);
        
        $pesan = 'Insert form Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    } 

    public function updateform(Request $request)
    {
        $column = $request['column'];
        $form_id = $request['form_id'];
        $value = $request['value'];

        $data = array(
            $column => $value
        );

        infosessionforms::where('id',$form_id)->update($data);
        
        $pesan = 'Update form Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleteform(Request $request)
    {
        $form_id = $request['form_id'];

        infosessionforms::where('id',$form_id)->delete();
        $data = [];
        $pesan = 'Delete form Data Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function publishform(Request $request)
    {
        $form_id = $request['form_id'];
        $publishs = $request['publish'];

        $validator = Validator::make($request->all(),[
			'publish' => 'required',
        ],[
            'form_id.required' => 'Please refresh your page.'
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

        infosessionforms::where('id',$form_id)->update($data);
        
        $pesan = $publishs . ' form Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoveryform()
    {
        return view('/internal/infosessions/forms/recovery');
    }

    public function indexrecoverydetailform()
    {
        return view('/internal/infosessions/forms/recoverydetail');
    }
    
    public function readrecoveryform(Request $request)
    {
        $id = $request['id'];

        if(!empty($id)){
            $datas = infosessionforms::onlyTrashed('deleted_at')->where('id',$id)->get();;
        }else{
            $datas = infosessionforms::onlyTrashed('deleted_at')->get();;
        }

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'form_id' => $d['id'],
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


        $pesan = 'Read form Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }
    

    public function deleterecoveryform(Request $request)
    {
        $form_id = $request['form_id'];

        $data = [];
        if(!empty($form_id)){
            infosessionforms::where('id',$form_id)->forceDelete();
            $pesan = 'Delete form Data Success.';
            $status = true;
        }else if(empty($form_id)){
            infosessionforms::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All forms Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoveryform(Request $request)
    {
        $form_id = $request['form_id'];

        $data = [];
        if(!empty($form_id)){
            infosessionforms::withTrashed()->where('id',$form_id)->restore();
            $pesan = 'Restore form Data Success.';
            $status = true;
        }else if(empty($form_id)){
            infosessionforms::withTrashed()->restore();
            $pesan = 'Restore All forms Data Success.';
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
