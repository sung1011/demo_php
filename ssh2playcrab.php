<?php

class Ssh2playcrab
{
    private $_conn;
    private $_stream;
    private $_errorStream;
    private $_stdOut;
    private $_stdErr;
    
    function __construct()
    {
        $conn = ssh2_connect('172.16.110.84', 22);
        $user = 'playcrab';
        $pass = 'play!@#crab';
        ssh2_auth_password($conn, $user, $pass);
        $this->_conn = $conn;
    }
    
    function showErrorLog($tailLine = 50)
    {
        $cmd = "ls ~/log/error;";
        $rs = $this->handle($cmd, function () {
            $dateDir = array_filter(explode("\n", $this->_stdOut), 'is_numeric');
            sort($dateDir);
            return end($dateDir);
        });
        $cmd = "tail -n {$tailLine} ~/log/error/{$rs}/game/error.log;";
        $this->handle($cmd);

        echo $this->_stdOut ? "stdOut: " . PHP_EOL . $this->_stdOut : '';
        echo $this->_stdErr ? "stdErr: " . PHP_EOL . $this->_stdErr : '';
    }
    
    function handle($cmd, $callBack = null)
    {
        $this->_stream = ssh2_exec($this->_conn, $cmd);
        $this->_errorStream = ssh2_fetch_stream($this->_stream, SSH2_STREAM_STDERR);
        stream_set_blocking($this->_stream, true);
        stream_set_blocking($this->_errorStream, true);
        $this->_stdOut = stream_get_contents($this->_stream);
        $this->_stdErr = stream_get_contents($this->_errorStream);
        $rs = $callBack ? $callBack() : null;
        if ($this->_errorStream) {
            fclose($this->_errorStream);
        }
        if ($this->_stream) {
            fclose($this->_stream);
        }
        return $rs;
    }
    
    function _before()
    {
    }
    
    function _after()
    {
    }

    function __call()
    {

    }
}

$o = new Ssh2playcrab;
$o->showErrorLog();
