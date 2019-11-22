<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard 
     * are allowed.
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth:admin');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // dd(auth()->user()->isAdmin());
        return view('admin.index'); //"Dashboard Controller";
    }
}
