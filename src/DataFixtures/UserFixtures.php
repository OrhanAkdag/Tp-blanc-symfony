<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setEmail('admin@admin.fr');
        $user->setName('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$dG5wa3djei9NTUVaSUc3bw$6PGxmpm+uJ+9PZGkbagWOsbNu+4y0hxuE/OT+FA57TE');
        $manager->persist($user);
        $manager->flush();

    }

}
