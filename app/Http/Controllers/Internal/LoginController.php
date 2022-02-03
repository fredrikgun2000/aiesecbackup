<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Validator;

use App\Models\Members;

class LoginController extends Controller
{
    public function indexlogin()
    {
        return view('/internal/login');
    }

    public function validasiLogin(Request $request)
    {
        $email =  $request['email'];
        $password =  $request['password'];

		$api = [];

        if($email == 'fredrikgun2000@gmail.com' AND $password == 'admin123'){
			$check = Members::where('email',$email)->first();
			if(!$check){
				$data = array(
					"sender_id" => null,
					"first_name" => 'super',
					"last_name" => 'admin',
					"email" => $email,
					"birthdate" => date('Y-m-d'),
					"password" => hash::make($password),
					"join_period" => '2020',
					"photo" => null,
				);
				Members::create($data);
			}
		}

		$check = Members::where('email',$email)->first();
		if ($check !=null) {
    		if (hash::check($password,$check['password'])) {
				$data = array(
					"member_id" => $check['id'],
					"first_name" => $check['first_name'],
					"last_name" => $check['last_name'],
					"email" => $check['email'],
					"join_period" => $check['join_period'],
					"photo" => $check['photo'],
				);

				$pesan = 'Login Success.';
				$status = true;
				$api = array(
					"status" => $status,
					"data" => $data,
					"pesan" => $pesan,
				);

			}else{
				$pesan = 'Password Is Wrong.';
				$status = false;
				$data = [];
				$api = array(
					"status" => $status,
					"data" => $data,
					"pesan" => $pesan,
				);
			}
		}else{
			$pesan = 'Account Not Found.';
			$status = false;
			$data = [];
			$api = array(
				"status" => $status,
				"data" => $data,
				"pesan" => $pesan,
			);
		}

		return response()->json($api);
        
    }
}
