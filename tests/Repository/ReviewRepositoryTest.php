<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\Review;
use App\Entity\Scenario;
use App\Entity\Univers;
use App\Entity\User;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ReviewRepositoryTest extends KernelTestCase
{
    private ReviewRepository $reviewRepository;
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        self::bootKernel();

        // Récupérer le repository et l'EntityManager
        $this->reviewRepository = self::getContainer()->get(ReviewRepository::class);
        assert($this->reviewRepository instanceof ReviewRepository);
        $this->entityManager = $this->getEntityManager();

        // Supprimer toutes les données existantes pour isoler le test
        $connection = $this->entityManager->getConnection();
        $connection->executeQuery('DELETE FROM review');
        $connection->executeQuery('DELETE FROM scenario');
        $connection->executeQuery('DELETE FROM univers');
        $connection->executeQuery('DELETE FROM user');
    }

    private function getEntityManager(): EntityManagerInterface
    {
        $manager = self::getContainer()->get('doctrine')->getManager();
        if (!$manager instanceof EntityManagerInterface) {
            throw new \LogicException('The entity manager is not an instance of EntityManagerInterface');
        }

        return $manager;
    }

    public function testCalculateScenarioAverageGrade(): void
    {
        // créer un univers de test
        $univers = new Univers();
        $univers->setName('Emysfer');
        $univers->setDescription('Le jeu de Science Fantasy médiéval');
        $date = new \DateTime('2014-06-18 Europe/London');
        $univers->setCreatedAt(\DateTimeImmutable::createFromMutable($date));
        $this->entityManager->persist($univers);

        // créer l'auteur
        $author = new User();
        $author->setEmail('jane.doe@test.com');
        $author->setPassword('dgdsgdsgdshgggdgdsggdsg');
        $this->entityManager->persist($author);

        // Créer un scénario de test
        $scenario = new Scenario();
        $scenario->setTitle('Test Scenario');
        $scenario->setResume('Le contenu du scénario');
        $date = new \DateTime('2014-06-20 11:45 Europe/London');
        $scenario->setCreatedAt(\DateTimeImmutable::createFromMutable($date));
        $scenario->setUnivers($univers);
        $scenario->setAuthor($author);
        $this->entityManager->persist($scenario);

        // Créer des reviews liées au scénario
        $review1 = (new Review())
            ->setGrade(4)
            ->setScenario($scenario)
            ->setIsPublished(true)
            ->setComment('test comment')
            ->setCreatedAt(new \DateTimeImmutable());

        $review2 = (new Review())
            ->setGrade(5)
            ->setScenario($scenario)
            ->setIsPublished(true)
            ->setComment('test comment')
            ->setCreatedAt(new \DateTimeImmutable());

        $review3 = (new Review())
            ->setGrade(3)
            ->setScenario($scenario)
            ->setComment('test comment')
            ->setIsPublished(false) // Non publié, ne sera pas compté
            ->setCreatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($review1);
        $this->entityManager->persist($review2);
        $this->entityManager->persist($review3);

        $this->entityManager->flush();

        // Appeler la méthode à tester
        if (null === $scenario->getId()) {
            throw new \LogicException('Cannot be null');
        }

        $averageGrade = $this->reviewRepository->calculateScenarioAverageGrade($scenario->getId());

        // Vérifier que la moyenne est correcte (4.5 arrondi à 5)
        $this->assertSame(5, $averageGrade);
    }
}
