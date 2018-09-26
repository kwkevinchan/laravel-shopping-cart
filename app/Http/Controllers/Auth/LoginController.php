<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;


class LoginController extends Controller
{

    protected $redirectTo = '/';

    public function index()
    {
        return view('auth.login');
        //測試用
        // $user = User::where('name', '=', 'inDevModel')->first();
        // Auth::login($user);
        // session()->flash('status', 'danger');
        // session()->flash('message', '此為測試版本，正式版本請關閉自動登入功能');
        // return redirect('/');
    }

    public function login(Request $request)
    {
        // return dd($request->request);
        $password = $request->password;
        $user = User::where('name', '=', $request->name)->first();

        if($user){
            if(Hash::check($password, $user->password)){
                Auth::login($user);
                session()->flash('status', 'success');
                session()->flash('message', '登入成功<br>歡迎:'. $user->name);
                return redirect('/');
            }
        }
    
        session()->flash('status', 'danger');
        session()->flash('message', '登入失敗!!');
        return redirect('login');
    }

    public function logout(){
        Auth::logout();
        session()->flash('status', 'success');
        session()->flash('message', '您已成功登出!!');
        return redirect('login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register(){
        return view('auth.register');
    }

    public function store(Request $request){
        if(User::where('name', $request->name)->first()){
            session()->flash('status', 'danger');
            session()->flash('message', '您的姓名已被使用!!');
            return redirect('register');
        } elseif($request->password != $request->password_confirmed) {
            session()->flash('status', 'danger');
            session()->flash('message', '密碼確認錯誤，請輸入兩次相同的密碼!!');
            return redirect('register');
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            Auth::login($user);
            session()->flash('status', 'success');
            session()->flash('message', '註冊成功<br>歡迎:'. $user->name);
            return redirect('/');
        }
    }

    use AuthenticatesUsers;

}