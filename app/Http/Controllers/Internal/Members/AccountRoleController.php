<?php

namespace App\Http\Controllers\Internal\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Departments;
use App\Models\Roles;
use App\Models\Members;

class AccountRoleController extends Controller
{
    public function indexaccountrole()
    {
        return view('/internal/members/account role/index');
    }

    // DEPARTMENTS 
    public function createdepartment(Request $request)
    {
        $department_name = $request['department_name'];

		$validator = Validator::make($request->all(), [
			'department_name' => 'required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}


        $data = array(
            'department_name' => $department_name
        );

        Departments::create($data);
        
        $pesan = 'Insert Department Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function readdepartment()
    {
        $datas = Departments::all();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'department_id' => $d['id'],
                'department_name' => $d['department_name'],
            );
        }

        $pesan = 'Read Department Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);

    }

    public function editdepartment(Request $request)
    {
        $department_id = $request['department_id'];

        $validator = Validator::make($request->all(), [
			'department_id' => 'required',
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

        $d = Departments::where('id',$department_id)->first();

        $data = array(
            'department_id' => $d['id'],
            'department_name' => $d['department_name'],
        );

        $pesan = 'Get Specific Department Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function updatedepartment(Request $request)
    {
        $department_id = $request['department_id'];
        $department_name = $request['department_name'];

        $validator = Validator::make($request->all(), [
			'department_id' => 'required',
			'department_name' => 'required',
        ],[
            'department_id.required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $data = array(
            'department_name' => $department_name
        );

        Departments::where('id',$department_id)->update($data);
        
        $pesan = 'Update Department Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deletedepartment(Request $request)
    {
        $department_id = $request['department_id'];

        $check = Roles::where('department_id',$department_id)->get();
        $data = [];
        if($check->count() == 0){
            Departments::where('id',$department_id)->delete();
            $pesan = 'Delete Department Data Success.';
            $status = true;
        }else{
            foreach ($check as $c) {
                $data[] = array(
                    'role_name' => $c['role_name'],
                );
            }
            
            $pesan = 'You can not delete the data, because the department is still used in some role so you must delete the roles first';
            $status = false;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoverydepartment()
    {
        return view('/internal/members/account role/department/recovery');
    }
    
    public function readrecoverydepartment()
    {
        $datas = Departments::onlyTrashed('deleted_at')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'department_id' => $d['id'],
                'department_name' => $d['department_name'],
            );
        }

        $pesan = 'Read Department Data Success.';
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleterecoverydepartment(Request $request)
    {
        $department_id = $request['department_id'];

        $data = [];
        if(!empty($department_id)){
            Departments::where('id',$department_id)->forceDelete();
            $pesan = 'Delete Department Data Success.';
            $status = true;
        }else if(empty($department_id)){
            Departments::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All Departments Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoverydepartment(Request $request)
    {
        $department_id = $request['department_id'];

        $data = [];
        if(!empty($department_id)){
            Departments::withTrashed()->where('id',$department_id)->restore();
            $pesan = 'Restore Department Data Success.';
            $status = true;
        }else if(empty($department_id)){
            Departments::withTrashed()->restore();
            $pesan = 'Restore All Departments Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    // ROLES
    public function createrole(Request $request)
    {
        $department_id = $request['department_id'];
        $role_name = $request['role_name'];
        $position = $request['position'];
        $data = array(
            'department_id' => $department_id,
            'role_name' => $role_name,
            'position' => $position,
        );

        $validator = Validator::make($request->all(), [
			'department_id' => 'required',
			'role_name' => 'required',
			'position' => 'required',
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        Roles::create($data);
        
        $pesan = 'Insert Role Success.';
        $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function readrole()
    {
        $datas = Roles::join('departments AS D','roles.department_id','=','D.id')->select('D.department_name','roles.*')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'role_id' => $d['id'],
                'role_name' => $d['role_name'],
                'position' => $d['position'],
                'department_name' => $d['department_name'],
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

    public function editrole(Request $request)
    {
        $role_id = $request['role_id'];

        $validator = Validator::make($request->all(), [
			'role_id' => 'required',
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

        $d = Roles::where('id',$role_id)->first();

        $data = array(
            'role_id' => $d['id'],
            'department_id' => $d['department_id'],
            'role_name' => $d['role_name'],
            'position' => $d['position'],
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

    public function updaterole(Request $request)
    {
        $role_id = $request['role_id'];
        $department_id = $request['department_id'];
        $role_name = $request['role_name'];
        $position = $request['position'];

        $validator = Validator::make($request->all(), [
			'role_id' => 'required',
			'department_id' => 'required',
			'role_name' => 'required',
			'position' => 'required',
        ],[
            'role_id.required' => 'Please refresh your page.'
        ]);
		
		if ($validator->fails()) {    
			$message = $validator->errors()->getMessages();
			$api = array(
				'message' => $message
			);
			return response()->json($api,400);
		}

        $data = array(
            'department_id' => $department_id,
            'role_name' => $role_name,
            'position' => $position,
        );

        Roles::where('id',$role_id)->update($data);
        
        $pesan = 'Update Role Success.';
        // $data = [];
        $status = true;
        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function deleterole(Request $request)
    {
        $role_id = $request['role_id'];

        $check = Members::where('role_id',$role_id)->get();
        // ini harus di update lagi
        $data = [];
        if($check->count() == 0){
            Roles::where('id',$role_id)->delete();
            $pesan = 'Delete Role Data Success.';
            $status = true;
        }else{
            foreach ($check as $c) {
                $data[] = array(
                    'role_name' => $c['role_name'],
                );
            }
            
            $pesan = 'You can not delete the data, because the Role is still used in some role so you must delete the roles first';
            $status = false;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function indexrecoveryrole()
    {
        return view('/internal/members/account role/Role/recovery');
    }
    
    public function readrecoveryrole()
    {
        $datas = Roles::onlyTrashed('deleted_at')->get();

        $data = [];
        $no= 0;
        foreach ($datas as $d) {
            $no++;
            $data[] = array(
                'no' =>$no,
                'role_id' => $d['id'],
                'department_id' => $d['department_id'],
                'role_name' => $d['role_name'],
                'position' => $d['position'],
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

    public function deleterecoveryrole(Request $request)
    {
        $role_id = $request['role_id'];

        $data = [];
        if(!empty($role_id)){
            Roles::where('id',$role_id)->forceDelete();
            $pesan = 'Delete Role Data Success.';
            $status = true;
        }else if(empty($role_id)){
            Roles::orWhereNotNull('deleted_at')->forceDelete();
            $pesan = 'Delete All Roles Data Success.';
            $status = true;
        }

        $api = array(
            "status" => $status,
            "data" => $data,
            "pesan" => $pesan,
        );

        return response()->json($api);
    }

    public function restorerecoveryrole(Request $request)
    {
        $role_id = $request['role_id'];

        $data = [];
        if(!empty($role_id)){
            Roles::withTrashed()->where('id',$role_id)->restore();
            $pesan = 'Restore Role Data Success.';
            $status = true;
        }else if(empty($role_id)){
            Roles::withTrashed()->restore();
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
}
