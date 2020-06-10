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