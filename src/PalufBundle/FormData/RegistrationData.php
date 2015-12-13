<?php

namespace PalufBundle\FormData;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 08.12.2015
 * Time: 20:17
 */
class RegistrationData
{

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="4", minMessage="Heslo je příliš krátké, minimum jsou 4 znaky.")
     */
    public $password;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $passwordCheck;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var string
     *
     */
    public $description;

    /**
     * @Assert\IsTrue(message="Zadaná hesla nejsou stejná")
     * @return bool
     */
    public function isPasswordLegal()
    {
        return $this->passwordCheck == $this->password;
    }

}