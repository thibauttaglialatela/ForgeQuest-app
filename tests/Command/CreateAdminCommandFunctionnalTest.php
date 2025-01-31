<?php

declare(strict_types=1);

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateAdminCommandFunctionnalTest extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testExecute(): void
    {
        $kernel      = self::bootKernel();
        $application = new Application($kernel);

        $command       = $application->find('app:create_admin_user');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'email'    => 'john.doe@test.com',
            'password' => 'Password123456',
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Un administrateur a été créé', $output);
    }
}
