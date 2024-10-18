<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Scenario;
use App\Entity\Tag;
use App\Entity\Univers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class ScenarioFixtures extends Fixture implements DependentFixtureInterface
{
    public const SCENARIO_REFERENCE = 'scenario-';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Loop through each Univers reference
        foreach (UniversFixtures::UNIVERS as $key => $universName) {
            for ($i = 0; $i < 2; ++$i) {
                $scenario = new Scenario();
                $scenario->setTitle($faker->text(50));
                $scenario->setResume($faker->paragraph());

                // Fetch the Univers entity reference by its name
                $univers = $this->getReference('Univers_' . $universName);
                if ($univers instanceof Univers) {
                    $scenario->setUnivers($univers);
                }
                $scenario->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 months')));
                $scenario->setImageFile($faker->imageUrl());
                $scenario->setImageAlt($faker->text(50));
                $scenario->setPublished(true);

                // Assign multiple random tags from TagFixtures to each Scenario
                $randomTags = $faker->randomElements(TagFixtures::TAGS, rand(2, 5));
                foreach ($randomTags as $tagName) {
                    $tag = $this->getReference('tag_' . $tagName);
                    if ($tag instanceof Tag) {
                        $scenario->addTag($tag);
                    }
                }

                $manager->persist($scenario);

                // Ensure unique reference keys for each scenario
                $this->addReference(self::SCENARIO_REFERENCE . $key . '-' . $i, $scenario);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UniversFixtures::class,
            TagFixtures::class,
        ];
    }
}
