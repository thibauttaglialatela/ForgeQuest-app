<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:create_admin_user', description: 'Crée un administrateur')]
class CreateAdminUserCommand extends Command
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('Veuillez donner un email et un mot de passe sécurité')
            ->addArgument('email', InputArgument::REQUIRED, 'L\'email de l\'administrateur créé')
            ->addArgument('password', InputArgument::REQUIRED, 'Son mot de passe')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $adminUser     = new User();
        $plainPassword = $input->getArgument('password');
        $email         = $input->getArgument('email');
        $pattern       = '^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$^';

        try {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !is_string($email)) {
                throw new \InvalidArgumentException('L\'email de l\'administrateur n\'est pas valide');
            }

            $existingUser = $this->userRepository->findOneBy(['email' => $email]);
            if ($existingUser) {
                throw new \InvalidArgumentException('Utilisateur existant');
            }

            if (!is_string($plainPassword) || !preg_match($pattern, $plainPassword) || '' === $plainPassword) {
                throw new \InvalidArgumentException('Le mot de passe fourni est invalide');
            }

            $adminUser->setEmail($email);
            $adminUser->setPassword($this->passwordHasher->hashPassword($adminUser, $plainPassword));
            $adminUser->setRoles(['ROLE_ADMIN']);
            $adminUser->setPseudo('Dungeon Master');
            $adminUser->setIsVerified(true);

            $this->entityManager->persist($adminUser);
            $this->entityManager->flush();

            $output->writeln('Un administrateur a été créé');
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $output->writeln(sprintf('Une erreur est survenue : %s', $invalidArgumentException->getMessage()));

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
