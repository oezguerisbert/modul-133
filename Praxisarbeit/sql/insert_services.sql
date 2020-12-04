INSERT INTO `kxi_services`(`kuerzel`, `title`, `price`, `description`)
    VALUES
    ("klein", "Kleiner Service", 50.00, "Unser kleiner Service beinhaltet die einfachen Einstellungen"),
    ("gross", "Grosser Service", 70.00, "Unser grosser Service beinhaltet alle Einstellungen"),
    ("rennski", "Rennski-Service", 150.00, "Das Komplettpacket"),
    ("montage", "Bindung montieren und einstellen", 20.00, "Eine sehr gute Montage des Equipments"),
    ("fell", "Fell zuschneiden", 15.00, "Das zuschneiden des Fells für das perfekte Feeling"),
    ("wachs", "Heisswachsen", 15.00, "Mit hochprofessionellem Wachs wird ihr Equipment versorgt")
    ;

INSERT INTO `kxi_priorities`(`kuerzel`, `title`, `days`)
    VALUES
    ("standart", "Standart", 7),
    ("tief", "Standart", 12),
    ("express", "Standart", 5);
INSERT INTO `users`(`username`, `vorname`, `nachname`, `email`, `phone`, `password`, `usertype`)
	VALUES
	("oezguer_isbert", "Oezguer", "Isbert", "oezguer.isbert@student.ibz.ch", "000012312", "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918", "admin");