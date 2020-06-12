# Datenbank Projekt für IN-19

# Fragen und Antworten:

## 1. Falls noch nicht geschehen, installiere ein SQL-System Deiner Wahl., z.B.kostenlos:a.Firebird mit Flamerobin,b.MS SQL Server Express mit Server Management Studio,c.MySql mit Workbench
    
Ich habe einen MySQL Server auf einer virtuellen Maschine eingerichtet. Für die Anwendung habe
ich anschließend einen PHPUser angelegt. Dieser hat sämtliche Rechte auf den Server, da ich diesen
Server ausschließlich für diese Anwendung nutze. Die Anwenderoberfläche läuft auf einen seperaten 
Apache Webserver mit PHP. 


## 2. Suche im Internet eine Seite mit aktuellen Devisenkursen, z.B. https://www.comdirect.de/inf/maerkte/waehrungen.html
    
Die Devisen API ist https://exchangeratesapi.io <br>
Diese habe ich ausgewählt, da Kollegen die bereits nutzen.<br>
Granularität: Täglich


## 3. Erstelle eine Datenbank mit einer Devisentabelle
    
Ich habe eine Tabelle für alle Devisen angelegt. Da sind die Abkürzungen, wie z.B. USD 
für US Dollar, und die dazugehörigen Dezimalwerte hinterlegt. Die einzelnen Werte sind bis auf 
einige Nachkommastellen genau.<br> [create_Database.sql](https://github.com/prodenbu/IN-19/blob/master/Trimkowski/create_Database.sql)
```sql
CREATE DATABASE `project` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION=\'N\' */
CREATE TABLE `devisen` (\n  `Devise` varchar(3) DEFAULT NULL,\n  `Wert` double DEFAULT NULL\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
```
    


## 4. ETLImportieredie Daten. Nutze SQL INSERToder ein Tool Deiner Wahl.
    
Mit einen PHP Skript habe ich die Daten aus der API in die Datenbank eingepflegt(siehe getdata.php).
Mit einem weiteren Skript ([gethistoricaldata.php](https://github.com/prodenbu/IN-19/blob/master/Trimkowski/getHistoricaldata.php)) habe ich mir die Daten von den vergangenen 20 Jahren, seit Anfang 2000, geholt und in die Tabelle getHistory
eingetragen.Dieser Prozess hat ca. 20 -25 Minuten gedauert. 
Da die Basis bei der Datenbank Euro ist, habe ich noch manuell eine Euro Devise hinzugefügt, die 
den Wert 1 hat. Ich musste anschließend die Prozedur Umrechnung2 darauf anpassen, da ich nicht für 
jeden Tag einen
Euro wert hinzugefügt habe.  



## 5. Die Kurse ändern sich andauernd. Wie kann man die Tabelle aktuell halten? Nutze SQL UPDATEoder ein Tool Deiner Wahl.
    
Das [getdata.php](https://github.com/prodenbu/IN-19/blob/master/Trimkowski/getdata.php) Skript habe ich als Cronjob auf dem Webserver eingerichtet. Es wird an jeden Werktag um 16:05 Uhr ausgeführt, da die API jeden Werktag um 16:00 Uhr neue Werte erhält.<br> Für die Historische Tabelle habe ich auch ein [PHP Script ](https://github.com/prodenbu/IN-19/blob/master/Trimkowski/gethistory.php) als Cronjob eingerichtet, das lediglich eine andere Tabelle wählt und die Daten einfügt und nicht Updatet. Außerdem fügt es auch ein Datumswert mit ein. 


## 6. Erstelle ein SQL SELECT Statement, dasbeliebige Beträge von einer Währung in eine andere umrechnet.
```sql
CREATE DEFINER=`newphp`@`%` PROCEDURE `Umrechnung`(wert1 varchar(45), wert2 varchar(45), menge double)
BEGIN

DECLARE devise1 double;
DECLARE devise2 double;
DECLARE ze double;
DECLARE ergebniss double;
   
SELECT Wert FROM `project`.devisen WHERE devise = wert1 INTO devise1;
SELECT Wert FROM `project`.devisen WHERE devise = wert2 INTO devise2;
 
SELECT menge/devise1 INTO ze;
SELECT ze * devise2 INTO ergebniss;
 
SELECT ergebniss;
END
```
Siehe [Umrechnung.sql](https://github.com/prodenbu/IN-19/blob/master/Trimkowski/Umrechnung.sql)


## 7. Wie kann man die Kurse historisieren, also auch die Kurse vergangener Daten behalten?
    
Ich habe dafür eine Tabelle erstellt, wo ich alle Daten für jeden Tag einfüge. Nachdem 
ich mir die Daten seit 2000 geholt habe, hat diese Tabelle ~165.000 Einträge. Außerdem 
sorgt ein Cronjob dafür, dass Täglich die neuen Daten eingefügt werden.
Ursprünglich wollte ich für jede Devise eine eigene Tabelle erstellen, konnte in der 
Prozedur aber keine Variablen Tabellennamen einfügen. 


## 8. Erstelle nach 7. ein SQL SELECTStatement, dasbeliebige Beträge von einer Währung in eine andere umrechnet. Dabei soll immer der aktuelle Kurs verwendet werden.
```sql
CREATE DEFINER=`newphp`@`%` PROCEDURE `Umrechnung`(wert1 varchar(45), wert2 varchar(45), menge double)
BEGIN

DECLARE devise1 double;
DECLARE devise2 double;
DECLARE ze double;
DECLARE ergebniss double;
   
SELECT Wert FROM `project`.devisen WHERE devise = wert1 INTO devise1;
SELECT Wert FROM `project`.devisen WHERE devise = wert2 INTO devise2;
 
SELECT menge/devise1 INTO ze;
SELECT ze * devise2 INTO ergebniss;
 
SELECT ergebniss;
END
```
Siehe [Umrechnung.sql](https://github.com/prodenbu/IN-19/blob/master/Trimkowski/Umrechnung.sql)


## 9. Erstelle nach 7. ein SQL SELECTStatement, dasbeliebige Beträge von einer Währung in eine andere umrechnet. Dabei soll immer der Kurszu einem beliebigen Datumverwendet werden.

```sql
CREATE DEFINER=`newphp`@`%` PROCEDURE `Umrechnung2`(datumSelected date, wert1 varchar(3), wert2 varchar(3), menge double)
BEGIN
DECLARE datumSelected1 date;
DECLARE datumSelected2 date;
DECLARE devise1 double;
DECLARE devise2 double;
DECLARE ze double;
DECLARE ergebniss double;


IF wert1 = 'EUR' THEN
	SET datumSelected1 = '2020-06-08';
else 
	Set datumSelected1 = datumSelected;
END IF;
IF wert2 = 'EUR' THEN
	SET datumSelected2 = '2020-06-08';
else 
	Set datumSelected2 = datumSelected;
END IF;

SELECT Wert FROM `project`.getHistory WHERE Datum= datumSelected1 AND devise = wert1 INTO devise1;
SELECT Wert FROM `project`.getHistory WHERE Datum= datumSelected2 AND devise = wert2 INTO devise2;
 
SELECT menge/devise1 INTO ze;
SELECT ze * devise2 INTO ergebniss;
 
SELECT ergebniss;
END
```  
Siehe [Umrechnung2.sql](https://github.com/prodenbu/IN-19/blob/master/Trimkowski/Umrechnung2.sql)


## 10. Zur Aktualisierung der Kurse: welche Zeitgranularitäten (Tage/Stunden/Minuten/...) könnten verwendet werden? Wie wirkt sich die auf die Datentypen der Tabelleund auf die Selects der Aufgaben 6/8/9aus?

In meiner Lösung ist nur eine Tägliche aktualisierung möglich, da die API nicht öfter aktualisiert wird. Würde man mehrmals täglich neue Daten einfügen, müsste anstatt von dem Typen 'DATE', 'DATETIME' verwendete werden. Außerdem muss entweder eine feste Zeit für die vergangenen Tage festgelegt werden, oder der Nutzer muss auch diese auswählen können. Es stellt sich dann auch die Frage, ob mein bei Historischen Werten, die Uhrzeit bestimmen muss, oder ob das zu genau ist. 


## 11. Wenn Du MS SQL Server Express gewählt hast, implementieredie Historisierung der Daten durch eine „temporale Tabelle“(https://docs.microsoft.com/de-de/sql/relational-databases/tables/temporal-table-usage-scenarios?view=sql-server-ver15).

Ich habe MySQL verwendet :/


## 12. Erstelle eine Dokumentation für Dein Projekt. 

https://github.com/prodenbu/IN-19/tree/master/Trimkowski


## Probleme und Lösungen:
Ich bin auf einige Probleme gestoßen:
<br><br>
1. Ich habe in der History Anwendung die Devisennamen aus der devisen Tabelle genommen, was problematisch wurde. 
Da es aktuell verschiedene Devisen gibt, die es früher nicht gab, musste ich die Devisennamen aus der getHistory Tabelle importieren. Daraus folgt das Problem, dass ich nicht einfach den Tabellennamen in der Abfrage ändern kann. Hätte ich das gemacht, würden alle 165.000 in die Dropdown Liste eingtragen werden. Ich habe die ganze Struktur der Anwendung so verändert, dass man nun erst ein Datum auswählen muss und dann erst die Dropdown Liste erstellt wird. So kann ich sicherstellen, dass alle zu der Zeit verfügbaren Währungen in die Liste kommen. 
<br><br>
2. Da die API keine Werte für Samstage und Sonntage hat, kann man mit meiner Anwendung an diesen Daten keine Währungen umrechnen. Ich habe eine Fehlermeldung für diesen Fall angelegt. Daten die in der Zukunft liegen erhalten die selbe Fehlermeldung.
<br><br>
3. Ich habe am 11.06. die Historie anwendung funktionsunfähig gemacht und musste diese aus einem Backup wieder richten. Ich war dabei Fehleingaben zu vermeiden. Nun kommen passende Fehlermeldungen zu den passenden Zeitpunkten. 

# Bilder
## Aktuelle Werte umrechnen
![Schade:C Dann nicht](https://raw.githubusercontent.com/prodenbu/IN-19/master/Trimkowski/Bilder/Aktuelle_Kurse.png)<br>
## Historische Werte umrechen 
![Schade :C Dann nicht](https://raw.githubusercontent.com/prodenbu/IN-19/master/Trimkowski/Bilder/Historisch1.png)<br>
![Schade :C Dann nicht](https://raw.githubusercontent.com/prodenbu/IN-19/master/Trimkowski/Bilder/Historisch2.png)

## Ergebnis
![Schade :C Dann nicht](https://raw.githubusercontent.com/prodenbu/IN-19/master/Trimkowski/Bilder/Ergebniss.png)