<?php

namespace App\Http\Controllers\Internal\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Members;

class ProfileController extends Controller
{
    public function indexprofile()
    {
        return view('/internal/profile/profile');
    }

    public function indexcompleteprofile()
    {
        return view('/internal/profile/completeprofile');
    }

    public function readmemberprofile(Request $request)
    {
        $member_id = $request['member_id'];

        $datas = Members::join('members as M2','members.sender_id','=','M2.id')->where('members.id',$member_id)->select('members.*','M2.first_name as sender_name')->first();

        $data = array(
            'sender_name' => $datas['sender_name'],
            'member_id' => $datas['id'],
            'first_name' => $datas['first_name'],
            'last_name' => $datas['last_name'],
            'email' => $datas['email'],
            'birthdate' => $datas['birthdate'],
            'join_period' => $datas['join_period'],
            'photo' => $datas['photo'],
        );
    
        $pesan = 'Read Profile Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updateprofile(Request $request)
    {
        $member_id = $request['member_id'];
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $birthdate = $request['birthdate'];
        
        $datas = Members::where('id',$member_id)->first();
        if(!empty($datas)){
            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'birthdate' => $birthdate
            );
            
            Members::where('id',$member_id)->update($data);    
         
            
            $pesan = 'Update Profile Data Success.';
            $status = true;
        }else{
            $pesan = 'Update Error Try To Refresh.';
            $status = false;
        }
        
        $data = [];
        
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updatepasswordprofile(Request $request)
    {
        $member_id = $request['member_id'];
        $password = $request['password'];

        $data = array(
            'password' => hash::make($password),
        );
        
        Members::where('id',$member_id)->update($data);

        $data = [];
        $pesan = 'Update Password Member Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );  

        return response()->json($api);
    }

    public function updatephotoprofile(Request $request)
    {
        $member_id = $request['member_id'];
        $first_name = $request['first_name'];
        $photo = $request['photo'];
        $cropphoto = $request['cropphoto'];
        $photo_array = explode(";",$cropphoto);
        $photo_array2 = explode(",",$photo_array[1]);
        $decode = base64_decode($photo_array2[1]);

        $photos = 'member_'.$first_name.'_'.$photo->getClientOriginalName();
        $destinationPath = 'assets/internal/images/member/'.$photos;
        file_put_contents($destinationPath, $decode);

        $data = array(
            'photo' => $photos,
        );
        
        Members::where('id',$member_id)->update($data);

        $data = [];
        $pesan = 'Update Photo Profile Success.';
        $status = true;

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );  

        return response()->json($api);
    }
}
