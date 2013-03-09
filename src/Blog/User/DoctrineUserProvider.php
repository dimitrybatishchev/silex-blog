<?php

namespace Blog\User;
 
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Blog\Entity\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
 
class DoctrineUserProvider implements UserProviderInterface{
    private $em;
 
    public function __construct($em){
        $this->em = $em;
    }
 
    public function loadUserByUsername($username){
        $q = $this 
            -> em
            ->createQueryBuilder()
            ->add('select', 'u')
            ->add('from', 'Blog\Entity\User u')
            ->add('where', 'u.username = :username')
            ->setParameter('username', $username)
            ->getQuery();
        ;
        try {
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf(
                'Unable to find an active admin AcmeUserBundle:User object identified by "%s".',
                $username
            );
            throw new UsernameNotFoundException($message, null, 0, $e);
        }

        return $user;
    }
 
    public function refreshUser(UserInterface $user){
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
 
        return $this->loadUserByUsername($user->getUsername());
    }
 
    public function supportsClass($class){
        return $class === 'Blog\Entity\User';
    }
    
}