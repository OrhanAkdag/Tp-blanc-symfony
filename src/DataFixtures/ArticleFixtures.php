<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        {
            // create 20 articles! Bam!
            for ($i = 1; $i < 9; $i++) {
                $article = new Article();
                $article->setTitre('Titre de l\'article n° '.$i);
                $article->setContenu('Ceci est le contenu de mon article n° '.$i);
                $article->setAuteur('Admin');
                $article->setCreatedAt(new \DateTime());
                $article->setImageName('300x200.png');
                $manager->persist($article);
            }
    
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }

}
