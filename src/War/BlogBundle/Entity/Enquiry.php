<?php
namespace War\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

/**
 * Enquiry
 * 
 * @ORM\Entity
 */
class Enquiry
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
 
    /**
    * @ORM\Column(type="string", length=100)
    */
    protected $name;

    /**
    * @ORM\Column(name="email", type="string", length=256)
    * Assert\NotBlank() * Assert\Email()
    */
    protected $email;

    /**
    * @ORM\Column(type="text",length=255)
    */
    protected $subject;

    /**
    * @ORM\Column(type="text")
    */
    protected $body;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Enquiry
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Enquiry
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Enquiry
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Enquiry
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
    $metadata->addPropertyConstraint('name', new NotBlank());
    //$metadata->addPropertyConstraint('email', new Email());
    $metadata->addPropertyConstraint('email', new Email(array(
    'message' => 'Не пишіть тут дурниці. Give me a real one!')));
    $metadata->addPropertyConstraint('subject', new Length(array(
    'max' => 50 )));
    $metadata->addPropertyConstraint('body', new Length(array(
    'min' => 20)));
    }
}
