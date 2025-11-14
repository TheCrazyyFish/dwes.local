<?php
namespace dwes\app\entity;
use dwes\app\entity\IEntity;

class Usuario implements IEntity{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $role;

    public function getId(): ?int{
        return $this->id;
    }

     public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): Usuario
    {
        $this->username = $username;
        return $this;
    }

    
     public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): Usuario
    {
        $this->password = $password;
        return $this;
    }

       public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): Usuario
    {
        $this->role = $role;
        return $this;
    }



     public function toSring(): string
    {
        return $this->username;
    }

     public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'role' => $this->getRole()
        ];
    }

     public function __construct(string $username = "", string $password = "", string $role = "")
    {
        $this->id = null;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
}