<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $adate;

    /**
     * @ORM\Column(type="string", length=511)
     */
    private $atext;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aquestion;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdate(): ?\DateTimeInterface
    {
        return $this->adate;
    }

    public function setAdate(\DateTimeInterface $adate): self
    {
        $this->adate = $adate;

        return $this;
    }

    public function getAtext(): ?string
    {
        return $this->atext;
    }

    public function setAtext(string $atext): self
    {
        $this->atext = $atext;

        return $this;
    }

    public function getAquestion(): ?Question
    {
        return $this->aquestion;
    }

    public function setAquestion(?Question $aquestion): self
    {
        $this->aquestion = $aquestion;

        return $this;
    }

    public function getAuser(): ?User
    {
        return $this->auser;
    }

    public function setAuser(?User $auser): self
    {
        $this->auser = $auser;

        return $this;
    }

    public function __toString()
    {
        return strval($this->auser->getFullname());
    }
}
