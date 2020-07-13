CREATE TRIGGER trigger1 before update on devisen
for each row
IF (new.devise not in (Select devise from project.devisen))
then
Insert Into devisen (devise, wert) values (new.devise, new.wert),
END IF;
COMMIT