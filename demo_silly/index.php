<?php
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Output\OutputInterface;

class MyCommand
{
    public function __invoke($name, OutputInterface $output)
    {
        if ($name) {
            $text = 'Hello, '.$name;
        } else {
            $text = 'Hello';
        }

        $output->writeln($text);
    }
}

$app = new Silly\Edition\PhpDi\Application();

$app->command('greet [name]', 'MyCommand');

$app->run();
