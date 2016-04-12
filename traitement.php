<?php
ini_set("SMTP","aspmx.l.google.com"); //A commenter sur le serveur
$mail = strip_tags ($_POST['email']);; // Déclaration de l'adresse de l'expediteur
$sujet = strip_tags($_POST['name']); // Nom de la société
$message_txt = strip_tags ($_POST['message']); //Corp du message

if(!empty($mail) && !empty($sujet) && !empty($message_txt))
{
	if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		 
		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		//==========
		 
		//=====Création du header de l'e-mail.
		$header = "From: <".$mail.">".$passage_ligne;
		$header.= "Reply-to: <".$mail.">".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		 
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;

		//Adresse mail sur laquel tu reçois le message
		$to = "opommeron.datastory@gmail.com";
		 
		//=====Envoi de l'e-mail.
		mail($to,$sujet,$message,$header);
		//==========redirige à la page html
		header('Location: index.html');
	}else{
		echo "erreur2";
	}
}else{
	echo 'erreur';
}

?>
