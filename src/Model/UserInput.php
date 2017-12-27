<?php

class UserInput {
	
	// This array stores the user input
	public $userAttributes = array(
		"price"		=> null,
		"CPU" 		=> null,
		"HD" 		=> null,
		"RAM" 		=> null,
		"GPU" 		=> null,
		"features" 	=> null,
		"reviews" 	=> null,
		"drives" 	=> null,
	);
	
	/*
	private $price;
	private $CPU;
	private $HD;
	private $RAM;
	private $GPU;
	private $features;
	private $reviews;
	private $drives;
	*/

	public function __construct($valuemap) {
	  $this->userAttributes["price"] = $valuemap['price'];
	  $this->userAttributes["CPU"] = $valuemap['cpu'];
	  $this->userAttributes["HD"] = $valuemap['hd'];
	  $this->userAttributes["RAM"] = $valuemap['ram'];
	  $this->userAttributes["GPU"] = $valuemap['gpu'];
	  $this->userAttributes["features"] = $valuemap['features'];
	  $this->userAttributes["reviews"] = $valuemap['reviews'];
	  $this->userAttributes["drives"] = $valuemap['drives'];
	}

	public function price() {
		   return $this->$userAttributes["price"];
	}
	public function CPU() {
		   return $this->$userAttributes["CPU"];
	}
	public function HD() {
		   return $this->$userAttributes["HD"];
	}
	public function RAM() {
		   return $this->$userAttributes["RAM"];
	}
	public function GPU() {
		   return $this->$userAttributes["GPU"];
	}
	public function features() {
		   return $this->$userAttributes["features"];
	}
	public function reviews() {
		   return $this->$userAttributes["reviews"];
	}
	public function drives() {
		   return $this->$userAttributes["drives"];
	}
}

?>