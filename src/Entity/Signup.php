<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Signup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reference = false;

    /**
     * @ORM\Column(type="text")
     */
    private $complaints;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $date_sent;

    public function __construct()
    {
        $this->date_sent = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
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

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    public function setPostalCode($postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getComplaints()
    {
        return $this->complaints;
    }

    public function setComplaints($complaints): self
    {
        $this->complaints = $complaints;

        return $this;
    }

    public function getDateSent(): \DateTime
    {
        return $this->date_sent;
    }

    public function setDateSent(\DateTime $date_sent): self
    {
        $this->date_sent = $date_sent;

        return $this;
    }
}
