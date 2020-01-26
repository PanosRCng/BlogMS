<?php
/**
 * Created by PhpStorm.
 * User: panos
 * Date: 1/24/20
 * Time: 11:30 PM
 */

namespace App\Http\Controllers\Auth;


use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('auth/settings');
    }


    public function change_password(Request $request)
    {
        $r = [
            'password' => $request->get('password'),
            'password_confirmation' => $request->get('password_confirmation')
        ];

        $validator = Validator::make($r, [
            'password' => 'required|string|min:5|confirmed',
        ]);

        if( $validator->fails() )
        {
            return redirect()->back()->withErrors($validator);
        }

        $user = Auth::user();
        $user->password = bcrypt($r['password']);
        $user->save();


        return redirect('/dashboard');
    }

}