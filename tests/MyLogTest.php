<?php

use dudkin\MyLog;
use PHPUnit\Framework\TestCase;

class MyLogTest extends TestCase {

    public static $log = [];

    public static function setUpBeforeClass(): void {
        MyLog::clearArray();
        $dirLog = 'log\\';
        if (!file_exists($dirLog)) {
            mkdir($dirLog, 0755);
        }
    }

    /**
     * @dataProvider providerLog
     * @param string $str
     * @return void
     */
    public function testLog(string $str): void {
        MyLog::log($str);
        self::$log[] = $str;
        // сообщение об ошибке, если указанные переменные не имеют один и тот же тип данных и значения
        $this->assertSame(self::$log, MyLog::getLog());
    }

    public function providerLog() {
        return array(
            array('Footbal'),
            array('Dudkin')
        );
    }

    protected function _scandir($dir, $exp, $how = 'name', $desc = 0) {
        $r = array();
        $dh = @opendir($dir);
        if ($dh){
            while(($fname = readdir($dh)) !== false) {
                if (preg_match($exp, $fname)) {
                    $stat = stat("$dir/$fname");
                    $r[$fname] = ($how == 'name')? $fname: $stat[$how];
                }
            }
            closedir($dh);
            if ($desc){
                arsort($r);
            }else{
                asort($r);
            }
        }
        return(array_keys($r));
    }

    /**
     * @depends testLog
     */
    public function testWrite() {
        $actualText = '';
        foreach(self::$log as $v){
            $actualText .= "{$v}\r\n";
        }
        // ожидаемый вывод
        $this->expectOutputString($actualText);
        MyLog::write();
        // сообщение об ошибке, если указанная папка не существует
        $this->assertDirectoryExists('log');
        $textLog=$this->_scandir(
            'log\\',
            '/'.date('d.m.Y_H.i.s.v').'[0-9.]*\.log$/',
            'ctime',
            1) [0];
        // сообщение об ошибке, если указанный файл не существует
        $this->assertFileExists("log\\".$textLog);
        // сообщение об ошибке, если файл или папка не доступны для чтения
        $this->assertIsReadable("log\\".$textLog);
        // сообщение об ошибке, если ожидаемый файл не имеет актуального значения
        $this->assertStringEqualsFile("log\\".$textLog, $actualText);
    }
}