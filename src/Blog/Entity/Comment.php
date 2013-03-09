<?php

namespace Blog\Entity;

/**
 * @Entity
 */
class Comment {
    
    /** 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /**
     *  @Column(type="text")
     */
    private $content;
    
    /**
     *  @Column(type="date")
     */
    private $createdAt;
    
    /**
     * @ManyToOne(targetEntity="Blog\Entity\Post", inversedBy="posts")
     * @JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId(){
        return $this->id;
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
     * @return \Article
     */
    public function setPost($post){
        $this->post = $post;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getPost(){
        return $this->post;
    }
}