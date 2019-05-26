create or replace PROCEDURE ALTA_TRABAJADOR(
    Dni             IN Trabajadores.Dni%TYPE,
    FechaNac        IN Trabajadores.FechaNac%TYPE,
    Sueldo          IN Trabajadores.Sueldo%TYPE,
    Pass            IN Trabajadores.Pass%TYPE,
    Direccion       IN Trabajadores.Direccion%TYPE,
    NumeroTelefono  IN Trabajadores.NumeroTelefono%TYPE,
    Email           IN Trabajadores.Email%TYPE,
    Nombre          IN Trabajadores.Nombre%TYPE,
    Apellidos       IN Trabajadores.Apellidos%TYPE,
    EsGestor        IN Trabajadores.EsGestor%TYPE,
    HorasTrabajo    IN Trabajadores.HorasTrabajo%TYPE
    )IS  
BEGIN
    INSERT INTO Trabajadores VALUES(FechaNac,Nombre,Apellidos,Pass,Direccion,NumeroTelefono,Email,HorasTrabajo,Sueldo,EsGestor,Dni,1);
  COMMIT WORK;
END ALTA_TRABAJADOR;
/