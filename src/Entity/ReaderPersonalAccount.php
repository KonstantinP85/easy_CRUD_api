<?php

namespace App\Entity;

use App\Repository\ReaderPersonalAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReaderPersonalAccountRepository::class)
 */
class ReaderPersonalAccount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Reader::class, cascade={"persist", "remove"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="readerPersonalAccount")
     */
    private $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?Reader
    {
        return $this->name;
    }

    public function setName(?Reader $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
            $category->setReaderPersonalAccount($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getReaderPersonalAccount() === $this) {
                $category->setReaderPersonalAccount(null);
            }
        }

        return $this;
    }
}
