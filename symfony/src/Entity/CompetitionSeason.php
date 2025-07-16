<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CompetitionSeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueConstraint(name: 'unique_competition_season', columns: ['competition_id', 'season_id'])]
#[UniqueEntity(fields: ['competition', 'season'], message: 'This competition already exists for the selected season.')]
#[ORM\Entity(repositoryClass: CompetitionSeasonRepository::class)]
class CompetitionSeason
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'competitionSeasons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    #[ORM\ManyToOne(inversedBy: 'competitionSeasons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Season $season = null;

    #[ORM\Column]
    private ?int $total_matchdays = null;

    /**
     * @var Collection<int, ClubMatchday>
     */
    #[ORM\OneToMany(targetEntity: ClubMatchday::class, mappedBy: 'competitionSeason')]
    private Collection $clubMatchdays;

    public function __construct()
    {
        $this->total_matchdays = 20; // Most of the competitions have 20 matchdays so it's set by default
        $this->clubMatchdays = new ArrayCollection();
    }

    public function __toString(): string
    {
        return \sprintf('%s - %s', $this->competition?->getName() ?? 'Unknown Competition', $this->season?->getLabel() ?? 'Unknown Season');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): static
    {
        $this->competition = $competition;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): static
    {
        $this->season = $season;

        return $this;
    }

    public function getTotalMatchdays(): ?int
    {
        return $this->total_matchdays;
    }

    public function setTotalMatchdays(int $total_matchdays): static
    {
        $this->total_matchdays = $total_matchdays;

        return $this;
    }

    /**
     * @return Collection<int, ClubMatchday>
     */
    public function getClubMatchdays(): Collection
    {
        return $this->clubMatchdays;
    }

    public function addClubMatchday(ClubMatchday $clubMatchday): static
    {
        if (!$this->clubMatchdays->contains($clubMatchday)) {
            $this->clubMatchdays->add($clubMatchday);
            $clubMatchday->setCompetitionSeason($this);
        }

        return $this;
    }

    public function removeClubMatchday(ClubMatchday $clubMatchday): static
    {
        if ($this->clubMatchdays->removeElement($clubMatchday)) {
            // set the owning side to null (unless already changed)
            if ($clubMatchday->getCompetitionSeason() === $this) {
                $clubMatchday->setCompetitionSeason(null);
            }
        }

        return $this;
    }
}
