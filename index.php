<?php

session_start();

// Inclures les Classes

	// Inclure les classes
	spl_autoload_register(function($classe){

		require_once('class/'.$classe.'.php');
	});
	

	if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])){

		// Variables 

		$pseudo   =  htmlspecialchars($_POST['pseudo']);
		$email    =  htmlspecialchars($_POST['email']);
		$password =  htmlspecialchars($_POST['password']);
		

		// Vérifier la syntax de l'email
		if(!Verifier::syntaxeEmail($email)){
			header('location:index.php?error=true&message=Vérifier le format de votre adresse email.');
			exit();
		}
		// Vérifier le doublon de L'email
		if(Verifier::doublonEmail($email)){
			header('location:index.php?error=true&message=Cette adresse mail est déjà utiliser.');
			exit();
		}

		// Chiffré  le mot de passe
		$password = Securite::chiffrer($password);


		// Créer un Utilisateur

		$utilisateur = new Utilisateur($pseudo, $email, $password);
		$utilisateur->enregistrer();
		$utilisateur->creerLesSessions();


		// Rediriger L'utilisateur
		header('location: index.php?success=true');
		exit();
		 

	}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/default.css">
	<title>Mon Site PHP</title>
</head>
<body>

	<section class="container">
		
		<form method="post" action="index.php">

			<p>Incription</p>

			<?php if(isset($_GET['success'])) {
				echo '<p class="alert success">Inscription réalisée avec succès.</p>';
			}
			else if(isset($_GET['error']) && !empty($_GET['message'])) {
				echo '<p class="alert error">'.htmlspecialchars($_GET['message']).'</p>';
			} ?>

			<input type="text" name="pseudo" id="pseudo" placeholder="Pseudo"><br>
			<input type="email" name="email" id="email" placeholder="Email"><br>
			<input type="password" name="password" id="password" placeholder="Mot de passe"><br>
			<input type="submit" value="Inscription">
		
		</form>

		<div class="drop drop-1"></div>
		<div class="drop drop-2"></div>
		<div class="drop drop-3"></div>
		<div class="drop drop-4"></div>
		<div class="drop drop-5"></div>
	</section>

</body>
</html>