<?php
	
	$errors = array();

	// Vérifiez si le nom a été saisi
	if (!isset($_POST['name'])) {
		$errors['name'] = "S'il vous plait, indiquez votre nom";
	}
	
	// Vérifiez si le courrier électronique a été saisi et est valide
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = "S'il vous plait, indiquez une adresse e-mail Valide";
	}
	
	//Vérifiez si le message a été saisi
	if (!isset($_POST['message'])) {
		$errors['message'] = "S'il vous plait, indiquez votre message";
	}

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}



	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$from = $email;
	$to = 'stephds01@gmail.com';  // please change this email id
	$subject = 'Demande de renseignement';
	
	$body = "From: $name\n E-Mail: $email\n Message:\n $message";


	//send the email
	$result = '';
	if (mail ($to, $subject, $body)) {
		$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
 		$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= 'Votre mail a bien été envoyé, nous vous recontacterons très rapidement';
		$result .= '</div>';

		echo $result;
		die();
	}

	$result = '';
	$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= "Quelque chose se passe mal lors de l'envoi de ce message. Veuillez réessayer plus tard";
	$result .= '</div>';

	echo $result;
	