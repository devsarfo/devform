<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data = array();
        $data['subview'] = 'dashboard.index';
        $data['page_title'] = 'Dashboard';
        return view('layout', $data);
    }
}
