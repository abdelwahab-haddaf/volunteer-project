<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class charities extends Controller
{
    public function index()
    {
        $charities = Charity::all();
        return view('admin.charities.index', ['charities' => $charities]);
    }

    public function show($id)
    {

        $charity = Charity::with(['user', 'admin'])->findOrFail($id);
//        dd($charity);
        return view('front-end.charities.show', ['charity' => $charity]);

    }

    public function create()
    {
        return view('admin.charities.create');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {

            $charity = $request->validate([
                'name' => 'required|string|unique:charities,name',
                'desc' => 'required|string'
            ]);
            $charity += ['user_id' => auth()->user()->id];
            Charity::create($charity);
            return response(['status' => true, 'data']);
        }
    }

    public function edit($id)
    {
        $charity = Charity::findOrFail($id)->first();
        return view('admin.charities.edit', ['charity' => $charity]);
    }

    public function update(Request $request, $id)
    {

        if ($request->ajax()) {

            $charity = $request->validate([
                'name' => 'required|string|unique:charities,name,' . $id,
                'desc' => 'required|string'
            ]);
            Charity::findOrfail($id)->update($charity);
            return response(['status' => true]);

        }

    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            Charity::findOrFail($id)->delete();
            return response(['status' => true]);
        }
    }

    public function addMember(Request $request , $user_id, $charity_id)
    {

        if ($request->ajax()) {
//            $users = DB::table('charity_user')->get(['user_id', 'charity_id']);

            $charity = DB::table('charity_user')->insert([
                'charity_id' => '1',
                'user_id' => \request('user_id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $url = route('removeMember',$user_id);

            return response(['status' => true,'url'=>$url]);

        }
    }

    public function removeMember(Request $request , $user_id, $charity_id)
    {

        if ($request->ajax()) {
//            $users = DB::table('charity_user')->get(['user_id', 'charity_id']);

            $charity = DB::table('charity_user')->where(['user_id'=>$user_id,'charity_id'=>$charity_id])->delete();
            $url = route('addMember',$user_id);
            return response(['status' => true,'url'=>$url]);

        }
    }


}
