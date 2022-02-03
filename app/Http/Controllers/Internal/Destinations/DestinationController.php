<?php

namespace App\Http\Controllers\Internal\Destinations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Destinations;

class DestinationController extends Controller
{
    public function indexdestination()
    {
        return view('/internal/destinations/index');
    }

    public function readdestination()
    {
        $datas = Destinations::all();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'destination_id' => $d['id'],
                'country_name' => $d['country_name'],
                'description' => $d['description'],
                'status' => $d['status'],
                'publish' => $d['publish'],
            );
        }

        $pesan = 'Read Destination Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function createdestination(Request $request)
    {
        $country_name = $request['country_name'];
        $description = $request['description'];
        $status = $request['status'];

		$validator = Validator::make($request->all(), [
			'country_name' => 'required',
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
            'description' => $description,
            'status' => $status
        );

        Destinations::create($data);
        
        $pesan = 'Insert Destination Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    } 

    public function editdestination(Request $request)
    {
        $destination_id = $request['destination_id'];

        $validator = Validator::make($request->all(), [
			'destination_id' => 'required',
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

        $d = Destinations::where('id',$destination_id)->first();

        $data = array(
            'destination_id' => $d['id'],
            'country_name' => $d['country_name'],
            'status' => $d['status'],
        );

        $pesan = 'Get Specific Destination Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updatedestination(Request $request)
    {
        $destination_id = $request['destination_id'];
        $country_name = $request['country_name'];
        $description = $request['description'];
        $status = $request['status'];

        $validator = Validator::make($request->all(), [
			'destination_id' => 'required',
			'country_name' => 'required',
        ],[
            'destination_id.required' => 'Please refresh your page.'
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
            'description' => $description,
            'status' => $status
        );

        Destinations::where('id',$destination_id)->update($data);
        
        $pesan = 'Update destination Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function publishdestination(Request $request)
    {
        $destination_id = $request['destination_id'];
        $publishs = $request['publish'];

        $validator = Validator::make($request->all(),[
			'publish' => 'required',
        ],[
            'destination_id.required' => 'Please refresh your page.'
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

        destinations::where('id',$destination_id)->update($data);
        
        $pesan = $publishs . ' Destination Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }
    
    public function deletedestination(Request $request)
    {
        $destination_id = $request['destination_id'];

        Destinations::where('id',$destination_id)->delete();
        $data = [];
        $pesan = 'Delete destination Data Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoverydestination()
    {
        return view('/internal/destinations/recovery');
    }
    
    public function readrecoverydestination()
    {
        $datas = Destinations::onlyTrashed('deleted_at')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' => $no,
                'destination_id' => $d['id'],
                'country_name' => $d['country_name'],
                'description' => $d['description'],
                'status' => $d['status'],
            );
        }

        $pesan = 'Read Destination Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleterecoverydestination(Request $request)
    {
        $destination_id = $request['destination_id'];

        $data = [];
        if(!empty($destination_id)){
            Destinations::where('id',$destination_id)->forceDelete();
            $pesan = 'Delete Destination Data Success.';
            $status = true;
        }else if(empty($destination_id)){
            Destinations::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All Destinations Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoverydestination(Request $request)
    {
        $destination_id = $request['destination_id'];

        $data = [];
        if(!empty($destination_id)){
            Destinations::withTrashed()->where('id',$destination_id)->restore();
            $pesan = 'Restore Destination Data Success.';
            $status = true;
        }else if(empty($destination_id)){
            Destinations::withTrashed()->restore();
            $pesan = 'Restore All Destinations Data Success.';
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
