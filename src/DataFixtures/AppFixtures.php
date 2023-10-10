<?php

namespace App\DataFixtures;

use App\Entity\CarOffer;
use Faker\Generator;
use Faker\Factory;
use App\Entity\Review;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    /**
     *
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }   
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <= 18 ; $i++) {
            $review = new Review();
            $review->setName($this->faker->name())
            ->setReviewText($this->faker->text())
            ->setScore(mt_rand(3, 4))
            ->setApproved(False);

            $carOffer = new CarOffer();
            $carOffer->setTitle($this->faker->words(4, true))
            ->setPrice($this->faker->randomNumber(5, true))
            ->setPhoto("https://picsum.photos/200/300")
            ->setYear($this->faker->year())
            ->setMileage($this->faker->randomNumber(6));

            $manager->persist($review);
            $manager->persist($carOffer);
        }
        
        
        
        $manager->flush();
    }
}