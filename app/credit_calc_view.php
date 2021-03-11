<?php require_once dirname(__FILE__) .'/../config.php';?>
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

<form action="<?php print(_APP_URL);?>/app/credit_calc.php" method="post">
	<label for="id_x">Kwota </label><br>
	<input id="id_x" type="text" name="kwota" value="<?php out($kwota); ?>" /><br />
	<label for="id_y">Lata </label><br>
	<input id="id_y" type="text" name="lata" value="<?php out($lata); ?>" /><br />
	<label for="id_z">Oprocentowanie </label><br>
	<input id="id_z" type="text" name="oprocentowanie" value="<?php out($oprocentowanie); ?>" /><br />
	<input type="submit" value="Oblicz miesięczną ratę"/>
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

<?php if (isset($result)){ ?>
<div style="position: absolute; top: 77%; left: 48%; transform: translateX(-50%); margin: 20px; padding: 10px; border-radius: 5px; background-color: black; color: green; width:250px;">
<?php echo '<ul style="border-bottom: 1px solid green"; list-style:none>'."Miesięczna rata to ".$result."zł".'</ul>'; ?>
</div>
<?php } ?>

</body>
</html>