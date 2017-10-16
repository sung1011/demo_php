<?php
namespace App\console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command;

class Taillog extends Command
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

        $app = new \App\Application;
        $container = $app->getContainer();
        $ssh = $container['server.ssh'];
        $ssh->handle($cmd);

        $output->write($ssh->stdOut());
    }
}
