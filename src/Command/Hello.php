<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Hello extends Command
{
    protected static $defaultName = 'hello';

    public function __construct()
    {
        parent::__construct();
    }

    public function configure(): void
    {
        $this->setDescription('An example command');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello!');

        return 1;
    }
}
