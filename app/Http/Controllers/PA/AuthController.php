<?php

namespace App\Http\Controllers\PA;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginAttemp(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'username' => 'required | string',
            'password' => 'required | string | min:5',
            'captcha' => 'required  | captcha',
        ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
                'captcha.required' => 'Captcha tidak boleh kosong',
                'captcha.captcha' => 'Captcha tidak sesuai',
            ]
        );
        if ($validasi->fails()) {
            return response()->json($validasi->messages(), 200);
        }
        $user_data = array(
            'username'  => $request->get('username'),
            'password' => $request->get('password')
           );

        $user = User::where('username', $request->username)->first();
        if(!$user){
            return response()->json(['error' => true, 'message' => 'Username tidak ditemukan', 'redirect' => 'admin.login' ], 200);
        }

        if($validasi && $request->remember){
            if(Auth::attempt($user_data, true)){
                return response()->json(['success' => true, 'message' => 'Anda berhasil login.', 'redirect' => 'admin.dashboard' ], 200);
            }else{
                return response()->json(['error' => true, 'message' => 'Password Salah.', 'redirect' => 'admin.login' ], 200);
            }
        }elseif($validasi){
            if(Auth::attempt($user_data)){
                return response()->json(['success' => true, 'message' => 'Anda berhasil login.', 'redirect' => 'admin.dashboard' ], 200);
            }else{
                return response()->json(['error' => true, 'message' => 'Password Salah.', 'redirect' => 'admin.login' ], 200);
            }
        }

    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
