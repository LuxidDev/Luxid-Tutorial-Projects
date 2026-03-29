<?php

namespace App\Entities;

use Luxid\ORM\UserEntity;
use Rocket\Attributes\Entity as EntityAttr;
use Rocket\Attributes\Column;
use Rocket\Attributes\Rules\Required;
use Rocket\Attributes\Rules\Email;
use Rocket\Attributes\Rules\Min;
use Rocket\Attributes\Rules\Unique;

#[EntityAttr(table: 'users')]
class User extends UserEntity
{
  #[Column(primary: true, autoIncrement: true)]
  public int $id = 0;

  #[Column]
  #[Required]
  #[Email]
  #[Unique]
  public string $email = '';

  #[Column(hidden: true)]
  #[Required]
  #[Min(8)]
  public string $password = '';

  #[Column]
  #[Required]
  public string $firstname = '';

  #[Column]
  #[Required]
  public string $lastname = '';

  #[Column(autoCreate: true)]
  public string $created_at = '';

  #[Column(autoCreate: true, autoUpdate: true)]
  public string $updated_at = '';

  public function getDisplayName(): string
  {
    return trim($this->firstname . ' ' . $this->lastname) ?: $this->email;
  }
}
