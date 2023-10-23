<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Review;
use App\Entity\Service;
use App\Entity\CarOffer;
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
            $review->setReviewText($this->faker->text())
            ->setScore(mt_rand(3, 4))
            ->setIsApproved(False);

            $carOffer = new CarOffer();
            $carOffer->setTitle($this->faker->words(4, true))
            ->setPrice($this->faker->randomNumber(5, true))
            
            ->setYear($this->faker->year())
            ->setMileage($this->faker->randomNumber(6));

            $service = new Service();
            $service->setTitle($this->faker->words(20, true))
            ->setDescription($this->faker->text());
            
            $image = new Image();
            $image->setFileName("https://picsum.photos/200/300");
            $image->setIsMain($this->faker->boolean());
            

            $manager->persist($review);
            $manager->persist($carOffer);
            $manager->persist($service);
            $manager->persist($image);
        }
        
        
        
        $manager->flush();
    }
}