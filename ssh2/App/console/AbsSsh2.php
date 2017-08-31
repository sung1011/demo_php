<?php
namespace App\console;

use Symfony\Component\Console\Command\Command;
/**
* php ssh抽象类
* require 需要安装ssh2拓展
*/
Abstract Class AbsSsh2 extends Command
{
    private $_conn;
    private $_stream;
    private $_errorStream;

    protected $_stdOut;
    protected $_stdErr;

    public function __construct()
    {
        if(!$this->_conn) {
            $conn = ssh2_connect('172.16.110.84', 22);
            $user = 'playcrab';
            $pass = '';
            ssh2_auth_password($conn, $user, $pass);
            $this->_conn = $conn;
        }
        parent::__construct();
    }

    public function handle($cmd, $callBack = null)
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

    protected function std()
    {
        $str = '';
        $splitLine = '----------------------------------';
        $str .= $this->_stdOut ? "stdOut: " . PHP_EOL . $splitLine . PHP_EOL . $this->_stdOut : '';
        $str .= $this->_stdErr ? "stdErr: " . PHP_EOL . $splitLine . PHP_EOL . $this->_stdErr : '';
        return $str;
    }

    public function __call($func, $param)
    {
    }
}
