<?php
	class CreateEvent {
	//Funktion, um ein Event zu erstellen
		public function execute($request) {
			$event = new Event();												//Erstellung eines Objektes der Klasse Event
			if (isset($request["title"]) == TRUE) {								//Überprüfung, ob es einen Titel gibt, der Übergeben werden soll
				$event->title = $request["title"];								//Übergabe des Titels aus der URL
			}
			if (isset($request["event_date"]) == TRUE) {						//Überprüfung und Übergabe des Datums
				$event->due_date = $request["event_date"];
			}
			if (isset($request["location"]) == TRUE) {							//Überprüfung und Übergabe der Location
				$event->notes = $request["location"];
			}
			
			$event_service = new EventService();								//Erstellung eines Objektes der Klasse EventService
			$result = $event_service->createEvent($event);						//Methode createEvent aufrufen und Rückgabewert in Variable speichern
			//if ($result->status_code == TodoService::INVALID_INPUT) {
			//	header("HTTP/1.1 400");
			//	return $result->validation_messages;
			//}
			return $result;														//Ergebnis zurückgeben
			
			
			//header("HTTP/1.1 201");
			//header("Location: /service/todos/$result->id");
		}
	}
?>