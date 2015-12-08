<?php

namespace PalufBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament
 *
 * @ORM\Table(name="tournament")
 * @ORM\Entity(repositoryClass="PalufBundle\Repository\TournamentRepository")
 */
class Tournament
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="date")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="date")
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetime")
     */
    private $deadline;

    /**
     * @var int
     *
     * @ORM\Column(name="cnt_rounds", type="integer")
     */
    private $cntRounds;

    /**
     * @var int
     *
     * @ORM\Column(name="cnt_teams", type="integer")
     */
    private $cntTeams;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Team", indexBy="id")
     */
    private $teams;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Game", mappedBy="tournament")
     */
    private $games;

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
     * Set name
     *
     * @param string $name
     *
     * @return Tournament
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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Tournament
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Tournament
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tournament
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     *
     * @return Tournament
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set cntRounds
     *
     * @param integer $cntRounds
     *
     * @return Tournament
     */
    public function setCntRounds($cntRounds)
    {
        $this->cntRounds = $cntRounds;

        return $this;
    }

    /**
     * Get cntRounds
     *
     * @return int
     */
    public function getCntRounds()
    {
        return $this->cntRounds;
    }

    /**
     * Set cntTeams
     *
     * @param integer $cntTeams
     *
     * @return Tournament
     */
    public function setCntTeams($cntTeams)
    {
        $this->cntTeams = $cntTeams;

        return $this;
    }

    /**
     * Get cntTeams
     *
     * @return int
     */
    public function getCntTeams()
    {
        return $this->cntTeams;
    }


    /**
     * @return ArrayCollection
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @return ArrayCollection
     */
    public function getGames()
    {
        return $this->games;
    }


}

