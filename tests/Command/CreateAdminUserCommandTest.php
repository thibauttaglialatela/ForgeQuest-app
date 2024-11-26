<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\CreateAdminUserCommand;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateAdminUserCommandTest extends TestCase
{
    /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject */
    private UserRepository $userRepository;

    /** @var EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject */
    private EntityManagerInterface $entityManager;

    /** @var UserPasswordHasherInterface&\PHPUnit\Framework\MockObject\MockObject */
    private UserPasswordHasherInterface $passwordHasher;
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->entityManager  = $this->createMock(EntityManagerInterface::class);
        $this->passwordHasher = $this->createMock(UserPasswordHasherInterface::class);
        $command              = new CreateAdminUserCommand(
            $this->passwordHasher,
            $this->userRepository,
            $this->entityManager
        );

        $application = new Application();
        $application->add($command);

        $this->commandTester = new CommandTester($application->find('app:create_admin_user'));
    }

    public function testExecuteSuccess(): void
    {
        $this->userRepository->method('findOneBy')->willReturn(null);
        $this->passwordHasher->method('hashPassword')->willReturn('hashed_password');

        $this->entityManager
            ->expects($this->once())
            ->method('persist');
        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $this->commandTester->execute([
            'email'    => 'admin@admin.com',
            'password' => 'MonSuperPassword456',
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('Un administrateur a été créé', $output);
        $this->assertEquals(0, $this->commandTester->getStatusCode());
    }

    public function testExecuteFailsExistingUser(): void
    {
        // Mock pour un utilisateur existant
        $this->userRepository->method('findOneBy')->willReturn(new User());

        // Exécution de la commande
        $this->commandTester->execute([
            'email'    => 'admin@example.com',
            'password' => 'Secure123',
        ]);

        // Vérification des résultats
        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('Utilisateur existant', $output);
        $this->assertEquals(1, $this->commandTester->getStatusCode());
    }

    public function testInvalidEmail(): void
    {
        $this->commandTester->execute([
            'email'    => 'admin[alt]admin.com',
            'password' => 'MonSuperPassword456',
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('L\'email de l\'administrateur n\'est pas valide', $output);
        $this->assertEquals(1, $this->commandTester->getStatusCode());
    }

    public function testInvalidPassword(): void
    {
        $this->commandTester->execute([
            'email'    => 'admin@admin.com',
            'password' => '1234',
        ]);

        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('Le mot de passe fourni est invalide', $output);
        $this->assertEquals(1, $this->commandTester->getStatusCode());
    }
}
