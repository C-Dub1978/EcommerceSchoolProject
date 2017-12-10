<?php
/**
 * Created by PhpStorm.
 * User: klown
 * Date: 12/8/17
 * Time: 10:37 PM
 */

class DBParams {
    private $username;
    private $password;
    private $host;
    private $db;

    public function __construct($myusername, $mypassword, $myhost, $mydb) {
        $this->username = $myusername;
        $this->password = $mypassword;
        $this->host = $myhost;
        $this->db = $mydb;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param string $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }


}

?>