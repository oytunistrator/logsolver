<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogEntry;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['error'] = LogEntry::where('type','=','ERROR')->count() + LogEntry::where('type','=','EXCEPTION')->count();
        $data['warning'] = LogEntry::where('type','=','WARNING')->count();
        $data['info'] = LogEntry::where('type','=','INFO')->count();
        $data['total'] = $data['error'] + $data['warning'] + $data['info'];

        return view('welcome', $data);
    }
}
