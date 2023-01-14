<?php


namespace Paroki\Migration\Command;


use Paroki\Migration\Referensi\ReferensiImport;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends Command
{
    /**
     * @var ReferensiImport
     */
    private ReferensiImport $referensi;

    public function __construct(
        ReferensiImport $referensi
    )
    {
        parent::__construct('import');

        $this->referensi = $referensi;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->referensi->start();
        return Command::SUCCESS;
    }
}