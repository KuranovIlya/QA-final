<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=63)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $qtext;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $qdate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quser;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="aquestion", cascade={"all"}, orphanRemoval=true)
     */
    private $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getQtext(): ?string
    {
        return $this->qtext;
    }

    public function setQtext(string $qtext): self
    {
        $this->qtext = $qtext;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getQdate(): ?\DateTimeInterface
    {
        return $this->qdate;
    }

    public function setQdate(\DateTimeInterface $qdate): self
    {
        $this->qdate = $qdate;

        return $this;
    }

    public function getQuser(): ?User
    {
        return $this->quser;
    }

    public function setQuser(?User $quser): self
    {
        $this->quser = $quser;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setAquestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getAquestion() === $this) {
                $answer->setAquestion(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->title);
    }
}
