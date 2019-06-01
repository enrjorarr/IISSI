create or replace PROCEDURE ALTA_PELUQUERIA(
    OIDPeluquero IN peluquerias.oidpeluquero%TYPE,
    OIDCita IN peluquerias.oidcita%TYPE
   
    )IS
    BEGIN
    INSERT INTO Peluquerias VALUES(0,OIDPeluquero,OIDCita);
  COMMIT WORK;
END ALTA_PELUQUERIA;
