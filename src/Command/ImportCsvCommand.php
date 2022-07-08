<?php

namespace App\Command;

use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import:csv',
    description: 'Import films from csv',
)]
class ImportCsvCommand extends Command
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('csvFilePath', InputArgument::REQUIRED, 'Path to csv file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csvFilePath = $input->getArgument('csvFilePath');

        // If file doesn't exist, throw an error
        if(!file_exists($csvFilePath))
        {
            $io->error(sprintf('Error: %s file not found', $csvFilePath));
            return Command::FAILURE;
        }

        $io->note(sprintf('Processing %s', $csvFilePath));

        $this->parseCsvFile($csvFilePath);

        $io->success('Import success.');

        return Command::SUCCESS;
    }

    protected function parseCsvFile(string $csvFilePath): bool
    {
        $csvFilePointer = fopen($csvFilePath, 'r');
        $lineNumber = 0;
        while (($csvFileRow = fgetcsv($csvFilePointer, 0, ',')) !== FALSE) {
            $lineNumber++;
            if($lineNumber == 1) continue;
            $newFilm = new Film();
            $dateValidationRegex = "/\d{4}\-\d{2}-\d{2}/";

            $title = $csvFileRow[1];
            $publishedAt = $csvFileRow[4];
            $gender = $csvFileRow[5];
            $duration = $csvFileRow[6];
            $producer = $csvFileRow[11];

            if($title == '') continue;
            if($publishedAt == '') continue;
            if($gender == '') continue;
            if($duration == '') continue;
            if($producer == '') continue;
            if(!preg_match($dateValidationRegex, $publishedAt)) continue;

            $newFilm->setTitle($csvFileRow[1]);
            $newFilm->setPublishedAt(new \DateTimeImmutable($publishedAt));
            $newFilm->setGender($csvFileRow[5]);
            $newFilm->setDuration($csvFileRow[6]);
            $newFilm->setProducer($csvFileRow[11]);
            $this->entityManager->persist($newFilm);
        }
        $this->entityManager->flush();
        return true;
    }
}
