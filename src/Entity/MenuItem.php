<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class MenuItem
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $linkType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $linkTypeId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $target;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="items")
     */
    private $menu;

    /**
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="parent")
     */
    private $submenuItems;

    /**
     * @ORM\ManyToOne(targetEntity="MenuItem", inversedBy="submenuItems")
     */
    private $parent;

    public function __construct() {
        $this->submenuItems = new ArrayCollection();
    }

    private $active = false;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLinkType()
    {
        return $this->linkType;
    }

    public function setLinkType($linkType): self
    {
        $this->linkType = $linkType;

        return $this;
    }

    public function getLinkTypeId()
    {
        return $this->linkTypeId;
    }

    public function setLinkTypeId($linkTypeId): self
    {
        $this->linkTypeId = $linkTypeId;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function setMenu($menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setTarget($target): self
    {
        $this->target = $target;
        return $this;
    }

    public function getSubmenuItems()
    {
        return $this->submenuItems;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function isActive(): bool
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
        if (isset($values['name'])) {
            $this->setName($values['name']);
        }
        if (isset($values['linkType'])) {
            $this->setLinkType($values['linkType']);
        }
        if (isset($values['linkTypeId'])) {
            $this->setLinkTypeId($values['linkTypeId']);
        }
        if (isset($values['url'])) {
            $this->setUrl($values['url']);
        }
        if (isset($values['position'])) {
            $this->setPosition($values['position']);
        }
        if (isset($values['target'])) {
            $this->setTarget($values['target']);
        }
    }
}
