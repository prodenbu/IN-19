Datenbank Projekt für IN-19

Fragen und Antworten:

1.Falls noch nicht geschehen, installiere ein SQL-System Deiner Wahl., z.B.kostenlos:a.Firebird mit Flamerobin,b.MS SQL Server Express mit Server Management Studio,c.MySql mit Workbench
    
    Ich habe einen MySQL Server auf einer virtuellen Maschine eingerichtet. Für die Anwendung habe
     ich anschließend ein PHPUser angelegt. Dieser hat sämtliche Rechte auf den Server, da ich diesen
     Server ausschließlich für diese Anwendung nutze. Die Anwenderoberfläche läuft auf einen seperaten 
     Apache Webserver mit PHP. 


2.Suche im Internet eine Seite mit aktuellen Devisenkursen, z.B. https://www.comdirect.de/inf/maerkte/waehrungen.html
    
    Die Devisen API ist https://exchangeratesapi.io 
    Diese habe ich ausgewählt, da Kollegen die bereits nutzen.
    Granularität: Täglich


3.Erstelle eine Datenbank mit einer Devisentabelle
    
    Ich habe eine Tabelle für alle Devisen angelegt. Da sind die Abkürzungen, wie z.B. USD 
    für US Dollar, und die dazugehörigen Dezimalwerte hinterlegt. Die einzelnen Werte sind bis auf 
    einige Nachkommastellen genau.(createDatabase.sql)


4.ETLImportieredie Daten. Nutze SQL INSERToder ein Tool Deiner Wahl.
    
    Mit einen PHP Skript habe ich die Daten aus der API in die Datenbank eingepflegt(siehe getdata.php).
	Mit einem weiteren Skript(getHistoricaldata.php) habe ich mir die Daten von den vergangenen 20 Jahren,
     seit Anfang 2000, geholt und in die Tabelle getHistory eingetragen.Dieser Prozess hat ca. 20 -25 Minuten
    gedauert. 
    Da die Basis bei der Datenbank Euro ist, habe ich noch manuell eine Euro Devise hinzugefügt, die 
    den Wert 1 hat. Ich musste anschließend die Prozedur Umrechnung2 darauf anpassen, da ich nicht für jeden Tag einen
    Euro wert hinzugefügt habe.  


5.Die Kurse ändern sich andauernd. Wie kann man die Tabelle aktuell halten? Nutze SQL UPDATEoder ein Tool Deiner Wahl.
    
    Das getdata Skript habe ich als Cronjob auf den Webserver eingerichtet. Es wird täglich um 16:05 Uhr
    ausgeführt, da die API jeden Werktag um 16:00 Uhr neue Werte erhält.


6.Erstelle ein SQL SELECT Statement, dasbeliebige Beträge von einer Währung in eine andere umrechnet.
    
    Siehe Umrechnung.sql


7.Wie kann man die Kurse historisieren, also auch die Kurse vergangener Daten behalten?
    
    Ich habe dafür eine Tabelle erstellt, wo ich alle Daten für jeden Tag einfüge. Nachdem 
    ich mir die Daten seit 2000 geholt habe, hat diese Tabelle ~165.000 Einträge. Außerdem 
    sorgt ein Cronjob dafür, dass Täglich
    die neuen Daten eingefügt werden.
    Ursprünglich wollte ich für jede Devise eine eigene Tabelle erstellen, konnte in der 
    Prozedur aber keine Variablen Tabellennamen einfügen. 


8.Erstelle nach 7. ein SQL SELECTStatement, dasbeliebige Beträge von einer Währung in eine andere umrechnet. Dabei soll immer der aktuelle Kurs verwendet werden.
    
    Siehe Umrechnung.sql


9.Erstelle nach 7. ein SQL SELECTStatement, dasbeliebige Beträge von einer Währung in eine andere umrechnet. Dabei soll immer der Kurszu einem beliebigen Datumverwendet werden.
    
    Siehe Umrechnung2.sql


10.Zur Aktualisierung der Kurse: welche Zeitgranularitäten (Tage/Stunden/Minuten/...) könnten verwendet werden? Wie wirkt sich die auf die Datentypen der Tabelleund auf die Selects der Aufgaben 6/8/9aus?

    In meiner Lösung ist nur eine Tägliche aktualisierung möglich, da die API nicht öfter aktualisiert wird. 
    Würde man mehrmals täglich neue Daten einfügen, müsste anstatt von dem Typen 'DATE', 'DATETIME' verwendete
    werden. Außerdem muss entweder eine feste Zeit für die vergangenen Tage festgelegt werden, oder der Nutzer 
    muss auch diese auswählen können. Es stellt sich dann auch die Frage, ob mein bei Historischen Werten, 
    die Uhrzeit bestimmen muss, oder ob das zu genau ist. 


11.Wenn Du MS SQL Server Express gewählt hast, implementieredie Historisierung der Daten durch eine „temporale Tabelle“(https://docs.microsoft.com/de-de/sql/relational-databases/tables/temporal-table-usage-scenarios?view=sql-server-ver15).

    Ich habe MySQL verwendet :/


12.Erstelle eine Dokumentation für Dein Projekt. 

    https://github.com/prodenbu/IN-19/tree/master/Trimkowski