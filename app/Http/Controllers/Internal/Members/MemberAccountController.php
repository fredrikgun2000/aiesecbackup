<?php

namespace App\Http\Controllers\Internal\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Validator;

use App\Models\Members;

class MemberAccountController extends Controller
{
    public function indexMemberAccount()
    {   
        return view('internal/members/member account/index');
    }

    public function creatememberemail($email, $password, $sender_id)
    {
        try{
            $check = Members::where('id', $sender_id)->first();
            Mail::send('internal/members/member account/email', ['email' => $email, 'sendername' => $check['first_name']. ' '. $check['last_name'], 'sendermail' => $check['email'], 'password' => $password], function ($message) use ($email)
            {
                $message->subject('This Your AIESEC In UKSW Account');
                $message->from('youraccount@Aiesecinuksw.com', 'AIESEC in UKSW');
                $message->to($email);
            });
            return Response()->JSON(['status'=>true]);
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function createmember(Request $request)
    {
        $sender_id = $request['sender_id'];
        $role_id = $request['role_id'];
        $email = $request['email'];
        $password = $request['password'];
        $join_period = $request['join_period'];

        $validator = Validator::make($request->all(), [
			'sender_id' => 'required',
			'role_id' => 'required',
			'email' => 'required||email||unique:members',
			'password' => 'required',
			'join_period' => 'required',
        ],[
            'role_id.required' => 'The role is required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}
        
        $sendemail = $this->creatememberemail($email,$password, $sender_id);

        if(!$sendemail){
                $pesan = 'Email Cant Send.';
                $data = [];
                $status = false;
                $api = array(
                    "status" => $status,
                    "data" => $data,
                    "pesan" => $pesan,
            );
            return response()->json($api);
        }
        
        $data = array(
            'sender_id' => $sender_id,
            'role_id' => $role_id,
            'email' => $email,
            'password' => hash::make($password),
            'join_period' => $join_period,
        );

        Members::create($data);
        
        $pesan = 'Insert Member Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function readmember()
    {
        $datas = Members::join('members AS S','members.sender_id','=','S.id')->join('roles AS R','members.role_id','=','R.id')->select('S.first_name AS sender_name','R.role_name','members.*')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            
            $email_section = explode("@",$d['email'])[0];
            $no++;
            $data[] = array(
                'no' => $no,
                'member_id' => $d['id'],
                'sender_name' => $d['sender_name'],
                'role_name' => $d['role_name'],
                'full_name' => $d['first_name'].' '.$d['last_name'],
                'email_section' => $email_section,
                'email' => $d['email'],
                'password' => $d['password'],
                'birthdate' => $d['birthdate'],
                'join_period' => $d['join_period'],
                'photo' => $d['photo'],
                'publish' => $d['publish'],
            );
        }

        $pesan = 'Read Member Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function editmember(Request $request)
    {
        $member_id = $request['member_id'];

        $validator = Validator::make($request->all(), [
			'member_id' => 'required',
        ],[
            'required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $d = Members::where('id',$member_id)->first();

        
        $data = array(
            'member_id' => $d['id'],
            'email' => $d['email'],
            'role_id' => $d['role_id'],
            'join_period' => $d['join_period'],
        );

        $pesan = 'Get Specific Role Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updatemember(Request $request)
    {
        $member_id = $request['member_id'];
        $role_id = $request['role_id'];
        $join_period = $request['join_period'];

        $validator = Validator::make($request->all(), [
			'member_id' => 'required',
			'role_id' => 'required',
			'join_period' => 'required',
        ],[
            'member_id.required' => 'Please refresh your page',
            'role_id.required' => 'The role is required',
            'join_period.required' => 'The join period is required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $data = array(
            'role_id' => $role_id,
            'join_period' => $join_period,
        );

        Members::where('id',$member_id)->update($data);
        
        $pesan = 'Update Member Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function publishmember(Request $request)
    {
        $member_id = $request['member_id'];
        $publishs = $request['publish'];

        $validator = Validator::make($request->all(),[
			'publish' => 'required',
        ],[
            'member_id.required' => 'Please refresh your page.'
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

        members::where('id',$member_id)->update($data);
        
        $pesan = $publishs . ' Member Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deletemember(Request $request)
    {
        $member_id = $request['member_id'];

        $check = Members::where('sender_id',$member_id)->get();
        // ini harus di update lagi
        $data = [];
        if($check->count() == 0){
            Members::where('id',$member_id)->delete();
            $pesan = 'Delete Member Data Success.';
            $status = true;
        }else{
            foreach ($check as $c) {
                $data[] = array(
                    'member_name' => $c['member_name'],
                );
            }
            
            $pesan = 'You can not delete the data, because the Member is still used in some role so you must delete the roles first';
            $status = false;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoverymember()
    {
        return view('/internal/members/member account/recovery');
    }
    
    public function readrecoverymember()
    {
        $datas = Members::join('Members AS S','Members.sender_id','=','S.id')->join('Roles AS R','Members.role_id','=','R.id')->select('S.first_name AS sender_name','R.role_name','Members.*')->onlyTrashed('deleted_at')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $email_section = explode("@",$d['email'])[0];
            $no++;
            $data[] = array(
                'no' => $no,
                'member_id' => $d['id'],
                'sender_name' => $d['sender_name'],
                'role_name' => $d['role_name'],
                'full_name' => $d['first_name'].' '.$d['last_name'],
                'email_section' => $email_section,
                'email' => $d['email'],
                'password' => $d['password'],
                'birthdate' => $d['birthdate'],
                'join_period' => $d['join_period'],
                'photo' => $d['photo'],
            );
        }

        $pesan = 'Read Role Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleterecoverymember(Request $request)
    {
        $member_id = $request['member_id'];

        $data = [];
        if(!empty($member_id)){
            Members::where('id',$member_id)->forceDelete();
            $pesan = 'Delete Member Data Success.';
            $status = true;
        }else if(empty($member_id)){
            Members::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All Members Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoverymember(Request $request)
    {
        $role_id = $request['role_id'];

        $data = [];
        if(!empty($role_id)){
            Members::withTrashed()->where('id',$role_id)->restore();
            $pesan = 'Restore Role Data Success.';
            $status = true;
        }else if(empty($role_id)){
            Members::withTrashed()->restore();
            $pesan = 'Restore All Roles Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function generatepassword(Request $request)
    {
        $member_id= $request['member_id'];
        $password= $request['password'];
        $check = Members::where('id',$member_id)->first();
        $email = $check->email;
        $sender_id = $check->sender_id;

        $sendemail = $this->creatememberemail($email, $password, $sender_id);

        if(!$sendemail){
            $pesan = 'Email Cant Send.';
            $data = [];
            $status = false;
            $api = array(
                "status" => $status,
                "data" => $data,
                "pesan" => $pesan,
            );
            return response()->json($api);
        }

        Members::where('id',$member_id)->update(['password' => hash::make($password)]);
        $pesan = 'Restore All Roles Data Success.';
        $data = [];
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }
}
