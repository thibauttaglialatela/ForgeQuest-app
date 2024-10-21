<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Univers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class UniversFixtures extends Fixture
{
    public const UNIVERS = [
        'Space Opera',
        'Horreur contemporain',
        'Fantasy',
        'Cyberpunk',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (self::UNIVERS as $universName) {
            $univers = new Univers();
            $univers->setName($universName);
            $univers->setDescription($faker->realText());
            $univers->setImageFile('https://picsum.photos/450/300');
            $univers->setImageAlt($univers->getName());
            $univers->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 months')));

            $manager->persist($univers);

            // Add a reference for each Univers entity, using its name as a reference key
            $this->addReference('Univers_' . $universName, $univers);
        }

        $manager->flush();
    }
}
