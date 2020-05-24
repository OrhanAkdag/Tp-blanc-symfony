<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        {
            // create 20 articles! Bam!
            for ($i = 1; $i < 9; $i++) {
                $article = new Article();
                $auteur = $manager->getRepository(User::class)->findAll()[0];
                $article->setTitre('Titre de l\'article n° '.$i);
                $article->setContenu('Ceci est le contenu de mon article n° '.$i);
                $article->setAuteur($auteur);
                $article->setCreatedAt(new \DateTime());
                $article->setImageName('image'.$i.'.png');
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
