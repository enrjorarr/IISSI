create or replace PROCEDURE ALTA_GESTOR(
  OIDTrabajador IN Gestores.OIDTrabajador%TYPE
    )IS  
BEGIN
    INSERT INTO Gestores VALUES(0,OIDTrabajador);
  COMMIT WORK;
END ALTA_GESTOR;
