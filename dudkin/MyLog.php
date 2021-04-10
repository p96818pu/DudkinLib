<?php

namespace dudkin;

use core\LogAbstract;
use core\LogInterface;

class MyLog extends LogAbstract implements LogInterface{
    public function _write() {
        $dirLog = 'log\\';
        if (!file_exists($dirLog)) {
            mkdir($dirLog, 0700);
        }

        $dateLog = date('d.m.Y_H.i.s.v');
        foreach ($this->log as $v) {
            echo $v . "\r\n";
            file_put_contents("log\\$dateLog.log", $v . PHP_EOL, FILE_APPEND);
        }
    }
    public static function log(string $str):void {
        MyLog::Instance()->log[] =$str;
    }
    public static function write():void {
        MyLog::Instance()->_write();
    }
    public static function clearArray() {
        MyLog::Instance()->log = array();
    }
    public static function getLog() {
        return MyLog::Instance()->log;
    }
}
