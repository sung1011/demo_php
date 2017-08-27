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
        ->addOption('linenum', 'l', InputArgument::OPTIONAL, 'show num of tail line', 50)

        ->setDescription('show error log by sort date')
        ->setHelp('_')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get last date
        $cmd = "ls ~/log/error;";
        $date = $this->handle($cmd, function () {
            $dateDir = array_filter(explode("\n", $this->_stdOut), 'is_numeric');
            sort($dateDir);
            return end($dateDir);
        });

        // tail log
        $cmd = "tail ";
        if($input->hasOption('linenum')) {
            $cmd .= "-n {$input->getOption('linenum')} ";
        }
        $cmd .= "~/log/error/{$date}/{$input->getOption('type')}/error.log;";
        $this->handle($cmd);
        
        $output->write($this->std());
    }
}
