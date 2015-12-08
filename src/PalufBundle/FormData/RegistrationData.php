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
     * @Assert\Length(min="4", minMessage="password.error.short")
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
     * @Assert\NotBlank()
     */
    public $description;

    /**
     * @Assert\IsTrue(message="password.error.different")
     * @return bool
     */
    public function isPasswordLegal()
    {
        return $this->passwordCheck == $this->password;
    }

}