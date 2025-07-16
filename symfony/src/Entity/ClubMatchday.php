<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ClubMatchdayRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubMatchdayRepository::class)]
class ClubMatchday
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'clubMatchdays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompetitionSeason $competitionSeason = null;

    #[ORM\ManyToOne(inversedBy: 'clubMatchdays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Club $club = null;

    #[ORM\Column]
    private ?int $matchday = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $points = null;

    public function __construct()
    {
        $this->points = 0; // Default points to 0
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetitionSeason(): ?CompetitionSeason
    {
        return $this->competitionSeason;
    }

    public function setCompetitionSeason(?CompetitionSeason $competitionSeason): static
    {
        $this->competitionSeason = $competitionSeason;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): static
    {
        $this->club = $club;

        return $this;
    }

    public function getMatchday(): ?int
    {
        return $this->matchday;
    }

    public function setMatchday(int $matchday): static
    {
        $this->matchday = $matchday;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }
}
