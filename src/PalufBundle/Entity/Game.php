<?php

namespace PalufBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="PalufBundle\Repository\GameRepository")
 */
class Game
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $teamA;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $teamB;

    /**
     * @var Tournament
     *
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="games")
     */
    private $tournament;

    /**
     * @var string
     *
     * @ORM\Column(name="a_result_1", type="integer", nullable=true)
     */
    private $aResult1;

    /**
     * @var int
     *
     * @ORM\Column(name="a_result_2", type="integer", nullable=true)
     */
    private $aResult2;

    /**
     * @var int
     *
     * @ORM\Column(name="b_result_1", type="integer", nullable=true)
     */
    private $bResult1;

    /**
     * @var int
     *
     * @ORM\Column(name="b_result_2", type="integer", nullable=true)
     */
    private $bResult2;

    /**
     * @var bool
     *
     * @ORM\Column(name="done", type="boolean")
     */
    private $done;

    /**
     * @var Term
     *
     * @ORM\OneToOne(targetEntity="Term")
     * @ORM\JoinColumn(name="final_term_id", referencedColumnName="id", nullable=true)
     */
    private $finalTerm;

    /**
     * @var int
     *
     * @ORM\Column(name="round", type="integer")
     */
    private $round;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="game")
     */
    private $comments;

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Team
     */
    public function getTeamA()
    {
        return $this->teamA;
    }

    /**
     * @param Team $teamA
     */
    public function setTeamA(Team $teamA)
    {
        $this->teamA = $teamA;
    }

    /**
     * @return Team
     */
    public function getTeamB()
    {
        return $this->teamB;
    }

    /**
     * @param Team $teamB
     */
    public function setTeamB(Team $teamB)
    {
        $this->teamB = $teamB;
    }

    /**
     * @return Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * @param Tournament $tournament
     */
    public function setTournament(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }


    /**
     * Set aResult1
     *
     * @param string $aResult1
     *
     * @return Game
     */
    public function setAResult1($aResult1)
    {
        $this->aResult1 = $aResult1;

        return $this;
    }

    /**
     * Get aResult1
     *
     * @return string
     */
    public function getAResult1()
    {
        return $this->aResult1;
    }

    /**
     * Set aResult2
     *
     * @param integer $aResult2
     *
     * @return Game
     */
    public function setAResult2($aResult2)
    {
        $this->aResult2 = $aResult2;

        return $this;
    }

    /**
     * Get aResult2
     *
     * @return int
     */
    public function getAResult2()
    {
        return $this->aResult2;
    }

    /**
     * Set bResult1
     *
     * @param integer $bResult1
     *
     * @return Game
     */
    public function setBResult1($bResult1)
    {
        $this->bResult1 = $bResult1;

        return $this;
    }

    /**
     * Get bResult1
     *
     * @return int
     */
    public function getBResult1()
    {
        return $this->bResult1;
    }

    /**
     * Set bResult2
     *
     * @param integer $bResult2
     *
     * @return Game
     */
    public function setBResult2($bResult2)
    {
        $this->bResult2 = $bResult2;

        return $this;
    }

    /**
     * Get bResult2
     *
     * @return int
     */
    public function getBResult2()
    {
        return $this->bResult2;
    }

    /**
     * Set done
     *
     * @param boolean $done
     *
     * @return Game
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return bool
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * @return Term
     */
    public function getFinalTerm()
    {
        return $this->finalTerm;
    }

    /**
     * @param Term $finalTerm
     */
    public function setFinalTerm(Term $finalTerm=NULL)
    {
        $this->finalTerm = $finalTerm;
    }

    /**
     * @return int
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * @param int $round
     */
    public function setRound($round)
    {
        $this->round = $round;
    }

}

