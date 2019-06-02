create or replace PROCEDURE ALTA_CONSULTA(
    OIDVeterinario     IN Consultas.OIDVeterinario%TYPE,
    OIDCita            IN Citas.OIDCita%TYPE
    )IS
    BEGIN
    INSERT INTO Consultas VALUES(0,OIDVeterinario,OIDCita);
  COMMIT WORK;
END ALTA_CONSULTA;
