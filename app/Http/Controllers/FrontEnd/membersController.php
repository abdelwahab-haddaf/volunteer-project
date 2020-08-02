<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\models\usersInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class membersController extends Controller
{
//    public function index(){
//
//    }
//
//    public function create(){
//
//    }
//
//    public function store(Request $request)
//    {
//        if ($request->ajax()) {
//            $request->validate([
//                'comment' => 'required|string'
//            ]);
//
//            $comment = $request->all() + ['user_id' => auth()->user()->id];
//            Comment::create($comment);
//            return response(['status' => true, 'data']);
//        }
//    }
//
    public function edit($id){
        $user = User::findOrFail($id);
        $extraInfo = usersInformation::where('user_id',$id)->first();

        if (auth()->user()->id == $id){
            return view('front-end.users.edit',['user'=>$user,'extra'=>$extraInfo]);
        }
        else{
            return back();
        }
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
           'name'=>'required|string',
           'email'=>'required|unique:users,email,'.$id,
           'current_password'=>'required'
        ]);

//        dd($data);
        if ($request->ajax()) {
            if(Hash::check($data['current_password'], $user['password'])) {
//            $x =5; $y=5;
//            if($x==$y) {
//                dd($user);
                $user->update($data);
                return response(['status'=>true,'message'=>'تم تعديل البيانات بنجاح']);
                }
            else{
//                dd($data);
                return response(['status'=>false,'message'=>'كلمة المرور خاطئة']);
            }
//
        }
    }

    public function updateExtra(Request $request, $id){
        $user = usersInformation::where('user_id',$id)->first();
//        dd($user);
        $data = $request->validate([
            'address'=>'nullable|string',
            'skills'=>'nullable|string',
            'work'=>'nullable|string',
            'bio'=>'nullable|string|max:400',
            'phone'=>'nullable|numeric',
            'study'=>'nullable|string',
            'profile_image'=>'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

//        $image_profile = $request->validate([
//            'profile_image'=>'nullable|image|mimes:jpg,jpeg,png|max:4096',
//        ]);
//        dd($image);
        if ($image = $request->file('profile_image')){
//          $imageName = $image->getClientOriginalName().'-'.time().'-';
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move('users_image',$imageName);
            $user = User::where('id',$id)->first();
            $user->update(['image'=>$imageName]);
        }

        $data=$data+['user_id'=>$id];
//
        if ($user != null){
            $user->update($data);
        }
        else{
           usersInformation::create($data);
        }

        return redirect()->back();

    }

    public function editPassword($id){
        $user = User::findOrFail($id);
        return view('front-end.users.editPassword',['user'=>$user]);
    }

    public function updatePassword(Request $request , $id)
    {

        if ($request->ajax()) {
            $data = User::where('id', $id)->first();
            $user = $request->validate([
                'password' => 'required|confirmed|string|min:8',
                'password_confirmation' => 'required|string',
                'current_password' => 'required',
            ]);
//            $user['password'] = bcrypt(\request('password'));
                $x = 55; $y=55;
            if (Hash::check($user['password'], $data['password'])  && $user['current_password']==$user['password']){
//            if ($x==$y){
//                dd($user);
                $status = false;
                $message = 'كلمة المرور الحالية و الجديدة متشابهتان';
//                return response(['status' => false ,'message'=>'كلمة المرور الحالية و الجديدة متشابهتان']);


            }
            elseif (Hash::check($user['current_password'], $data['password'])) {
                $user['password'] = bcrypt(\request('password'));
                User::findOrFail($id)->update($user);
                $status = true;
                $message = 'تم تعديل كلمة المرور بنجاح';
//                return response(['status' => true,'message'=>'تم تعديل كلمة المرور بنجاح']);
             }
            else {
                    $status = false;
                    $message = 'لم يتم تعديل كلمة المرور';
//                    return response(['status' => false,'message'=>'لم يتم تعديل كلمة المرور']);

                }


            return response(['status'=>$status,'message'=>$message]);
            }
        }


    public function show($id){
    $user = User::findOrFail($id);
    $extraInfo = usersInformation::where('user_id',$id)->first();
            return view('front-end.users.show',['user'=>$user,'extra'=>$extraInfo]);
    }

    public function destroy($id){

    }



//    public function try($id){
//        $user = usersInformation::where('user_id',$id)->first();
//        return view('empty',['user'=>$user]);
//    }

}
