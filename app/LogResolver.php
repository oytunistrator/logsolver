<?php

namespace App;

use App\Log;
use App\LogEntry;
use Illuminate\Support\Facades\Storage;
use \DateTime;

class LogResolver
{
    public $settings;
    public function __construct($type)
    {
        $typeList = [
            "tomcat" => [
                "splitter" => "|",
                "logstart" => "4",
                "datetime" => "3",
                "vm" => "1",
                "function" => "2",
            ],
            "other" => [
                "splitter" => false,
            ]
        ];

        foreach($typeList as $typeConf => $settings){
            if($type === $typeConf){
                $this->settings = $settings;
            }
        }

        
    }

    public function lineResolver(){
        $messageArr = [
            "WARN" => [
                "context" => "WARNING",
                "regex" => "/WARN/mi",
            ],
            "WARNING" => [
                "context" => "WARNING",
                "regex" => "/WARNING/mi",
            ],
            "INFO" => [
                "context" => "INFO",
                "regex" => "/INFO/mi",
            ],
            "ERROR" => [
                "context" => "ERROR",
                "regex" => "/ERROR/mi",
            ],
            "EXCEPTION" => [
                "context" => "EXCEPTION",
                "regex" => "/Exception/mi",
            ]
        ];


        $logs = Log::where('done', false)->get();

        foreach($logs as $log){
            $logUpdater = Log::find($log->id);
            $logFileContent = Storage::get($log->filename);

                $lines = explode("\n", $logFileContent);

                $i = 0;
                foreach($lines as $line){
                    if($this->settings['splitter']){
                        $logdate = "";
                        $content = explode($this->settings['splitter'], $line);
                        if(!empty($content[$this->settings['logstart']])){
                            $content = $content[$this->settings['logstart']];
                        }else{
                            $content = $line;
                        }
                    }else{
                        $content = $line;
                    }

                    $re = '/(\d{4}\/\d{2}\/\d{2} \d{2}:\d{2}:\d{2}.\d{3})/m';
                    preg_match_all($re, $line, $matches, PREG_SET_ORDER, 0);

                    if(!empty($matches[0][0])){
                        $d = strtotime($matches[0][0]);
                        $logdate = date('H:i d-m-Y',$d);
                    }

                    $l = 0;
                    foreach($messageArr as $checkKey => $checkContent){
                        if(preg_match($checkContent["regex"], $content)){
                            $logEntry = new LogEntry;
                            $logEntry->type = $checkContent["context"];
                            $logEntry->entry = $content;
                            $logEntry->line = $l;
                            $logEntry->logs_id = $logUpdater->id;
                            $logEntry->logdate = $logdate;
                            $logEntry->save();
                        }
                        $l++;
                    }

                    $i++;
                }

                $logUpdater->linecount = $i;
                $logUpdater->done = true;
                $logUpdater->save();
        }
    }
}
