<?php

class Product {

    var $product_id;
    var $product_name;
    var $qty;
    var $unit_price;
	
    function get_product_cost() {
        return $this->qty * $this->unit_price;
    }
	
    function __construct($productID, $productName, $productPrice, $qty) {
        $this->product_id = $productID;
        $this->product_name = $productName;
        $this->qty = $qty;
        $this->unit_price = $productPrice;
    }

    function get_product_id() {
        return $this->product_id;
    }

    function get_product_name() {
        return $this->product_name;
    }

    function get_qty() {
        return $this->qty;
    }

    function get_unit_price() {
        return $this->unit_price;
    }

}

class Cart {

    var $products;
    var $depth;

    function __construct() {
        $this->products = array();
        $this->depth = 0;
    }

    function add_product($product) {
        $this->products[$this->depth] = $product;
        $this->depth++;
    }

    function delete_product($product_no) {
        unset($this->products[$product_no]);
		$this->products = array_values($this->products);
		$this->depth--;
    }

    function get_depth() {
        return $this->depth;
    }

    function get_product($product_no) {
        return $this->products[$product_no];
    }

}

?>