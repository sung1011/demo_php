<?php
namespace App\console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class Taillog extends AbsSsh2
{
    protected function configure()
    {
        $this
        ->setName('taillog')
        // ->addOption('grep', 'g', InputArgument::OPTIONAL, 'grep some key word')
        ->addOption('type', 't', InputArgument::OPTIONAL, 'specify type of log', 'error')
        ->addOption('subtype', 'st', InputArgument::OPTIONAL, 'specify sybtype of log', 'game')
        ->addOption('linenum', 'l', InputArgument::OPTIONAL, 'show num of tail line', 50)
        ->addOption('date', 'd', InputArgument::OPTIONAL, 'show date of log', date('Ymd'))

        ->setDescription('show error log by sort date')
        ->setHelp('_')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get last date
        $date = date('Ymd', strtotime($input->getOption('date')));
        // $cmd = "ls ~/log/error;";
        // $date = $this->handle($cmd, function () {
        //     $dateDir = array_filter(explode("\n", $this->_stdOut), 'is_numeric');
        //     sort($dateDir);
        //     return end($dateDir);
        // });

        // get file path
        switch ($input->getOption('type')) {
            case 'error':
                $file = "~/log/error/{$date}/{$input->getOption('subtype')}/error.log;";
                break;
        }
        // tail log
        $cmd = "tail ";
        $cmd .= "-n {$input->getOption('linenum')} ";
        $cmd .= $file;

        $this->handle($cmd);

        $output->write($this->stdOut());
    }
}
