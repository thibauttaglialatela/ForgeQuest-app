<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\Univers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UniversControllerTest extends WebTestCase
{
    public function testShowOneUniversWithExistingUnivers(): void
    {
        $client = static::createClient();

        $universId = $this->createUniversFixture();

        // Request a specific page
        $client->request('GET', sprintf('/univers/%d', $universId));

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Nom de l\'univers');
    }

    public function testShowOneUniversWithNonExistingUnivers(): void
    {
        $client = static::createClient();

        $client->request('GET', '/univers/666');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    private function createUniversFixture(): int
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = self::getContainer()->get('doctrine.orm.entity_manager');

        $univers = new Univers();
        $univers->setName('Nom de l\'univers');
        $univers->setDescription('Description de l\'univers');
        $univers->setCreatedAt(new \DateTimeImmutable('now'));

        $entityManager->persist($univers);
        $entityManager->flush();

        if (null === $univers->getId()) {
            throw new \RuntimeException('Unable to create univers!');
        }

        return $univers->getId();
    }
}
