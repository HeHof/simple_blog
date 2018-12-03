<?php

declare(strict_types = 1);

namespace AppBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Nelmio\Alice\FileLoaderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadFixturesCommand extends Command
{
    private $fileLoader;
    private $entityManager;
    private $fixturesFile;

    public function __construct(FileLoaderInterface $fileLoader, EntityManagerInterface $entityManager, string $projectDir)
    {
        parent::__construct('app:fixtures:load');

        $this->fileLoader = $fileLoader;
        $this->fixturesFile = $projectDir . '/src/AppBundle/DataFixtures/post.yaml';
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Loading fixtures to database');

        $io->comment('Rebuilding database schema');
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->dropDatabase();
        $schemaTool->createSchema($this->entityManager->getMetadataFactory()->getAllMetadata());

        $io->comment('Generating objects');
        $fixtures = $this->fileLoader->loadFile($this->fixturesFile)->getObjects();

        $io->comment('Persisting objects');
        array_walk($fixtures, [$this->entityManager, 'persist']);

        $io->comment('Flushing to database');
        $this->entityManager->flush();

        $io->success('Done');

        return 0;
    }
}
