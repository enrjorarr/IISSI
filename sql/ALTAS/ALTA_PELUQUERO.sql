create or replace PROCEDURE ALTA_PELUQUERO(
    OIDTrabajador   IN trabajadores.Oidtrabajador%TYPE
   
    )IS  
BEGIN
    INSERT INTO Peluqueros VALUES(0,OIDTrabajador);
  COMMIT WORK;
END ALTA_PELUQUERO;