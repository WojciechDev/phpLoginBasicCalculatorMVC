<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../../config.php';
// include _ROOT_PATH.'/app/security/check.php';
// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów
function getParamsLogin(&$form){
$form['login'] = isset($_REQUEST['login']) ?  $_REQUEST['login'] : null;
$form['password'] = isset($_REQUEST['password']) ?  $_REQUEST['password'] : null;
}
// sprawdzenie, czy parametry zostały przekazane

function validateLogin(&$form,&$messages){
	if (!(isset($form['login'])  && isset($form['password']))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['login'] == "") {
		$messages [] = 'Nie podano loginu';
	}
	if ( $form['password'] == "") {
		$messages [] = 'Nie podano hasła';
	}

//nie ma sensu walidować dalej gdy brak parametrów
	if (count($messages) > 0) return false;
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if ($form['login'] == 'admin' && $form['password'] == 'admin') {
		session_start();
        $_SESSION['role'] = 'admin';
        return true;
	}
	
	if ($form['login'] == 'user' && $form['password'] == 'user') {
		session_start();
        $_SESSION['role'] = 'user';
        return true;
	}

    $messages [] = "Niepoprawny login lub hasło";
    return false;

}

$form = array();
$messages = array();

getParamsLogin($form);

if(!validateLogin($form,$messages)){
    include _ROOT_PATH."/app/security/login_view.php";
}else{
    header('Location: '._APP_URL);
}
