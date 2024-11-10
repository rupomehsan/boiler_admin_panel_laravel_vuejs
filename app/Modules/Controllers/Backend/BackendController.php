<?php

namespace App\Modules\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function SuperAdminPanel()
    {
        return view('backend.superadmin-dashboard');
    }
    public function AdminPanel()
    {
        return view('backend.admin-dashboard');
    }
}
