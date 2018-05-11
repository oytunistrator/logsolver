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

    public function data(Request $request)
    {
        if(isset($request->type)){
            $data = LogEntry::where('type', '=', $request->type)->get();
        }else{
            $data = LogEntry::all();
        }
        return datatables()->of($data)->toJson();
    }

    public function view($id){
        $data = [];
        $data['entry'] = LogEntry::find($id);
        $data['warning'] = false;
        switch($data['entry']['type']){
            case "WARN":
                $data['typeClass'] = "warning";
            case "WARNING":
                $data['typeClass'] = "warning";
            case "ERROR":
                $data['typeClass'] = "danger";
            case "EXCEPTION":
                $data['typeClass'] = "danger";     
            case "INFO":
                $data['typeClass'] = "info";         
        }
        if(strlen($data['entry']) > 1000){
            $data['entry'] = substr($data['entry'], 0, 1000).'...';
            $data['warning'] = true;
        }
        return view('logentry/view', $data);
    }
}
