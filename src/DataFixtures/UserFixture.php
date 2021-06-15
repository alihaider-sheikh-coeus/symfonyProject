<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Tag;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixtures
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users',function($i) use($manager) {
            $user = new User();
            $user->setEmail(sprintf('spacebar%d@example.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->agreeTerms();
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));


            if ($this->faker ->boolean) {
                $user->setTwitterUsername($this->faker->userName);
            }
            $apiToken1 = new ApiToken($user);
//            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            return $user;
//
   });
        $this->createMany(3, 'admin_users', function($i) use($manager) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@thespacebar.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->agreeTerms();
            $user->setRoles(['ROLE_ADMIN']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
            $apiToken1 = new ApiToken($user);
//            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
//            $manager->persist($apiToken2);
            return $user;
        });

        $manager->flush();
    }
}
