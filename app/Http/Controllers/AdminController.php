<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function index()
    {
        return view('admin_login');
    }

    // Xử lý đăng nhập
    public function dashboard(Request $request)
    {
        // Lấy email và mật khẩu từ form
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        // Tìm tài khoản theo email
        $result = DB::table('tbl_admin')
            ->where('admin_email', $admin_email)
            ->first();

        // Kiểm tra tài khoản và mật khẩu
        if ($result && Hash::check(
            $admin_password,
            $result->admin_password
        )) {

            // Lưu thông tin vào Session
            $request->session()->regenerate();
            $request->session()->put(
                'admin_name',
                $result->admin_name
            );
            
            $request->session()->put(
                'admin_id',
                $result->admin_id
            );

            
            return redirect('/dashboard');

        } else {

            
            return redirect('/admin')
                ->with('message',
                    'Email hoặc mật khẩu không chính xác!');
        }
    }

    // Hiển thị Dashboard
    public function showDashboard()
    {
        $check = $this->AuthLogin();

        if ($check) {
            return $check;
        }

        return view('admin.dashboard');
    }

    // Kiểm tra đăng nhập
    public function AuthLogin()
    {
        $admin_id = session()->get('admin_id');

        if (!$admin_id) {
            return redirect('/admin')
                ->with('message',
                    'Vui lòng đăng nhập trước!');
        }

        return null;
    }

    // Đăng xuất
    public function logout()
    {
        session()->invalidate();

        session()->regenerateToken();

        return redirect('/admin');
    }
}
