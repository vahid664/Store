<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request,[
            'name_family' => 'required|string|min:2|max:255',
            'mobile' => 'required|digits:11',
            'tell' => 'nullable|numeric',
            'post_code' => 'nullable|numeric',
            'province' => 'required|string|min:2|max:255',
            'city' => 'required|string|min:2|max:255',
            'address' => 'required|string|min:2|max:500',
        ]);

        $count=UserAddress::where('user_id',Auth::user()->id)->where('status',1)->count();
        if($count==0)
        {
            UserAddress::create(array_merge(['user_id' => Auth::user()->id,'status' => 1],$request->all()));
        }
        else
        {
            UserAddress::create(array_merge(['user_id' => Auth::user()->id],$request->all()));
        }
        return redirect(url('buy/info'));
    }

    public function show($id)
    {
        $find=UserAddress::findOrFail($id);
        $update=UserAddress::where('user_id',Auth::user()->id)->update(['status' => 0]);
        $find->update(['status' => 1]);
        return redirect()->back();
    }

    public function create()
    {
        $title='ثبت آدرس جدید';
        return view('user.address.index',compact('title'));
    }

    public function delete($id)
    {
        $find=UserAddress::findOrFail($id)->delete();
        return redirect()->back();
    }
}
