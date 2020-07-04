<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PermissionList; 
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth,Session; 
class PermissionController extends Controller
{
    /** 
     * View Permission table 
     * @param null
     * @return html
     */
    public function index()
    {
        $permissions = PermissionList::all(); 
        return view('permission.index')->with(['permissions'=>$permissions]);
    }

    public function create()
    {
        $permissions = PermissionList::all()->groupBy('category')->toArray(); 
        return view('permission.create')->with(['permissions'=>$permissions]);
    }

    public function add(Request $request)
    {
        $validate = $request->validate(
            [
                'name'=>'required', 
                'description'=>'required', 
                'key' => 'required', 
                'category'=>'required'
            ]
        );

        $permission = new PermissionList(); 
        $permission->name = $request->name; 
        $permission->description = $request->description; 
        $permission->key = $request->key; 
        $permission->category = $request->category; 
        $permission->save(); 

        $request->session()->flash('success', 'Permssion Saved Successfully');
        return redirect()->back(); 
    }

    public function delete($id)
    {
        $user_id = Auth::user()->id; 
        if(!checkAdminPermission($user_id))
        {
            abort(403);
        }

        try{
            $del = PermissionList::findOrFail($id)->delete();
            if($del)
            {
                Session::flash('success', 'Permission deleted successfully!');
                return redirect()->back();
            }
        }
        catch(ModelNotFoundException $err)
        {
            Session::flash('success', 'Permission Not Found!');
            return redirect()->back();
        }

    }

    public function edit($id)
    {
        $permission = PermissionList::where(['id'=>$id])->get()->toArray(); 
        if(empty($permission))
        {
            abort(404);
        }
        $permissions = PermissionList::all()->groupBy('category')->toArray(); 
        return view('permission.edit')->with(['permissions'=>$permissions, 'permission'=>$permission[0]]);
    }

    public function update(Request $request)
    {
        $validate = $request->validate(
            [
                'name'=>'required', 
                'description'=>'required',
                'category'=>'required'
            ]
        );

        $arr = array(
            'name'=>$request->name, 
            'description'=>$request->description, 
            'category'=>$request->category
        );

        $update = updateData('permission_list', ['id'=>$request->id], $arr);
        Session::flash('success', 'Permission Updated Sucessfully!');
        return redirect(url('/permission'));
    }


}
