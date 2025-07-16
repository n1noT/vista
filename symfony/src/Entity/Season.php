<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $start = null;

    #[ORM\Column]
    private ?int $end = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $startDate = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $endDate = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, CompetitionSeason>
     */
    #[ORM\OneToMany(targetEntity: CompetitionSeason::class, mappedBy: 'season')]
    private Collection $competitionSeasons;

    public function __construct()
    {
        $this->competitionSeasons = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->label ?? 'Unnamed Season';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?int
    {
        return $this->start;
    }

    public function setStart(int $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?int
    {
        return $this->end;
    }

    public function setEnd(int $end): static
    {
        $this->end = $end;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

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
            $competitionSeason->setSeason($this);
        }

        return $this;
    }

    public function removeCompetitionSeason(CompetitionSeason $competitionSeason): static
    {
        if ($this->competitionSeasons->removeElement($competitionSeason)) {
            // set the owning side to null (unless already changed)
            if ($competitionSeason->getSeason() === $this) {
                $competitionSeason->setSeason(null);
            }
        }

        return $this;
    }
}
