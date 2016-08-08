<?php

	require_once dirname(__FILE__).'/inc/configuration.php';

	$allowedExts = array("gif", "jpeg", "jpg", "png");
		
	$errors = array();
	$uploadFiles = array();
	
	foreach($_FILES as $file){
		if($file['error'] != 0){
			continue;
		}
		$temp = explode(".", $file["name"]);
		$extension = end($temp);
		if ((($file["type"] == "image/gif")
				|| ($file["type"] == "image/jpeg")
				|| ($file["type"] == "image/jpg")
				|| ($file["type"] == "image/pjpeg")
				|| ($file["type"] == "image/x-png")
				|| ($file["type"] == "image/png"))
				&& ($file["size"] < 10000000)
				&& ($file["size"] != 0)
				&& in_array($extension, $allowedExts))
		{
			$uploadedName = md5_file($file['tmp_name']) . "." . $extension;
			$uploadPath = dirname(__FILE__).'/uploads/'.$uploadedName;
			
			$success = true;
			if(!file_exists($uploadPath)){//We already have this photo. Do nothing
				$success = move_uploaded_file($file["tmp_name"],	$uploadPath);
			}
			
			
			
			if($success){
				$uploadFiles[$file["name"]] = $uploadedName;
			}
		}
		else
		{
			$errors[] = "File type is not allowed ".$file["type"]. " " . $extension. ' ' .$file["size"];
		}
	}
	
	
	if(count($errors) > 0){
		print join("<br />", $errors);
		exit();	
	}
	
	
	$firstName = array_key_exists('estimator_form_first_name', $_POST) ? $_POST['estimator_form_first_name'] : '';
	$lastName = array_key_exists('estimator_form_last_name', $_POST) ? $_POST['estimator_form_last_name'] : '';	
	$email = array_key_exists('estimator_form_email_address', $_POST) ? $_POST['estimator_form_email_address'] : '';
	$serial = array_key_exists('estimator_form_serial_number', $_POST) ? $_POST['estimator_form_serial_number'] : '';
	$additional = array_key_exists('estimator_form_additional_details', $_POST) ? $_POST['estimator_form_additional_details'] : '';	
	$keyboardMouse = array_key_exists('estimator_form_keyboard_mouse', $_POST) ? $_POST['estimator_form_keyboard_mouse'] : '';
	$powerCord = array_key_exists('estimator_form_power_cord', $_POST) ? $_POST['estimator_form_power_cord'] : '';
	$hasIssues = array_key_exists('estimator_form_issues', $_POST) ? $_POST['estimator_form_issues'] : '';
	$issuesInfo = array_key_exists('estimator_form_issues_info', $_POST) ? $_POST['estimator_form_issues_info'] : '';
	$hasBox = array_key_exists('estimator_form_box', $_POST) ? $_POST['estimator_form_box'] : '';
	$previouslySold = array_key_exists('estimator_form_prev_sold', $_POST) ? $_POST['estimator_form_prev_sold'] : '';
	$paymentOption = array_key_exists('estimator_form_payment', $_POST) ? $_POST['estimator_form_payment'] : '';
	$acAdapter = array_key_exists('estimator_form_adapter', $_POST) ? $_POST['estimator_form_adapter'] : '';
	$battery = array_key_exists('estimator_form_good_battery', $_POST) ? $_POST['estimator_form_good_battery'] : '';
	
	$adapterAndCord = array_key_exists('estimator_form_adapter_and_cord', $_POST) ? $_POST['estimator_form_adapter_and_cord'] : '';
	
	
	
	
	$title = array_key_exists('est_model_title', $_POST) ? $_POST['est_model_title'] : '';
	$price = array_key_exists('est_model_price', $_POST) ? $_POST['est_model_price'] : '';
	
	$address1 = array_key_exists('estimator_form_address', $_POST) ? $_POST['estimator_form_address'] : '';
	$address2 = array_key_exists('estimator_form_address_line2', $_POST) ? $_POST['estimator_form_address_line2'] : '';
	$city = array_key_exists('estimator_form_city', $_POST) ? $_POST['estimator_form_city'] : '';
	$state = array_key_exists('estimator_form_state', $_POST) ? $_POST['estimator_form_state'] : '';
	$zip = array_key_exists('estimator_form_zip_code', $_POST) ? $_POST['estimator_form_zip_code'] : '';
	
	
	
$mailBody = '';
$mailBody .= $firstName." ". $lastName."\r\n";
$mailBody .= $email."\r\n\r\n";

if($address1 != ''){
	$mailBody .= "$address1\r\n";
}
if($address2 != ''){
	$mailBody .= "$address2\r\n";
}
if($city != '' && $state != '' && $zip != ''){
	$mailBody .= "$city, $state $zip\r\n\r\n";
}

if($serial != ''){
	$mailBody .= "Serial Number: $serial\r\n";
}
$mailBody .= "Model: $title\r\n";
$mailBody .= "Estimate: \$$price\r\n";
if($previouslySold != ''){
	$mailBody .= "Previous Seller?: $previouslySold\r\n\r\n";
}
if($paymentOption != ''){
	$mailBody .= "Preferred Payment: $paymentOption\r\n";
}
$mailBody .= "----------------------------------\r\n\r\n";
if($hasBox != ''){
	$mailBody .= "Original Box?: $hasBox\r\n";
}




	if($powerCord != ''){
		$mailBody .= "Has Power Cord: $powerCord\r\n";
	}
	if($keyboardMouse != ''){
		$mailBody .= "Has Keyboard and Mouse: $keyboardMouse\r\n";
	}
	if($acAdapter != ''){
		$mailBody .= "Has AC Adapter: $acAdapter\r\n";
	}
	if($battery != ''){
		$mailBody .= "Good Battery: $battery\r\n";
	}
	if($adapterAndCord != ''){
		$mailBody .= "Has wall adapter and USB charging cord: $adapterAndCord\r\n";
	}
	

	$mailBody .= "\r\nDescription: $additional\r\n\r\n";
	$mailBody .= "Cosmetic/Operational Defects: $issuesInfo\r\n";
	
	

	

	foreach($uploadFiles as $key=>$val){
		$mailBody .= "File: $key Saved AS: ". CONFIGURATION_UPLOADED_WEB_DIRECTORY.$val."\r\n";
	}
	
	
	
	$to      = CONFIGURATION_SELLERS_EMAIL_RECIPIENT;
	$subject = CONFIGURATION_SELLERS_EMAIL_SUBJECT;
	$message = $mailBody;
	$headers = 'From: '.CONFIGURATION_SELLERS_EMAIL_FROM . "\r\n" .
	    'Reply-To: '.$email . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
	
	$success = mail($to, $subject, $message, $headers);
	
	$est_model_title = $_POST['est_model_title'];
	$est_model_thumb = $_POST['est_model_thumb'];
	$est_model_price = $_POST['est_model_price'];
	


	print '<!-- Outside '.$est_model_thumb. '-->';
	function getEstimateImage(){
		global $est_model_title, $est_model_thumb;
		print '<!-- Inside '.$est_model_thumb. '-->';
		return '<img id="est_model_thumb" src="'.$est_model_thumb.'" alt="'.$est_model_title.'" title="'.$est_model_title.'"/>';
	}
	
	function getEstimatePrice(){
		global $est_model_price;
		return $est_model_price;
	}
	
	function getEstimateModel(){
		global $est_model_title;
		return $est_model_title;
	}
	add_shortcode('estImage', 'getEstimateImage');  
	add_shortcode('estPrice', 'getEstimatePrice');  
	add_shortcode('estModel', 'getEstimateModel');  





//require_once dirname(__FILE__). '/../../wp-content/themes/custom/footer.php';



?>