create or replace PROCEDURE ALTA_HISTORIAL(
    IDPaciente          IN       Historiales.IDPaciente%TYPE
    )IS
    BEGIN
    INSERT INTO Historiales VALUES(0,IDPaciente);
  COMMIT WORK;
  END ALTA_HISTORIAL;