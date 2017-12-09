<?php
/**
 * Created by PhpStorm.
 * User: klown
 * Date: 12/8/17
 * Time: 8:31 PM
 */

class Product {
    private $name = "";
    private $price = "";
    private $description = "";
    private $picURL = "";

    //Constructor
    public function __construct($productname, $productprice, $productdescription, $pic) {
        $this->name = $productname;
        $this->price = $productprice;
        $this->description = $productdescription;
        $this->picURL = $pic;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPicURL()
    {
        return $this->picURL;
    }

    /**
     * @param string $picURL
     */
    public function setPicURL($picURL)
    {
        $this->picURL = $picURL;
    }



}

?>