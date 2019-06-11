<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InstallCommand extends Command
{
    protected static $defaultName = 'cms:setup';
    protected $em;
    protected $passwordEncoder;

    protected function configure()
    {
        $this
            ->setDescription('Sets up base cms.')
        ;
    }

    public function __construct(?string $name = null, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct($name);

        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        exec('composer install');
        exec('php bin/console --no-interaction doctrine:migrations:migrate');
        exec('php bin/console assets:install');
        exec('php bin/console ckeditor:install');

        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test1234'));
        $user->setRoles(['ROLE_ADMIN']);
        $this->em->persist($user);
        $this->em->flush();
    }
}
