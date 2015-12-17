<?php
/**
 * Created by PhpStorm.
 * User: darksy
 * Date: 13/12/2015
 * Time: 19:38
 */

namespace MovieUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * Class User
 * @package MovieUser\Entity
 * @ORM\Entity;
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"encoding":"UTF-8", "min":6, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[ña-zÑA-Z][ña-zÑA-Z0-9\_\-]+$/"}})
     * @Annotation\Options({"label":"Username"})
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"encoding":"UTF-8", "min":6, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[ña-zÑA-Z][ña-zÑA-Z0-9\_\-]+$/"}})
     * @Annotation\Options({"label":"Firstname"})
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"encoding":"UTF-8", "min":6, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[ña-zÑA-Z][ña-zÑA-Z0-9\_\-]+$/"}})
     * @Annotation\Options({"label":"Lastname"})
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"encoding":"UTF-8", "min":6, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[ña-zÑA-Z][ña-zÑA-Z0-9\_\-]+$/"}})
     * @Annotation\Options({"label":"Email"})
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $registeredOn;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $registrationToken;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rating;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"encoding":"UTF-8", "min":6, "max":20}})
     * @Annotation\Required(true)
     * @Annotation\Attributes({
     *   "type":"password",
     *   "required":"true"
     * })
     */
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function getRegisteredOn()
    {
        return $this->registeredOn;
    }

    public function setRegisteredOn($registeredOn)
    {
        $this->registeredOn = $registeredOn;
    }

    public function getRegistrationToken()
    {
        return $this->registrationToken;
    }

    public function setRegistrationToken($registrationToken)
    {
        $this->registrationToken = $registrationToken;
    }
}