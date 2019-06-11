<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @UniqueEntity(fields={"code", "slug"}, message="There is already a page with this code or slug")
 */
class Page
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_keywords;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }    

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->meta_title;
    }

    public function setMetaTitle(string $meta_title): self
    {
        $this->meta_title = $meta_title;

        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->meta_keywords;
    }

    public function setMetaKeywords(string $meta_keywords): self
    {
        $this->meta_keywords = $meta_keywords;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(string $meta_description): self
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function edit($values)
    {
    	if (isset($values['code'])) {
    		$this->setCode($values['code']);
    	}
    	if (isset($values['slug'])) {
    		$this->setSlug($values['slug']);
    	}    	
    	if (isset($values['title'])) {
    		$this->setTitle($values['title']);
    	}
    	if (isset($values['content'])) {
    		$this->setContent($values['content']);
    	}
    	if (isset($values['meta_title'])) {
    		$this->setMetaTitle($values['meta_title']);
    	}
    	if (isset($values['meta_keywords'])) {
    		$this->setMetaKeywords($values['meta_keywords']);
    	}
    	if (isset($values['meta_description'])) {
    		$this->setMetaDescription($values['meta_description']);
    	}   	    	    	    	    	    	    	
    }
}