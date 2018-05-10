<?php

namespace App\Http\Controllers;

use App\LogEntry;
use Illuminate\Http\Request;

class LogEntryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("logentry/logentries");
    }

    public function data()
    {
        return datatables()->of(LogEntry::all())->toJson();
    }
}
