<?php
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=bikio', 'root', '');

<<<<<<< HEAD
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bikio', 'root', '');

if(isset($_POST['forminscription']))
{
	if(!empty($_POST['pseudo']) || !empty($_POST['mail']) || !empty($_POST['mail2']) || !empty($_POST['mdp']) || !empty($_POST['mdp2']))
	$pseudo=htmlspecialchars($_POST['pseudo']);
	$mail=htmlspecialchars($_POST['mail']);
	$mail2=htmlspecialchars($_POST['mail2']);
	$mdp=sha1($_POST['mdp']);
	$mdp2=sha1($_POST['mdp2']);
	
=======
	if(isset($_POST['forminscription']))
>>>>>>> ee13d72080a6fa64ac96b9b93c0d2b3d17e415f4
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);

		if(!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2']))
		{
			$pseudolength = strlen($pseudo);
			if($pseudolength <= 20)
			{
				if($mail == $mail2)
				{
					if(filter_var($mail, FILTER_VALIDATE_EMAIL))
					{
						$reqmail = $bdd -> prepare("SELECT * FROM membres WHERE email = ?");
						$reqmail->execute(array($mail));
						$mailexist = $reqmail -> rowCount();
						if($mailexist == 0)
						{
							if($mdp == $mdp2)
							{
								$insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, email, password) VALUES (?,?,?)");
								$insertmbr -> execute(array($pseudo, $mail, $mdp));
								$erreur = "Votre compte a été créé. <a href=\"..\php\connexion.php\">Me connecter</a>";
							}
							else
							{
								$erreur = "Vos mots de passe ne correspondent pas.";
							}
						}
						else
						{
							$erreur = "Adresse mail déjà utilisée.";
						}
					}
					else
					{
						$erreur = "Votre adresse mail n est pas valide.";
					}
				}
				else
				{
					$erreur = "Vos adresses mails ne correspondent pas.";
				}
			}
			else
			{
				$erreur = "Votre pseudo ne doit pas dépasser 20 caractères.";
			}
		}
		else
		{
		$erreur = "Tous les champs doivent être complétés correctement.";
		}	
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Formulaire</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
		<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:400,600'>
		<link rel="stylesheet" href="..\css\Formulaire.css">
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src="..\javascript\Formulaire.js"></script>
	</head>
	<body onload="if($('#error') !== null){$('#overlay').addClass('open');}">
		<main role="main" class="html">
			<button class="popup-trigger btn" id="popup-trigger"><span>Inscription<i class="fa fa-plus-square-o"></i></span></button>
		</main>
		<div class="overlay" id="overlay">
			<div class="overlay-background" id="overlay-background"></div>
			<div class="overlay-content" id="overlay-content">
				<div class="fa fa-times fa-lg overlay-close" id="overlay-close"></div>
				<h1 class="main-heading">Inscription</h1>
				<h3 class="blurb">Créer un compte est gratuit</h3><span class="blurb-tagline"></span>
				<form class="signup-form" method="post" action="#" novalidate="novalidate">
					<label for="signup-name">Pseudo</label>
					<input id="signup-name" type="text" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;}?>" autocomplete="off" required />
					<label for="signup-email">Adresse mail</label>
					<input id="signup-email" type="email" name="mail" value="<?php if(isset($mail)) {echo $mail;}?>" autocomplete="off" required/>
					<label for="signup-email">Confirmer votre adresse mail</label>
					<input id="signup-email" type="email" name="mail2" value="<?php if(isset($mail2)) {echo $mail2;}?>" autocomplete="off" required/>
					<label for="signup-pw">Mot de passe</label>
					<input id="signup-pw" type="password" name="mdp" autocomplete="off" required/>
					<label for="signup-cpw">Confirmer mot de passe</label>
					<input id="signup-cpw" type="password" name="mdp2" autocomplete="off" required/>
					<button type="submit" name="forminscription" value="Inscription" class="btn btn-outline submit-btn"><span>s'inscrire</span></button>
				</form>
				<?php 
					if(isset($erreur))
					{
						echo '<font color="red">'.$erreur.'</font>';
					}
				?>
			</div>
		</div>
	</body>
</html>