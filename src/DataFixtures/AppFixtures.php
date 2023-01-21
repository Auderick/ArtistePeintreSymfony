<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Blogpost;
use App\Entity\Peinture;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        // Utilisation de Faker
        $faker = Factory::create('fr_FR');

        // Création d'un utilisateur
        $user = new User();

        $user->setEmail('user@test.com')
             ->setPrenom($faker->firstName())
             ->setNom($faker->lastname())
             ->setTelephone($faker->phoneNumber())
             ->setAPropos($faker->text())
             ->setFacebook('facebook')
             ->setRoles(['ROLE_PEINTRE']);

        $password = $this->encoder->hashPassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        // Création de 10 Blogpost
        for ($i=0; $i < 10; $i++) {
            $blogpost = new Blogpost();

            $blogpost->setTitre($faker->words(3, true))
                     ->setCreatedAt($faker->datetimeBetween('-6 month', 'now'))
                     ->setContenu($faker->text(350))
                     ->setSlug($faker->slug(3))
                     ->setUser($user);

            $manager->persist($blogpost);
        }

        // Création de 5 catégories
        for ($k=0; $k < 5; $k++) {
            $categorie = new Categorie();

            $categorie->setNom($faker->word())
                      ->setDescription($faker->words(10, true))
                      ->setSlug($faker->slug());

            $manager->persist($categorie);

            // Création de 2 peintures/catégories
            for ($j=0; $j < 2; $j++) {
                $peinture = new Peinture();

                $peinture->setNom($faker->words(3, true))
                         ->setLargeur($faker->randomFloat(2, 20, 60))
                         ->setHauteur($faker->randomFloat(2, 20, 60))
                         ->setEnVente($faker->randomElement([true, false]))
                         ->setDateRealisation($faker->datetimeBetween('-6 month', 'now'))
                         ->setCreatedAt($faker->datetimeBetween('-6 month', 'now'))
                         ->setDescription($faker->text())
                         ->setPortfolio($faker->randomElement([true, false]))
                         ->setSlug($faker->slug)
                         ->setFile('placeholder.jpg')
                         ->addCategorie($categorie)
                         ->setPrix($faker->randomFloat(2, 10, 9999))
                         ->setUser($user);

                $manager->persist($peinture);
            }
        }

        $manager->flush();
    }
}