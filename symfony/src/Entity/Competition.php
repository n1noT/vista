<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    /**
     * @var Collection<int, CompetitionSeason>
     */
    #[ORM\OneToMany(targetEntity: CompetitionSeason::class, mappedBy: 'competition')]
    private Collection $competitionSeasons;

    public function __construct()
    {
        $this->competitionSeasons = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? 'Unnamed Competition';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, CompetitionSeason>
     */
    public function getCompetitionSeasons(): Collection
    {
        return $this->competitionSeasons;
    }

    public function addCompetitionSeason(CompetitionSeason $competitionSeason): static
    {
        if (!$this->competitionSeasons->contains($competitionSeason)) {
            $this->competitionSeasons->add($competitionSeason);
            $competitionSeason->setCompetition($this);
        }

        return $this;
    }

    public function removeCompetitionSeason(CompetitionSeason $competitionSeason): static
    {
        if ($this->competitionSeasons->removeElement($competitionSeason)) {
            // set the owning side to null (unless already changed)
            if ($competitionSeason->getCompetition() === $this) {
                $competitionSeason->setCompetition(null);
            }
        }

        return $this;
    }
}
