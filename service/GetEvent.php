<?php
	class getEvent {
	//Funktion, um ein bestimmtes Event aufzurufen
		public function execute($request) {
			if (isset($request["id"]) == FALSE) {								//Prüfung, ob die URL eine ID enthält; Anonsten wird ein Statuscode 400 ausgegeben
				header("HTTP/1.1 400");											
				return;
			}
			$id = $request["id"];												//ID aus dem Link in Variable übergeben
			$event_service = new EventService();								//Objekt der Klasse EventService erstellen
			$event = $event_service->readEvent($id);							//Methode readEvent aufrufen und Rückgabewert in Variable speichern
			if ($event == EventService::NOT_FOUND) {
				header("HTTP/1.1 404");
			return;
			}
			unset($event->id);													//Die ID aus der Übergabe löschen, da irrelevant für Benutzer
//			header("Etag: $event->version");
//			unset($event->version);												
			return $event;
		}	
	}
?>