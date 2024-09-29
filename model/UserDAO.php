<?php

namespace model;

use PDO;

require_once('SqliteConnection.php');
require_once('User.php');

class UserDAO
{
    private static UserDAO $dao;

    /**
     * Private constructor for singleton pattern.
     */
    private function __construct()
    {
    }

    /**
     * Returns the singleton instance of the UserDAO.
     * @return UserDAO The instance of the UserDAO.
     */
    public static function getInstance(): UserDAO
    {
        if (!isset(self::$dao)) {
            self::$dao = new UserDAO();
        }
        return self::$dao;
    }

    /**
     * Finds and returns all users from the database.
     * @return array Array of User objects.
     */
    public final function findAll(): array
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Users";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, '\model\User');
        return $results;
    }

    /**
     * Finds and returns a user from the database based on email and password.
     * @param string $email The user's email.
     * @param string $password The user's password.
     * @return User|null The user if found, null otherwise.
     */
    public final function find(string $email, string $password): ?User
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Users where email = :em";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':em', $email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\model\User');
        $result = $stmt->fetch(PDO::FETCH_CLASS);
        if ($result != false && password_verify($password, $result->getPassword())) {
            return $result;
        } else {
            return null;
        }
    }

    /**
     * Inserts a new user into the database.
     * @param User $user The user to insert.
     * @return void
     */
    public final function insert(User $user): void
    {
        if ($user instanceof User) {
            $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);

            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "insert into Users(email, password, firstName, lastName, birthdate, gender, height, weight) values (:em,:pa,:fn,:ln,:bi,:ge,:he,:we)";
            $stmt = $dbc->prepare($query);

            $stmt->bindValue(':em', $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':pa', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':fn', $user->getFirstName(), PDO::PARAM_STR);
            $stmt->bindValue(':ln', $user->getLastName(), PDO::PARAM_STR);
            $stmt->bindValue(':bi', $user->getBirthdate(), PDO::PARAM_STR);
            $stmt->bindValue(':ge', $user->getGender(), PDO::PARAM_STR);
            $stmt->bindValue(':he', $user->getHeight(), PDO::PARAM_STR);
            $stmt->bindValue(':we', $user->getWeight(), PDO::PARAM_STR);

            $stmt->execute();
        }
    }

    /**
     * Deletes a user from the database.
     * @param User $user The user to delete.
     * @return void
     */
    public function delete(User $user): void
    {
        if($user instanceof User) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "delete from Users where email = :em";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':em', $user->getEmail(), PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    /**
     * Updates a user's details in the database.
     * @param User $user The user to update.
     * @return void
     */
    public function update(User $user): void
    {
        if($user instanceof User) {
            $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);

            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "update Users set password = :pa, firstName = :fn, lastName = :ln, birthdate = :bi, gender = :ge, height = :he, weight = :we where email = :em";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':pa', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':fn', $user->getFirstName(), PDO::PARAM_STR);
            $stmt->bindValue(':ln', $user->getLastName(), PDO::PARAM_STR);
            $stmt->bindValue(':bi', $user->getBirthdate(), PDO::PARAM_STR);
            $stmt->bindValue(':ge', $user->getGender(), PDO::PARAM_STR);
            $stmt->bindValue(':he', $user->getHeight(), PDO::PARAM_INT);
            $stmt->bindValue(':we', $user->getWeight(), PDO::PARAM_INT);
            $stmt->bindValue(':em', $user->getEmail(), PDO::PARAM_STR);
            $stmt->execute();
        }
    }
}

