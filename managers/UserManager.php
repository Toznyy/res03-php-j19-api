<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array {
        
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getUserById(int $id) : User {
        
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $parameters = ['id' => $id];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $newUser = new User($user["id"], $user["username"], $user["firstName"], $user["lastName"], $user["email"]);
        return $newUser;
    }

    public function createUser(User $user) : User {
        
        $query = $this->db->prepare("INSERT INTO users VALUES (null, :username, :firstName, :lastName, :email");
        $parameters = [
            'username' => $user->getUsername(),
            'firstName' => $user->getfirstName(),
            'lastName' => $user->getlastName(),
            'email' => $user->getEmail(),
            ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $newUser = new User($user["id"], $user["username"], $user["firstName"], $user["lastName"], $user["email"]);
        return $newUser;
    }

    public function updateUser(User $user) : User {
        
        $query = $this->db->prepare("UPDATE users SET username = :username, firstName = :firstName, lastName = :lastName, email = :email");
        $parameters = [
            'username' => $user->getUsername(),
            'firstName' => $user->getfirstName(),
            'lastName' => $user->getlastName(),
            'email' => $user->getEmail(),
            ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $newUser = new User($user["id"], $user["username"], $user["firstName"], $user["lastName"], $user["email"]);
        return $newUser;
    }

    public function deleteUser(User $user) : array {
        
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $parameters = ['id' => $id];
        $query->execute($parameters);
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}