<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreateCommand extends Command
{
    protected static $defaultName = 'app:user:create';
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        EntityManagerInterface $entityManager,
        ?string $name = null
    )
    {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName(self::$defaultName)
            ->addArgument('username',InputArgument::OPTIONAL,'','Jackson');
    }
    protected function execute(InputInterface $input, OutputInterface $output) :int
    {
        $username = $input->getArgument('username');

        $helper = $this->getHelper('question');
        $question = new Question(sprintf('Hey %s, what is your favourite password in the entire world ?' . PHP_EOL, $username));
        $question->setHidden(true);

        $password = $helper->ask($input, $output, $question);

        $user = User::create();
        $user
            ->setUsername($username)
            ->setPassword($this->userPasswordEncoder->encodePassword($user, $password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return 0;
    }
}