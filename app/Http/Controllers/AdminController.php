<?php

namespace App\Http\Controllers;

use App\Log;
use App\LogEntry;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    function panel(){
        $data = [];
        $data['total_log'] = Log::all()->count();
        $data['total_entries'] = LogEntry::all()->count();
        return view('admin/admin', $data);
    }


    function clearPost($option){
        $result['result'] = "false"; 
        switch($option){
            case "logs":
                $result['result'] = Log::truncate();
            case "entries":
                $result['result'] = LogEntry::truncate();
        }
        return $result;
    }

}
