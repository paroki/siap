<?php


namespace Paroki\User\Command;


use Paroki\User\Entity\User;
use Paroki\User\UserManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommand extends Command
{
    /**
     * @var UserManager
     */
    private UserManager $userManager;

    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        UserManager $userManager,
        UserPasswordHasherInterface $hasher
    )
    {
        $this->userManager = $userManager;
        $this->hasher = $hasher;
        parent::__construct('user:create');
    }

    protected function configure()
    {
        $this->addArgument('email', InputArgument::REQUIRED, 'Email user');
        $this->addArgument('password', InputArgument::REQUIRED, 'Password user');
        $this->addOption('super-admin', 's', InputOption::VALUE_NONE, 'Set user sebagai super admin.');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userManager = $this->userManager;
        $hasher = $this->hasher;
        $email = $input->getArgument('email');
        $plainPassword = $input->getArgument('password');
        $user = new User();
        $password = $hasher->hashPassword($user, $plainPassword);
        $superAdmin = $input->getOption('super-admin');

        if(!is_null($user = $userManager->findByEmail($email))){
            $output->writeln('<error>Email '.$email.' sudah terdaftar.');
            return static::FAILURE;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        if($superAdmin){
            $user->setRoles([User::ROLE_SUPER_ADMIN]);
        }
        $userManager->save($user);

        return static::SUCCESS;
    }


}