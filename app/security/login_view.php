<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator</title>
<link rel="stylesheet" href="css/style.css">
<link rel="preconnect" href="https://fonts.gstatic.com"> 
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/security/login.php" method="post" class="pure-form pure-form-stacked">
	<legend>Logowanie</legend>
	<fieldset>
		<label for="id_x">Login</label><br>
		<input id="id_x" type="text" name="login" value="<?php out($form['login']) ?>"/><br/>
		<label for="id_y">Password</label><br>
		<input id="id_y" type="text" name="password"/><br/>
	</fieldset>
	<input type="submit" value="Login" class="pure-button pure-button-primary"/>
</form>


<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ul style="margin: 20px; list-style: none; position: absolute; top: 77%; left: 48%; transform: translateX(-50%); padding: 10px 10px 10px 30px; border-radius: 5px;  background-color: black; color: red; width:250px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<ul style="border-bottom: 1px solid red">'.$msg.'</ul>';
		}
		echo '</ul>';
	}
}
?>



</body>
</html>