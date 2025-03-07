<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index($page)
    {
        $validPages = ['login', 'register', 'forgot'];

        if (!in_array($page, $validPages)) {
            abort(404);
        }

        // Kiểm tra xem file view có tồn tại không
        if (!view()->exists("login.$page")) {
            abort(404, "Page not found"); // Hoặc redirect, tùy ý
        }

        return view("login.$page");
    }



    public function login(Request $request)
    {
        $check = ([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (Auth::attempt($check)) {
            $user = Auth::user(); // Lấy user đang đăng nhập
            // session()->put('key', $value);
            session()->put('name', $user->name); // Lưu tên vào session
            return redirect()->route('listUser')->with('list-success', "Welcome List");
        }

        return redirect()->back()->with('L-failed', 'Wrong email or password');
    }

    /**
     * laravel support
     * logout
     */
    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect()->route('index', ['page' => 'login'])->with('logout-success', "logout successfully!");
    }

    /**
     * show list user
     */
    public function listUser()
    {
        /**
         * check user had login?
         */
        if (!Auth::check()) {
            return redirect()->route('index', ['page' => 'login'])->with('Right-login', 'Please login first!');
        }

        /**
         * show list user
         */
        $ds = User::orderby('created_at', 'desc')->get();
        return view('layout.list', compact('ds'));
    }

    /**
     * register
     */
    public function register(Request $req)
    {
        $username = $req->input('name');
        $email = $req->input('email');
        $pw = $req->input('password');
        $pw_c = $req->input('password_c');

        // Kiểm tra email đã tồn tại chưa
        if (User::where('email', $email)->exists()) {
            return redirect()->back()->with('email-existed', "Email existed, please use another email!");
        }

        if ($pw !== $pw_c) {
            return redirect()->back()->with('pw-wrong', "Password do not match");
        }

        User::create([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($pw),
        ]);

        return redirect()->route('index', ['page' => 'login'])->with('register-success', 'Welcome to our website!');
    }

    /**
     * tự code
     */

    // public function logout(Request $req)
    // {
    //     // Xóa thông tin user khỏi session
    //     $req->session()->forget('user_id');
    //     $req->session()->forget('user_email');

    //     // Xóa toàn bộ session (tương tự invalidate())
    //     $req->session()->flush();

    //     // Tạo lại CSRF token (tương tự regenerateToken())
    //     $req->session()->regenerate();

    //     // Chuyển hướng về trang login
    //     return redirect()->route('index', ['page' => 'login'])->with('logout-success', 'Đăng xuất thành công!');
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('listUser')->with('delete-success', 'Deleted successfully!');
    }

    /**
     * check email exists để vào form-forgot
     */
    public function forgot(Request $rq)
    {
        $email = $rq->input('email');
        if (User::where('email', $email)->first()) {
            session()->put('email_show', $rq->email); // Lưu tên vào session
            return redirect()->route('forgot_form')->with('update-email', 'Please update password new');
        }

        return redirect()->back()->with('update-failed', 'Email not exists, Please create account new!');
    }


    public function forgot_form()
    {
        return view('login.form-forgot');
    }

    public function update_pw(Request $rq) {}
}