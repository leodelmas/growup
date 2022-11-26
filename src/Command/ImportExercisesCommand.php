<?php

namespace App\Command;

use App\Entity\RecordedExercise;
use App\Repository\MuscleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:exercises',
    description: 'Import exercises from API Ninjas, see https://api-ninjas.com/api/exercises',
)]
class ImportExercisesCommand extends Command
{
    public function __construct(
        private HttpClientInterface $client,
        private MuscleRepository $muscleRepository,
        private EntityManagerInterface $entityManager,
        private string $ninjasApiKey
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('muscle', InputArgument::REQUIRED, 'Muscle group targeted by the exercise')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $muscleArg = $input->getArgument('muscle');

        dd($this->ninjasApiKey);

        $response = $this->client->request('GET', 'https://api.api-ninjas.com/v1/exercises?muscle=' . $muscleArg, [
            'headers' => [
                'X-Api-Key' => $this->ninjasApiKey
            ],
        ]);

        $muscle = $this->muscleRepository->findOneBy([
            'name' => ucwords(str_replace(' ', '_', $muscleArg))
        ]);

        foreach ($response->toArray() as $rawExerciseData) {
            $recordedExercise = new RecordedExercise();
            $recordedExercise
                ->setName($rawExerciseData["name"])
                ->setDescription($rawExerciseData["instructions"])
            ;
            if ($muscle) $recordedExercise->addMuscle($muscle);
            $this->entityManager->persist($recordedExercise);
            $io->info($recordedExercise->getName() . ' saved');
        }
        $this->entityManager->flush();

        $io->success('Import finished');

        return Command::SUCCESS;
    }
}
