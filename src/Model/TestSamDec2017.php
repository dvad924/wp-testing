<?

$myUserInput = new UserInput(array("price" => 500, "cpu" => 0.8, "hd" => 1, "ram" => 5, 
"gpu" => null, "features" => null, "reviews" => null, "drives" => null));
//echo("myUserInput value of *price*: " . $myUserInput->userAttributes["price"] . "<br>");
$myWeights = new weights(array("price" => 30, "cpu" => 20, "hd" => 20, "ram" => 10, 
"gpu" => 10, "features" => 10, "reviews" => 5, "drives" => 5));
//echo("myWeights value of *price*: " . $myWeights->weights["price"] . "<br>");
//echo("myWeightsTooBig value of *price*: " . $myWeights->isTooBigOk["price"] . "<br>");
$myGadget = new gadget(array("price" => 550, "cpu" => 1.5, "hd" => 5, "ram" => 4, 
"gpu" => null, "features" => null, "reviews" => null, "drives" => null));
//echo("myGadget value of *price*: " . $myGadget->gadgetAttributes["price"] . "<br>");

$myGadget->CalcScore($myUserInput->userAttributes, $myWeights->weights, $myWeights->isTooBigOk);

echo($myGadget->score . "<br.");

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

class gadget {
	
	public $gadgetAttributes = array(
		"price"		=> null,
		"CPU" 		=> null,
		"HD" 		=> null,
		"RAM" 		=> null,
		"GPU" 		=> null,
		"features" 	=> null,
		"reviews" 	=> null,
		"drives" 	=> null,
	);
	
	/* This is the old way of storing gadget attributes
	var $price;
	var $CPU;
	var $HD;
	var $RAM;
	var $GPU;
	var $features;
	var $reviews;
	var $drives;
	
	var $priceScore;
	var $CPUScore;
	var $HDScore;
	var $RAMScore;
	var $GPUScore;
	var $featuresScore;
	var $reviewsScore;
	var $drivesScore;
	*/
	
	public $gadgetScores = array(
		"priceScore"	=> null,
		"CPUScore" 		=> null,
		"HDScore" 		=> null,
		"RAMScore" 		=> null,
		"GPUScore" 		=> null,
		"featuresScore" => null,
		"reviewsScore" 	=> null,
		"drivesScore" 	=> null,
	);
	
	public function __construct($valuemap) {
		$this->gadgetAttributes["price"] = $valuemap['price'];
		$this->gadgetAttributes["CPU"] = $valuemap['cpu'];
		$this->gadgetAttributes["HD"] = $valuemap['hd'];
		$this->gadgetAttributes["RAM"] = $valuemap['ram'];
		$this->gadgetAttributes["GPU"] = $valuemap['gpu'];
		$this->gadgetAttributes["features"] = $valuemap['features'];
		$this->gadgetAttributes["reviews"] = $valuemap['reviews'];
		$this->gadgetAttributes["drives"] = $valuemap['drives'];
	}
	
	public $score;
	
	public function CalcPrice($priceInput, $priceFromGadget){
		$tempPriceResult = 2 * ($priceInput - $priceFromGadget) / (($priceInput + $priceFromGadget) / 2);
		return $priceInput > $priceFromGadget ? 1 : 1 * (1 + $tempPriceResult);
	}
	
	public function CalcComponent($componentInput, $componentFromGadget, $isTooBigOk){
		$tempComponentResult = ($componentInput - $componentFromGadget) / (($componentInput + $componentFromGadget) / 2);
		return $componentInput > $componentFromGadget ? 1 : 1 * (1 - $tempComponentResult);
	}
	
	// This calls the user input (which is stored in a gadget) and the weights class
	// Perhaps the weights class should be static or something
	public function CalcScore($userInputAttributes, $weights, $isTooBigOk){
		
		$tempUserAttribute;
		$tempGadgetAttribute;
		
		$runningInnerProduct = 0;
		$runningUserInnerProduct = 0;
		$runningGadgetInnerProduct = 0;
		
		$userAttributesIndexedArray = array_values($userInputAttributes);
		$gadgetAttributesIndexedArray = array_values($this->gadgetAttributes);
		$isTooBigOkIndexedArray = array_values($isTooBigOk);
		$weightsIndexedArray = array_values($weights);
		
		// Debug statements
		echo("weightsIndArr value of *price*: " . $weightsIndexedArray[0] . "<br>");
		echo("isTooBiIndArr value of *price*: " . $isTooBigOkIndexedArray[0] . "<br>");
		echo("userAttIndArr value of *price*: " . $userAttributesIndexedArray[0] . "<br>");
		echo("gadgAttIndArr value of *price*: " . $gadgetAttributesIndexedArray[0] . "<br>");
		
		for ($i = 0; $i < count($userAttributesIndexedArray); $i++) {
			
			// Assign attribute of user and gadget to a temporary variable. This is done 
			// to accomodate normalization. I don't want to change the original values.
			if ($userAttributesIndexedArray[$i] == null){
				$tempUserAttribute = 0;
			} else {
				$tempUserAttribute = $userAttributesIndexedArray[$i];
			}
			if ($gadgetAttributesIndexedArray[$i] == null){
				$tempGadgetAttribute = 0;
			} else {
				$tempGadgetAttribute = $gadgetAttributesIndexedArray[$i];
			}
			
			// Debug statements
			echo("i: " . $i . "<br>");
			echo("weightsIndexedArray[$i]: " . $weightsIndexedArray[$i] . "<br>");
			echo("tempUserAttribute: " . $tempUserAttribute . "<br>");
			echo("tempGadgetAttribute: " . $tempGadgetAttribute . "<br>");
			
			// Normalize input vector component to user preference
			// Avoid dividing by zero
			if ($tempUserAttribute == 0){
				// If the user attribute is 0, we will use the gadget attribute for normalization
				if ($tempGadgetAttribute == 0){
					// Do nothing if they are both zero
				} else {
					$tempGadgetAttribute = $tempGadgetAttribute / abs($tempGadgetAttribute);
				}
			} else {
				$tempGadgetAttribute = $tempGadgetAttribute / $tempUserAttribute;
				$tempUserAttribute = 1;
			}
			
			// See if the component being too big or too small is acceptable
			if ($isTooBigOkIndexedArray[$i] == 0 && $tempGadgetAttribute < $tempUserAttribute) {
				$tempGadgetAttribute = $tempUserAttribute;
			} elseif ($isTooBigOkIndexedArray[$i] == 1 && $tempGadgetAttribute > $tempUserAttribute) {
				$tempGadgetAttribute = $tempUserAttribute;
			}
			
			// Calculate weighted inner products
			$runningInnerProduct += $weightsIndexedArray[$i] * $tempUserAttribute * $tempGadgetAttribute;
			$runningUserInnerProduct += $weightsIndexedArray[$i] * $tempUserAttribute * $tempUserAttribute;
			$runningGadgetInnerProduct += $weightsIndexedArray[$i] * $tempGadgetAttribute * $tempGadgetAttribute;
		}
		
		// Normalize result
		$userNorm = sqrt($runningUserInnerProduct);
		$gadgetNorm = sqrt($runningGadgetInnerProduct);
		$this->score = $runningInnerProduct / ($userNorm * $gadgetNorm);
		
		/* This is the old way of computing individual components
		$this->priceScore = CalcComponent($userInput->price, $this->price, 0);
		$this->CPUScore = CalcComponent($userInput->CPU, $this->CPU, 1);
		$this->HDScore = CalcComponent($userInput->HD, $this->HD, 1);
		$this->RAMScore = CalcComponent($userInput->RAM, $this->RAM, 1);
		$this->GPUScore = CalcComponent($userInput->GPU, $this->GPU, 1);
		$this->featuresScore = CalcComponent($userInput->features, $this->features, 1);
		$this->reviewsScore = CalcComponent($userInput->reviews, $this->reviews, 1);
		$this->drivesScore = CalcComponent($userInput->drives, $this->drives, 1);
		
		var $tempPriceScore = $weights->priceWeight * $this->priceScore;
		var $tempCPUScore = $weights->CPUWeight * $this->CPUScore;
		var $tempHDScore = $weights->HDWeight * $this->HDScore;
		var $tempRAMScore = $weights->RAMWeight * $this->RAMScore;
		var $tempGPUScore = $weights->GPUWeight * $this->GPUScore;
		var $tempFeaturesScore = $weights->featuresWeight * $this->featuresScore;
		var $tempReviewsScore = $weights->reviewsWeight * $this->reviewsScore;
		var $tempDrivesScore = $weights->drivesWeight * $this->drivesScore;
		
		$this->score = $tempPriceScore + $tempCPUScore + $tempHDScore + $tempRAMScore + tempGPUScore + tempFeaturesScore + tempReviewsScore + tempDrivesScore;
		
		*/
	}
}

?>