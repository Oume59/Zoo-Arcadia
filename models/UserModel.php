<?php

namespace App\Models;

class UserModel extends Model
{
    private $id_users;
    private $username;
    private $password;
    private $email;
    private $id_role;

    public function login()
    {
        return $this->req("INSERT INTO Utilisateurs (username, email, password, id_role) VALUES (:username, :email, :password, :id_role)");
    }

    /**
     * Get the value of id_users
     */
    public function getIdUsers()
    {
        return $this->id_users;
    }

    /**
     * Set the value of id_users
     */
    public function setIdUsers($id_users): self
    {
        $this->id_users = $id_users;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername($username): self
    {
        $this->username = $username;

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
     * Get the value of id_role
     */
    public function getIdRole()
    {
        return $this->id_role;
    }

    /**
     * Set the value of id_role
     */
    public function setIdRole($id_role): self
    {
        $this->id_role = $id_role;

        return $this;
    }
}
