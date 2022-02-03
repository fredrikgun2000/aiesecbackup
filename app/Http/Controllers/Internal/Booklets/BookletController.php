<?php

namespace App\Http\Controllers\Internal\Booklets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Booklets;

class BookletController extends Controller
{
    public function indexbooklet()
    {
        return view('/internal/booklets/index');
    }

    public function readbooklet()
    {
        $datas = Booklets::all();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'booklet_id' => $d['id'],
                'title' => $d['title'],
                'description' => $d['description'],
                'file' => $d['file'],
                'publish' => $d['publish'],
            );
        }

        $pesan = 'Read booklet Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function createbooklet(Request $request)
    {
        $title = $request['title'];
        $description = $request['description'];
        $file = $request['file'];

		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'description' => 'required',
			'file' => 'required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $destinationPath = 'assets/internal/files/booklet/';
        $files = 'booklet_'.$file->getClientOriginalName();
        $file->move($destinationPath, $files);

        $data = array(
            'title' => $title,
            'description' => $description,
            'file' => $files
        );

        Booklets::create($data);
        
        $pesan = 'Insert Booklet Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    } 

    public function editbooklet(Request $request)
    {
        $booklet_id = $request['booklet_id'];

        $validator = Validator::make($request->all(), [
			'booklet_id' => 'required',
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

        $d = Booklets::where('id',$booklet_id)->first();

        $data = array(
            'booklet_id' => $d['id'],
            'title' => $d['title'],
            'description' => $d['description'],
            'file' => $d['file'],
        );

        $pesan = 'Get Specific booklet Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updatebooklet(Request $request)
    {
        $booklet_id = $request['booklet_id'];
        $title = $request['title'];
        $description = $request['description'];
        $file = $request['file'];
        $hiddenfile = $request['hiddenfile'];

        $validator = Validator::make($request->all(), [
			'booklet_id' => 'required',
			'title' => 'required',
			'description' => 'required',
        ],[
            'booklet_id.required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        if(empty($hiddenfile)){
            $destinationPath = 'assets/internal/files/booklet/';
            $files = 'booklet_'.$file->getClientOriginalName();
            $file->move($destinationPath, $files);
        }else{
            $files = $hiddenfile;
        }

        $data = array(
            'title' => $title,
            'description' => $description,
            'file' => $files
        );

        Booklets::where('id',$booklet_id)->update($data);
        
        $pesan = 'Update booklet Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function publishbooklet(Request $request)
    {
        $booklet_id = $request['booklet_id'];
        $publishs = $request['publish'];

        $validator = Validator::make($request->all(),[
			'publish' => 'required',
        ],[
            'booklet_id.required' => 'Please refresh your page.'
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

        booklets::where('id',$booklet_id)->update($data);
        
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

    public function deletebooklet(Request $request)
    {
        $booklet_id = $request['booklet_id'];

        Booklets::where('id',$booklet_id)->delete();
        $data = [];
        $pesan = 'Delete booklet Data Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoverybooklet()
    {
        return view('/internal/booklets/recovery');
    }
    
    public function readrecoverybooklet()
    {
        $datas = Booklets::onlyTrashed('deleted_at')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' => $no,
                'booklet_id' => $d['id'],
                'title' => $d['title'],
                'description' => $d['description'],
                'file' => $d['file'],
            );
        }

        $pesan = 'Read booklet Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleterecoverybooklet(Request $request)
    {
        $booklet_id = $request['booklet_id'];

        $data = [];
        if(!empty($booklet_id)){
            Booklets::where('id',$booklet_id)->forceDelete();
            $pesan = 'Delete booklet Data Success.';
            $status = true;
        }else if(empty($booklet_id)){
            Booklets::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All booklets Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoverybooklet(Request $request)
    {
        $booklet_id = $request['booklet_id'];

        $data = [];
        if(!empty($booklet_id)){
            Booklets::withTrashed()->where('id',$booklet_id)->restore();
            $pesan = 'Restore booklet Data Success.';
            $status = true;
        }else if(empty($booklet_id)){
            Booklets::withTrashed()->restore();
            $pesan = 'Restore All booklets Data Success.';
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
