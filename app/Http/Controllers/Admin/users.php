<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class users extends Controller
{
    public function index(){
        $users = User::paginate(10);
        return view('admin.users.index',['users'=>$users]);
    }

    public function show($id){

    }


    public function setAdmin(Request $request , $id)
    {
        if ($request->ajax()) {
            $user = User::findOrFail($id);
            $user->update(['isAdmin' => '1']);
        }
        $url = route('user.removeAdmin',$user->id);
        return response(['status' => true,'url'=>$url]);
    }

    public function removeAdmin(Request $request , $id)
    {
        if ($request->ajax()) {
            $user = User::findOrFail($id);
            $user->update(['isAdmin' => '0']);
        }
        $url = route('user.setAdmin',$user->id);
        return response(['status' => true,'url'=>$url]);
    }


    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){
        if ($request->ajax()){

            $user = $request->validate([
                'name'=>'required|string',
                'email'=>'required|email|unique:users',
                'password'=>'required|confirmed|string|min:8',
            ]);
            $user['password']=bcrypt(\request('password'));
            User::create($user);
            return response(['status'=>true , 'data']);
        }

    }
    public function edit($id){

        $user=User::FindOrFail($id);
        return view('admin.users.edit',['user'=>$user]);
    }
    public function update(Request $request , $id){

        if ($request->ajax()) {
                $data =  User::where('id',$id)->first();
                $user = $request->validate([
                    'name' => 'required|string',
                    'email'=>'required|unique:users,email,'.$id,
                    'password' => 'required|confirmed|string|min:8',
                    'password_confirmation' => 'required|string',
                    'current_password' => 'required',
                ]);
                $user['password'] = bcrypt(\request('password'));
                if (Hash::check($user['current_password'],$data['password'])){
                    User::findOrFail($id)->update($user);
                    return response(['status' => true]);

                }
                else{
//                    return session('error','خطأ في كلمة المرور');
//                    session('error','كلمة المرور الحالية خاطئة');
//                    return response(['status' => false ,'message'=>'خطأ في كلمة المرور الحالية']);
                }

            }
    }
    public function destroy(Request $request , $id){
        if ($request->ajax()){
            User::findOrFail($id)->delete();
            return response(['status'=>true]);
        }
    }


}
