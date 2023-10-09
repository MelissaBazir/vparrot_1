<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Generator;

class AppFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <= 50 ; $i++) {
            $review = new Review();
            $review->setName('Laurent' . $i)
            ->setReviewText('Très professionnel')
            ->setScore(mt_rand(3, 4))
            ->setApproved(False);

            $manager->persist($review);
        }
        
        
        
        $manager->flush();
    }
}