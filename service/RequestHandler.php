<?php
	require "Event.php";
	require "GetEvent.php";
	require "CreateEvent.php";
	require "EventService.php";
	class requestHandler {
		public function handleRequest() {
			$request = $_REQUEST;												//Globale Apache Variable Request deklarieren
			if ($_SERVER["REQUEST_METHOD"] == "PUT") {							//Überprüfung, ob die Anfrage eine PUT Anfrage ist und entsprechende Parameter deklarieren
				parse_str(file_get_contents("php://input"), $body_parameters);
				$request = $request + $body_parameters;
			}
			$request_headers = apache_request_headers();						//Objekt der Apache-Klasse request_headers aufrufen, um URL requests zu identifizieren
			$class_name = $request["command"];									//Kommando aus der URL identifizieren; Sprich, ob es sich um ein CreateEvent oder GetEvent oder etc handelt
			$command = new $class_name;											//Ein Objekt der Klasse des Kommandos erzeugen
			$result = $command->execute($request, $request_headers);			//Funktion der Kommandoklasse aufrufen und Übergabe in Variable speichern
			echo(json_encode($result));											//Ausgabe in json Formatierung
		}
	}
	$request_handler = new RequestHandler();									//Erzeugung eines Objektes der eigenen Klasse RequestHandler
	$request_handler->handleRequest();											//Oben beschriebene Funktion aufrufen
?>