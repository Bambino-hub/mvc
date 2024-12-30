<?php

namespace App\model;

defined("ROOTPATH") or exit("access Denied");


class UsersModel extends Model
{
    private $email;
    private $password;
    protected $table = "users";

    protected $allowedColumns = [

        'email',
        'password',
    ];

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }
}
