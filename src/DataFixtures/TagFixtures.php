<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class TagFixtures extends Fixture
{
    public const TAGS = [
        'Adventure',
        'Drama',
        'Horror',
        'Science Fiction',
        'Mystery',
        'Fantasy',
        'Thriller',
        'Romance',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_Fr');

        foreach (self::TAGS as $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);

            $manager->persist($tag);
            $this->setReference('tag_' . $tagName, $tag);
        }

        $manager->flush();
    }
}
