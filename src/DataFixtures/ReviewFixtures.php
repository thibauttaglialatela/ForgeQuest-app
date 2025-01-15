<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Review;
use App\Entity\Scenario;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; ++$i) {
            for ($key = 0; $key < 5; ++$key) {
                for ($j = 0; $j < 2; ++$j) {
                    $scenarioReference = ScenarioFixtures::SCENARIO_REFERENCE . $key . '-' . $j;

                    $scenario = null;

                    if ($this->hasReference($scenarioReference, Scenario::class)) {
                        /** @var Scenario $scenario */
                        $scenario = $this->getReference($scenarioReference, Scenario::class);
                    }
                    if (null === $scenario) {
                        continue;
                    }
                    $review = new Review();
                    $user   = $this->getReference('user_' . $i, User::class);
                    if ($user instanceof User) {
                        $review->setAuthor($user);
                    }
                    $review->setScenario($scenario);
                    $review->setComment($faker->realText());
                    $review->setGrade($faker->numberBetween(1, 5));
                    $review->setPublished(true);
                    $review->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month')));
                    $manager->persist($review);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ScenarioFixtures::class,
        ];
    }
}
