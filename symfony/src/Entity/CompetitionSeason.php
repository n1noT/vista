<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CompetitionSeasonRepository;
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
}
