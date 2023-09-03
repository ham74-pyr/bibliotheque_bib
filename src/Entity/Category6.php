<?php

namespace App\Entity;

use App\Repository\Category6Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Category6Repository::class)]
class Category6
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
