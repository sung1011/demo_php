<?php
namespace App\server;

/**
* php ssh server类
* require 需要安装ssh2拓展
*/
class Ssh
{
    private $_conn;
    private $_stream;
    private $_errorStream;

    protected $_stdOut;
    protected $_stdErr;

    private function getConn()
    {
        if (!$this->_conn) {
            $conn = ssh2_connect('', 22);
            $user = '';
            $pass = '';
            ssh2_auth_password($conn, $user, $pass);
            $this->_conn = $conn;
        }
        return $this->_conn;
    }

    public function handle($cmd, $callBack = null)
    {
        $conn = $this->getConn();
        $this->_stream = ssh2_exec($conn, $cmd);
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

    public function stdOut()
    {
        return $this->_stdOut;
    }

    public function stdErr()
    {
        return $this->_stdErr;
    }

    // public function __call($func, $param)
    // {
    // }
}
