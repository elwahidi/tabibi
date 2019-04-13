<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ParameterRequest;
use App\Http\Requests\User\PswRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function parameter()
    {

        return view('user.parameter', [
            'user'    => auth()->user()
        ]);

    }

    public function update(ParameterRequest $request)
    {

        $data = $request->all([
            'last_name', 'first_name',
            'email', 'birth', 'description',
        ]);

        $data['sexe_id'] = $request->sexe;
        $data['city_id'] = $request->city;

        if($request->specialty){

            $data['specialty_id'] = $request->specialty;

        }


        if($request->file('face')){

            if(auth()->user()->face){

                Storage::disk('public')->delete(auth()->user()->face);

            }

            $face = $request->file('face')->store('public/face');

            $data['face'] = $face;
        }

        auth()->user()->update($data);

        session()->flash('success', __('user.parameter.success'));

        return redirect()->route('home');

    }

    public function psw()
    {

        return view('user.psw');

    }

    public function updatePsw(PswRequest $request)
    {
        auth()->user()->password = bcrypt($request->password);

        auth()->user()->save();

        session()->flash('success', __('user.psw.success'));

        return redirect()->route('home');

    }
}
