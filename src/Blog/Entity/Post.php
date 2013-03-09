<?php

namespace Blog\Entity;

/**
 * @Entity
 */
class Post {
    
    /** 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /**
     *  @Column(type="text")
     */
    private $title;
    
    /**
     *  @Column(type="text")
     */
    private $annotation;
    
    /**
     *  @Column(type="text")
     */
    private $content;
    
    /**
     *  @Column(type="date")
     */
    private $createdAt;
    
    /**
     * @OneToMany(targetEntity="Blog\Entity\Comment", mappedBy="post")
     */
    private $comments;
    
    /**
     * @ManyToOne(targetEntity="Blog\Entity\User", inversedBy="posts")
     * @JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;
    
    public function __construct() {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function setOwner($owner){
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getOwner(){
        return $this->owner;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Article
     */
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getTitle(){
        return $this->title;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Article
     */
    public function setAnnotation($annotation){
        $this->annotation = $annotation;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getAnnotation(){
        return $this->annotation;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Article
     */
    public function setContent($content){
        $this->content = $content;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getContent(){
        return $this->content;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Article
     */
    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getCreatedAt(){
        return $this->createdAt;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return \Comments
     */
    public function setComments($comment){
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getComments(){
        return $this->comments;
    }
}