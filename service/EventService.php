<?php
	class EventService {
	//Deklaration von Statusrückgabewerten
		const ERROR = "ERROR";
		const NOT_FOUND = "NOT_FOUND";
		const INVALID_INPUT = "INVALID_INPUT";
		const OK = "OK";
		const VERSION_OUTDATED = "VERSION_OUTDATED";
		
		
	//Abfrage eines Events
		public function readEvent($id) {
			$link = mysqli_connect("db4free.net:3306","bwi2131005","EventDB","bwi2131005");
			if ($link->connect_error != NULL) {									//Prüfung, ob Datenbankaufbau erfolgreich war
				return self::ERROR;												//Sollte Aufbau nicht erfolgreich sein "ERROR" zurückgeben
			}
			$select_statement = "SELECT * ".									//SQL Abfrage Statement
							"FROM eventlist ".								
							"WHERE id = '$id' ";
			$result_set = $link->query($select_statement);						//Übergabe des Statements in Variable
			$event = array();													//Erstellung eine Arrays; Dient zur Übergabe zur Klasse GetEvent
			$event = $result_set->fetch_object("Event");						//Ergebnisse des Abfragestatements in Array schreiben
			if ($event === NULL) {
				$link->close();
				return self::NOT_FOUND;
			}
			mysqli_close($link);												//Verbindung abbauen
			var_dump($event);
			return $event;														//Ergebnisübergabe
		}
		
	//Abfrage aller Events
		public function readEvents($id) {
			$link = mysqli_connect("db4free.net:3306","bwi2131005","EventDB","bwi2131005");
			if ($link->connect_error != NULL) {									//Prüfung, ob Datenbankaufbau erfolgreich war
				return self::ERROR;												//Sollte Aufbau nicht erfolgreich sein "ERROR" zurückgeben
			}
			$select_statement = "SELECT * ".
							"FROM eventlist ".
							"ORDER BY due_date ASC ";
			$result_set = $link->query($select_statement);
			$events = array();
			$event = $result_set->fetch_object("Event");
			while($event != NULL) {												//Schleife für dynamische Anzeige aller Events
				$events[] = $event;
				$event = $result_set->fetch_object("Event");
			}
			mysqli_close($link);
			return $events;
		}
		
	//Erstellen eines Events
		public function createEvent($event) {
			//if ($event->title == "") {
				//$result = new CreateTodoResult();
				//$result->status_code = self::INVALID_INPUT;
				//$result->validation_messages["title"] = "Titel fehlt";
				//return $result;
			//}			
			$link = mysqli_connect("db4free.net:3306","bwi2131005","EventDB","bwi2131005");
			if ($link->connect_error != NULL) {									//Prüfung, ob Datenbankaufbau erfolgreich war
				return self::ERROR;												//Sollte Aufbau nicht erfolgreich sein "ERROR" zurückgeben
			}
			$insert_statement = "INSERT INTO eventlist SET ".
								"location = '$event->location', ".
								"event_date = '$event->event_date', ".
								"title = '$event->title', ".
								"description = '$event->description'";
			$link->query($insert_statement);
			$id = $link->insert_id;
			mysqli_close($link); 
			//$result = new CreateTodoResult();
			//$result->status_code = self::OK;
			//$result->id = $id;
			//return $result;
		}
	}
?>