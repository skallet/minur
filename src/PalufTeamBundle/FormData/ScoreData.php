<?php
/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 09.12.2015
 * Time: 1:00
 */

namespace PalufTeamBundle\FormData;

use Symfony\Component\Validator\Constraints as Assert;


class ScoreData
{

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $resultA;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $resultB;

}