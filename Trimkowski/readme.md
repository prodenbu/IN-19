Datenbank Projekt für IN-19

Fragen und Antworten:

1.Falls noch nicht geschehen, installiere ein SQL-System Deiner Wahl., z.B.kostenlos:a.Firebird mit Flamerobin,b.MS SQL Server Express mit Server Management Studio,c.MySql mit Workbench
    MySQL Server auf einer virtuellen Maschine eingerichtet. Für die Anwendung habe ich anschließend ein PHPUser angelegt. Dieser hat sämtliche Rechte auf den Server, da ich diesen Server
    ausschließlich für diese Anwendung nutze. 



2.Suche im Internet eine Seite mit aktuellen Devisenkursen, z.B. https://www.comdirect.de/inf/maerkte/waehrungen.html
    Die Devisen API ist https://exchangeratesapi.io 
    Diese habe ich ausgewählt, da Kollegen die bereits nutzen. So sind nachfragen leichter. 



3.Erstelle eine Datenbank mit einer Devisentabelle
    Ich habe eine Tabelle für alle Devisen angelegt. Da sind die Abkürzungen, wie z.B. USD für US Dollar, und die dazugehörigen Dezimalwerte hinterlegt. Die einzelnen Werte sind bis auf einige Nachkommastellen
    genau.  




4.ETLImportieredie Daten. Nutze SQL INSERToder ein Tool Deiner Wahl.
    Mit einen PHP Skript habe ich die Daten aus der API in die Datenbank eingepflegt(siehe getdata.php).




5.Die Kurse ändern sich andauernd. Wie kann man die Tabelle aktuell halten? Nutze SQL UPDATEoder ein Tool Deiner Wahl.
    Das getdata Skript habe ich als Cronjob auf den Webserver eingerichtet. Es wird täglich um 16:05 Uhr ausgeführt, da die API jeden Werktag um 16:00 Uhr neue Werte erhält.

6.Erstelle ein SQL SELECTStatement, dasbeliebige Beträge von einer Währung in eine andere umrechnet.
    
