<?php

namespace App\Entity;

use App\Repository\WorkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkRepository::class)]
class Work
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'works')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'work', targetEntity: WorkFiles::class, orphanRemoval: true)]
    private $work_files;

    public function __construct()
    {
        $this->work_files = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, WorkFiles>
     */
    public function getWorkFiles(): Collection
    {
        return $this->work_files;
    }

    public function addWorkFile(WorkFiles $workFile): self
    {
        if (!$this->work_files->contains($workFile)) {
            $this->work_files[] = $workFile;
            $workFile->setWork($this);
        }

        return $this;
    }

    public function removeWorkFile(WorkFiles $workFile): self
    {
        if ($this->work_files->removeElement($workFile)) {
            // set the owning side to null (unless already changed)
            if ($workFile->getWork() === $this) {
                $workFile->setWork(null);
            }
        }

        return $this;
    }
}
