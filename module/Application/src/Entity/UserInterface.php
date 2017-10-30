<?php 
namespace Application\Entity;

interface UserInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getFirstname();

    /**
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname($firstname);

    /**
     * @return string
     */
    public function getLastname();

    /**
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname($lastname);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password);
}
