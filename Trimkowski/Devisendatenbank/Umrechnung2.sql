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