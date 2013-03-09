<?php

namespace Blog\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Entity
 */
class User implements UserInterface {
    /** 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     *  @Column(type="string", length=255, unique=true) 
     */
    private $username;
    
    /**
     *  @Column(type="string", length=255) 
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     *  @Column(type="string", length=255) 
     */
    private $email;
    
    /**
     * @OneToMany(targetEntity="Blog\Entity\Post", mappedBy="owner")
     */
    private $posts;
    
    public function __construct() {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Article
     */
    public function setPosts($post){
        $this->posts[] = $post;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getPosts(){
        return $this->posts;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Article
     */
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getUsername(){
        return $this->username;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Article
     */
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getPassword(){
        return $this->password;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Article
     */
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getSalt(){
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getRoles(){
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(){
        
    }

    /**
     * @inheritDoc
     */
    public function equals(UserInterface $user){
        return $this->id === $user->getId();
    }
}