<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\Category5Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Category5Repository::class)]
#[ApiResource]
class Category5
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
