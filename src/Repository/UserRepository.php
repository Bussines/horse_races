<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $email
     * @param string $password
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return User|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(string $email, string $password,UserPasswordEncoderInterface $passwordEncoder): ? array
    {
        $user = new User();
        $user->setEmail($email);
        $users = $this->findAll();
        if(sizeof($users)>0)
        {
            $user->setRoles(array('ROLE_USER'));
        }else{
            $user->setRoles(array('ROLE_ADMIN','ROLE_USER'));
        }
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $password
            )
        );
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        return array('user'=>$user,'error'=>false, 'message'=>'User registered successfully');
    }

    /**
     * @param $id
     * @return bool|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteUserById($id): ?array
    {

        $user =$this->find($id);
        if (!isset($user)) {
            return array('result'=>false,'error'=>true, 'message'=>'User cannot be deleted');
        }
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
        return array('result'=>true,'error'=>false, 'message'=>'User deleted successfully');
    }

    public function getAdmin()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT u.id as userId 
            FROM user as u where roles REGEXP 'ROLE_ADMIN'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}
