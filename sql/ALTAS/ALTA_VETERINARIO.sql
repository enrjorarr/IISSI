create or replace PROCEDURE ALTA_VETERINARIO(
   OIDTrabajador in Veterinarios.OIDTrabajador%TYPE
    )IS  
BEGIN
    INSERT INTO Veterinarios VALUES(0,OIDTrabajador);
  COMMIT WORK;
END ALTA_VETERINARIO;
