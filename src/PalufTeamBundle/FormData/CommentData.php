<?php

namespace PalufTeamBundle\FormData;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 08.12.2015
 * Time: 23:53
 */
class CommentData
{

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $text;

}