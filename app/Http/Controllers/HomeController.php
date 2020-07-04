<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use App\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with(['title'=>'Dashboard']);
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect('/');
    }

    public function myAccount()
    {
        $user = Auth::user()
            ->toArray(); 
        if(empty($user))
        {
            abort(403); 
        }
        else
        {
            return view('user.myaccount')->with(['user'=>$user, 'title'=>'My Account']); 
        }
    }

    public function updateAccount(Request $req)
    {
        if($req->has('edit'))
        {
            $id = Auth::user()->id;
            if(!empty($req->input('password')))
            {
                $validateData = $req->validate([
                    'name'=>['required', 'min:5', 'max:50'],
                    'password'=>['min:6', 'max:20', 'confirmed'],
                    'password_confirmation'=>['required', 'min:6', 'max:20']
                ]);
                
                $arr = array(
                    'name' => $req->input('name'),
                    'password' => Hash::make($req->input('password'))
                );
                try{
                   $up =  User::findOrFail($id)->update($arr); 
                    $req->session()->flash('success', 'Account updated successfully!');
                }
                catch(ModelNotFoundException $err)
                {
                    $req->session()->flash('success', 'Account not found to update!');
                }
                
            }
            else
            {
                
                $validateData = $req->validate([
                    'name'=>['required', 'min:5', 'max:50']
                ]);

                $arr = array(
                    'name' => $req->input('name')
                );
                
                try{
                    User::findOrFail($id)->update($arr); 
                    $req->session()->flash('success', 'Account updated successfully!');
                }
                catch(ModelNotFoundException $err)
                {
                    $req->session()->flash('success', 'Account not found to update!');
                }
            }

            return redirect()->back();
        }
        else
        {
            abort(404);
        }
        
    }
}
