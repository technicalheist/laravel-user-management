<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\User;



function insertData($table, $arr)
{
    $query = DB::table($table)->insert($arr);
    return true;
}

function updateData($table, $where, $arr)
{
    $query = DB::table($table)
            ->where($where)
            ->update($arr);
            return true;
}


function countData($table, $where=null)
{
    $query = DB::table($table);
            if($where != null)
            {
    $query = $query->where($where);
            }
    $query = $query->get()
            ->count();
    return $query;
}

function getData($table, $where=null)
{
    $query = DB::table($table);
            if($where != null)
            {
    $query = $query->where($where);
            }
    $query = $query->get()
            ->toArray();
    return $query;
}

function deleteData($table, $where)
{
    $query = DB::table($table)
            ->where($where)
            ->delete();
    return true;
}

function isAuthorized($permission)
{
    $user_id = Auth::user()->id;
    $user_type = Auth::user()->user_type;
    if($user_type == 1)
    {
        return true;
    }
    else if($user_type == 2)
    {
        $per_arr = getData('permission', ['user_id'=>$user_id, 'key'=>$permission]);
        if(empty($per_arr))
        {
            return false;
        }
        else
        {
            $value  = $per_arr[0]->value;
            if($value == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    else
    {
        return false;
    }
}


 function checkAdminPermission($id)
    {
        try
        {
            $user = User::findOrFail($id);
            $user_type = $user->user_type;
            $current_user_type = Auth::user()->user_type;
            if($current_user_type > $user_type)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        catch(ModelNotFoundException $err)
        {
            abort(404);
        }
    }

    function isAdmin()
    {
        $user_id = Auth::user()->id;
        $user_type = Auth::user()->user_type;
        if($user_type == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
