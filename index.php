<?php

/**
 * 一个测试类
 */
class test
{
    private $dirInfo = [];

    function __construct()
    {
        set_error_handler([$this, 'errorHandle']);
        register_shutdown_function([$this, 'shutdown']);
    }

    public function foo()
    {
        require '乱写的';
        $a = $d;
        // $this->getFileAll(dirname(__FILE__));
    }

    /**
     * 自定义错误处理
     */
    public function errorHandle($errno, $errstr, $errfile, $errline)
    {
        // print_r(get_defined_vars());
        echo __FUNCTION__ . '进来了';
    }

    public function shutdown()
    {
        echo __FUNCTION__ . '进来了';

        $err = error_get_last();
        print_r($err);
    }

    /**
     * 获取目录下所有文件的路径
     */
    public function getFileAll($path)
    {
        $fileList = array_diff(scandir($path), ['.', '..']);
        foreach($fileList as $file) {
            $f = $path . '/' . $file;
            if(is_dir($f)) {
                $this->getFileAll($f);
            } elseif(is_file($f)) {
                array_push($this->dirInfo, $f);
            }
        }
    }
}

$t = new test;
$t->foo();

// require '乱写的';
// $err = error_get_last();
// print_r($err);
