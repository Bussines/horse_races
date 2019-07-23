<?php

namespace App\Service;

use App\Entity\User;
use \App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserService
{

    /**
     * @var UserRepository
     */
    private $userDao;

    /**
     * UserService constructor.
     * @param UserRepository $UserRepository
     */
    public function __construct(UserRepository $UserRepository)
    {
        $this->userDao=$UserRepository;
    }

    public function getUserByName(string $name): ?User
    {
        return $this->userDao->findOneBy(array('name'=>$name));
    }

    public function findAllUsers(): ?array
    {
        return $this->userDao->findAll();
    }

    public function getAdmin()
    {
        return $this->userDao->getAdmin();
    }

    public function addUser(string $email, string $password,UserPasswordEncoderInterface $passwordEncoder): ?array
    {
        return $this->userDao->addUser($email,$password,$passwordEncoder);
    }

    public function deleteUserById($id): ?array
    {
        return $this->userDao->deleteUserById($id);
    }

}