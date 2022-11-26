<?php

namespace App\Entity;

use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MuscleRepository::class)]
class Muscle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: RecordedExercise::class, mappedBy: 'muscles')]
    private Collection $recordedExercises;

    public function __construct()
    {
        $this->recordedExercises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, RecordedExercise>
     */
    public function getRecordedExercises(): Collection
    {
        return $this->recordedExercises;
    }

    public function addRecordedExercise(RecordedExercise $recordedExercise): self
    {
        if (!$this->recordedExercises->contains($recordedExercise)) {
            $this->recordedExercises->add($recordedExercise);
            $recordedExercise->addMuscle($this);
        }

        return $this;
    }

    public function removeRecordedExercise(RecordedExercise $recordedExercise): self
    {
        if ($this->recordedExercises->removeElement($recordedExercise)) {
            $recordedExercise->removeMuscle($this);
        }

        return $this;
    }
}
