<?php
/**
 * Created by PhpStorm.
 * User: klown
 * Date: 12/9/17
 * Time: 2:49 PM
 */

class Customer {
    private $username;
    private $address;
    private $email;
    private $isAdmin;

    public function __construct() {
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getisAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }



    public function __toString()
    {
        // TODO: Implement __toString() method.
        return 'username: ' . $this->getUsername() . '<br>email: ' . $this->getEmail() . '<br>address: ' . $this->getAddress() . '<br>';
    }


}