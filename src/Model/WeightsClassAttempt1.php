<?php

// This class should be static because there is only one of it.
class weights{
	
	// These variables should be static because they are constant throughout calculation.
	public $weights = array(
		"price"	=> 30,
		"CPU" 	=> 20,
		"HD" 	=> 20,
		"RAM" 	=> 10,
		"GPU" 	=> 10,
		"features" 	=> 10,
		"reviews" 	=> 5,
		"drives" 	=> 5,
	);
	
	public function __construct($valuemap) {
	  $this->weights["price"] = $valuemap['price'];
	  $this->weights["CPU"] = $valuemap['cpu'];
	  $this->weights["HD"] = $valuemap['hd'];
	  $this->weights["RAM"] = $valuemap['ram'];
	  $this->weights["GPU"] = $valuemap['gpu'];
	  $this->weights["features"] = $valuemap['features'];
	  $this->weights["reviews"] = $valuemap['reviews'];
	  $this->weights["drives"] = $valuemap['drives'];
	  
	  $this->isTooBigOk["price"] = 0;
	  $this->isTooBigOk["CPU"] = 1;
	  $this->isTooBigOk["HD"] = 1;
	  $this->isTooBigOk["RAM"] = 1;
	  $this->isTooBigOk["GPU"] = 1;
	  $this->isTooBigOk["features"] = 1;
	  $this->isTooBigOk["reviews"] = 1;
	  $this->isTooBigOk["drives"] = 1;
	}
	
	// This array indicates which components are acceptably too big or too small.
	// For example, if a gadget's price is too high, this is not acceptable, but
	// if the processor score is too high, this is acceptable.
	public $isTooBigOk = array(
		"price" => 0,
		"CPU"	=> 1,
		"HD"	=> 1,
		"RAM"	=> 1,
		"GPU"	=> 1,
		"features"	=> 1,
		"reviews"	=> 1,
		"drives"	=> 1,
	);
}
?>