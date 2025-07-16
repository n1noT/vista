<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
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
     * @var Collection<int, ClubMatchday>
     */
    #[ORM\OneToMany(targetEntity: ClubMatchday::class, mappedBy: 'club')]
    private Collection $clubMatchdays;

    public function __construct()
    {
        $this->clubMatchdays = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? 'Unknown Club';
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
            $clubMatchday->setClub($this);
        }

        return $this;
    }

    public function removeClubMatchday(ClubMatchday $clubMatchday): static
    {
        if ($this->clubMatchdays->removeElement($clubMatchday)) {
            // set the owning side to null (unless already changed)
            if ($clubMatchday->getClub() === $this) {
                $clubMatchday->setClub(null);
            }
        }

        return $this;
    }
}
