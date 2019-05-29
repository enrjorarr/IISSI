create or replace PROCEDURE ALTA_CLIENTE(
    Dni                  IN     Clientes.Dni%TYPE,
    FechaNac             IN     Clientes.FechaNac%TYPE,
    NumeroTelefono       IN     Clientes.NumeroTelefono%TYPE,
    Pass             IN     Clientes.Pass%TYPE,
    Direccion            IN     Clientes.Direccion%TYPE,
    Email                IN     Clientes.Email%TYPE,
    Nombre               IN     Clientes.Nombre%TYPE,
    Apellidos              IN     Clientes.Apellidos%TYPE
    )IS  
BEGIN
    INSERT INTO Clientes VALUES(Dni,FechaNac,NumeroTelefono,Pass,Direccion,Email,Nombre,Apellidos);
  COMMIT WORK;
END ALTA_CLIENTE;
