<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
include _ROOT_PATH.'/app/security/check.php';
// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów
function getParams(&$kwota,&$lata,&$oprocentowanie){
$kwota = isset($_REQUEST['kwota']) ?  $_REQUEST['kwota'] : null;
$lata = isset($_REQUEST['lata']) ?  $_REQUEST['lata'] : null;
$oprocentowanie = isset($_REQUEST['oprocentowanie']) ?  $_REQUEST['oprocentowanie'] : null;
}
// sprawdzenie, czy parametry zostały przekazane

function validate(&$kwota, &$lata,&$oprocentowanie, &$messages){
if ( ! (isset($kwota) && isset($lata) && isset($oprocentowanie))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	// $messages [] = 'Błąd w wywołaniu aplikacji. Brak jednego z parametrów';
	return false;
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $kwota == "") {
	$messages [] = 'Nie podano kwoty pozyczki';
}
if ( $lata == "") {
	$messages [] = 'Nie podano czasu na jaki została wzięta pozyczka';
}
if($oprocentowanie == ""){
	$messages[] = "Nie podano oprocentowania";
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty($messages)) {
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric($kwota)) {
		$messages [] = 'Kwota pozyczki nie jest liczbą całkowitą';
	}
	
	if (! is_numeric($lata)) {
		$messages [] = 'Okres spłacenia pozyczki nie został podany jako liczba całkowita';
	}
	if(! is_numeric($oprocentowanie)){
		$messages[] = 'Oprocentowanie nie jest wartością całkowitą'; 
	}	

}
}

// 3. wykonaj zadanie jeśli wszystko w porządku
function process(&$kwota,&$lata,&$oprocentowanie,&$result){
	// global $role;
	
	
	if (empty ($messages)) { // gdy brak błędów
	
	//konwersja parametrów na int
	$kwota = intval($kwota);
	$lata = intval($lata);
	$oprocentowanie = floatval($oprocentowanie);
	
	//wykonanie operacji

	//oprocentowanie w skali miesiąca
	$result = ($kwota + $kwota * $oprocentowanie) / (12 * $lata);

	//oprocentowanie w skali roku 
	// $result = $kwota / (12 * $lata) + ($kwota / (12 * $lata)) * $oprocentowanie;
}
}

$kwota = null;
$lata = null;
$oprocentowanie = null;
$messages = array();

getParams($kwota,$lata,$oprocentowanie);

if(validate($kwota,$lata,$oprocentowanie,$messages)){
	process($kwota,$lata,$oprocentowanie,$result);
}


// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'credit_calc_view.php';
