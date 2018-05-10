<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
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
        return view("logfiles/logs");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $log = Log::find($id);
        //Log::delete($id);
        if($log){
            $log->delete();
        }
        return back()->withInput();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploader()
    {
        return view("logfiles/uploader");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result['result'] = false;
        if ($request->file('file')) {
            $result['file'] = $request->file('file')->getClientOriginalName();
            $result['ext'] = $request->file('file')->getClientOriginalExtension();
            $result['target_name'] = md5($result['file'].microtime()).".".$result['ext'];
            $result['uploaded'] = $request->file('file')->storeAs('images', $result['target_name']);
            $result['result'] = true;

            $log = new Log();
            $log->filename = $request->file('file')->storeAs('images', $result['target_name']);
            $log->save();
        }
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        return datatables()->of(Log::all())->toJson();
    }
}
