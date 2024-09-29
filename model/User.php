<?php

namespace model;

use DateTime;

class User
{
    private string $email;       // Adresse email de l'utilisateur
    private string $password;    // Mot de passe de l'utilisateur
    private string $firstName;   // Prénom de l'utilisateur
    private string $lastName;    // Nom de famille de l'utilisateur
    private string $birthdate;   // Date de naissance de l'utilisateur
    private string $gender;      // Genre de l'utilisateur
    private float $height;       // Taille de l'utilisateur en mètres
    private float $weight;       // Poids de l'utilisateur en kilogrammes

    /**
     * Constructeur par défaut pour l'utilisateur.
     */
    public function  __construct() { }

    /**
     * Initialise l'utilisateur avec les valeurs données.
     * @param string $em Email de l'utilisateur.
     * @param string $pa Mot de passe de l'utilisateur.
     * @param string $fn Prénom de l'utilisateur.
     * @param string $ln Nom de famille de l'utilisateur.
     * @param string $bi Date de naissance de l'utilisateur.
     * @param string $ge Genre de l'utilisateur.
     * @param float $he Taille de l'utilisateur.
     * @param float $we Poids de l'utilisateur.
     * @return void
     */
    public function init($em, $pa, $fn, $ln, $bi, $ge, $he, $we): void
    {
        $this->email = $em;
        $this->password = $pa;
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->birthdate = $bi;
        $this->gender = $ge;
        $this->height = $he;
        $this->weight = $we;
    }

    /**
     * Retourne l'email de l'utilisateur.
     * @return string
     */
    public function getEmail(): string { return $this->email; }

    /**
     * Retourne le mot de passe de l'utilisateur.
     * @return string
     */
    public function getPassword(): string { return $this->password; }

    /**
     * Retourne le prénom de l'utilisateur.
     * @return string
     */
    public function getFirstName(): string { return $this->firstName; }

    /**
     * Retourne le nom de famille de l'utilisateur.
     * @return string
     */
    public function getLastName(): string { return $this->lastName; }

    /**
     * Retourne la date de naissance de l'utilisateur.
     * @return string
     */
    public function getBirthdate(): string { return $this->birthdate; }

    /**
     * Retourne le genre de l'utilisateur.
     * @return string
     */
    public function getGender(): string { return $this->gender; }

    /**
     * Retourne la taille de l'utilisateur.
     * @return float
     */
    public function getHeight(): float { return $this->height; }

    /**
     * Retourne le poids de l'utilisateur.
     * @return float
     */
    public function getWeight(): float { return $this->weight; }

    /**
     * Retourne une représentation sous forme de chaîne de l'utilisateur.
     * @return string
     */
    public function __toString(): string
    {
        return $this->email . " ". $this->firstName. " ". $this->lastName. " ". $this->birthdate. " ". $this->birthdate. " ". $this->gender. " ". $this->height. " ". $this->weight;
    }
}