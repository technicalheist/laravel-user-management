<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use App\PermissionList; 
class Users extends Controller
{
    protected $user;
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware(function ($request, $next) {
        if(!isAuthorized('can_manage_user'))
        {
            abort(403);
        }
            return $next($request);
        });
    }

    public function users()
    {
        $user = User::paginate(5);
        return view('admin.users')->with(['users'=>$user, 'title'=>'All Users']);
    }

    public function create(Request $req)
    {
        if($req->has('create'))
        {
            $validateData = $req->validate([
                'name'=>['required', 'min:5', 'max:50'],
                'email'=>['required', 'unique:users'],
                'password'=>['required', 'min:6', 'max:20', 'confirmed'],
                'password_confirmation'=>['required', 'min:6', 'max:20'],
                'user_type' =>['required']
            ]);
            //echo "I Executed"; die;
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->user_type = $req->user_type;
            $user->save();
            $user_id = $user->id;
            $req->session()->flash('success', 'User Added successfully!');
            if($req->user_type == 2)
            {
                $permission =$this->savePermission($user_id, $req->permission);
            }

            return redirect()->back();
        }
        else
        {
            $permission_list = PermissionList::all()->groupBy('category')->toArray();
            return view('admin.create')->with(['title'=>'Create New User', 'permission_list'=>$permission_list]);
        }
    }

    private function savePermission($user_id,$permission)
    {
        deleteData('permission', ['user_id'=>$user_id]);
        $data = array();
        if(!empty($permission))
        {
            foreach($permission as $per)
            {
                $arr = array(
                    "user_id"=>$user_id,
                    "key" =>$per,
                    "value"=>1
                );
                $data[] = $arr;
            }
        }
        if(!empty($data))
        {
        insertData('permission', $data);
        }
        return true;
    }





    public function edit($id)
    {
        if(!checkAdminPermission($id))
        {
            abort(403);
        }
       $user = User::where('id', $id)
            ->get()
            ->toArray();

        if(empty($user))
        {
            abort(403);
        }
        else
        {
            $permission_list = PermissionList::all()->groupBy('category')->toArray();
            $permission_arr = getData('permission', ['user_id'=>$id, 'value'=>1]);
            $permission = array_column($permission_arr, 'key');
            return view('admin.edit')->with(['user'=>$user[0], 'permission'=>$permission, 'title'=>'Edit User', 'permission_list'=>$permission_list]);
        }
    }

    public function update(Request $req)
    {
        if($req->has('edit'))
        {
            $id = $req->input('id');
            if(!checkAdminPermission($id))
            {
                abort(403);
            }

            if(!empty($req->input('password')))
            {
                $validateData = $req->validate([
                    'name'=>['required', 'min:5', 'max:50'],
                    'user_type' =>['required'],
                    'password'=>['min:6', 'max:20', 'confirmed'],
                    'password_confirmation'=>['required', 'min:6', 'max:20']
                ]);

                if($req->user_type == 2)
                {
                    $permission =$this->savePermission($id, $req->permission);
                }

                $arr = array(
                    'name' => $req->input('name'),
                    'user_type' => $req->input('user_type'),
                    'password' => Hash::make($req->input('password'))
                );
                try{
                    User::findOrFail($id)->update($arr);
                    $req->session()->flash('success', 'User updated successfully!');
                }
                catch(ModelNotFoundException $err)
                {
                    $req->session()->flash('success', 'User not found to update!');
                }

            }
            else
            {
                $validateData = $req->validate([
                    'name'=>['required', 'min:5', 'max:50'],
                    'user_type' =>['required']
                ]);

                if($req->user_type == 2)
                {
                    $permission =$this->savePermission($id, $req->permission);
                }

                $arr = array(
                    'name' => $req->input('name'),
                    'user_type' => $req->input('user_type')
                );

                try{
                    User::findOrFail($id)->update($arr);
                    $req->session()->flash('success', 'User updated successfully!');
                }
                catch(ModelNotFoundException $err)
                {
                    $req->session()->flash('success', 'User not found to update!');
                }
            }


            return redirect()->back();
        }
        else
        {
            abort(404);
        }


    }

    public function delete($id)
    {
        if(!isAuthorized('can_delete_user') || !checkAdminPermission($id))
        {
            abort(403);
        }

        try{
            $del = User::findOrFail($id)->delete();
            if($del)
            {
                Session::flash('success', 'User deleted successfully!');
                return redirect()->back();
            }
        }
        catch(ModelNotFoundException $err)
        {
            Session::flash('success', 'User Not Found!');
            return redirect()->back();
        }

    }

    


}
