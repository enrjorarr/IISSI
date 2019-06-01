create or replace PROCEDURE ALTA_CITA(
    
    OIDGestor IN CitaS.OIDGestor%TYPE,
    Dni  IN CitaS.Dni%TYPE,
    FechaInicio IN CitaS.FechaInicio%TYPE,
    FechaFin IN CitaS.FechaFin%TYPE,
    DuracionMin IN CitaS.DuracionMin%TYPE,
    Coste IN CitaS.Coste%TYPE
    )IS
    BEGIN
    INSERT INTO Citas VALUES(0,Dni, OIDGestor,FechaInicio, FechaFin, DuracionMin,Coste);
  COMMIT WORK;
END ALTA_CITA;
/

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
/

create or replace PROCEDURE ALTA_GESTOR(
  OIDTrabajador IN Gestores.OIDTrabajador%TYPE
    )IS  
BEGIN
    INSERT INTO Gestores VALUES(0,OIDTrabajador);
  COMMIT WORK;
END ALTA_GESTOR;
/
create or replace PROCEDURE ALTA_HISTORIAL(
    IDPaciente          IN       Historiales.IDPaciente%TYPE
    )IS
    BEGIN
    INSERT INTO Historiales VALUES(0,IDPaciente);
  COMMIT WORK;
  END ALTA_HISTORIAL;
  /

create or replace PROCEDURE ALTA_PACIENTE(
    IDPaciente  IN      Pacientes.IDPaciente%TYPE,
    FechaNac    IN      Pacientes.FechaNac%TYPE,
    ColorPelo   IN      Pacientes.ColorPelo%TYPE,
    Raza        IN      Pacientes.Raza%TYPE,
    Especie     IN      Pacientes.Especie%TYPE,
    Dni         IN      Pacientes.Dni%TYPE
    )IS  
BEGIN
    INSERT INTO Pacientes VALUES(IDPaciente,FechaNac,ColorPelo,Raza,Especie,Dni);
  COMMIT WORK;
END ALTA_PACIENTE;
/
create or replace PROCEDURE ALTA_PELUQUERIA(
    OIDPeluquero IN peluquerias.oidpeluquero%TYPE,
    OIDCita IN peluquerias.oidcita%TYPE
   
    )IS
    BEGIN
    INSERT INTO Peluquerias VALUES(0,OIDPeluquero,OIDCita);
  COMMIT WORK;
END ALTA_PELUQUERIA;
/
create or replace PROCEDURE ALTA_PELUQUERO(
    OIDTrabajador   IN trabajadores.Oidtrabajador%TYPE
   
    )IS  
BEGIN
    INSERT INTO Peluqueros VALUES(0,OIDTrabajador);
  COMMIT WORK;
END ALTA_PELUQUERO;
/
create or replace PROCEDURE ALTA_PETCITA(
    Dni  IN PeticionCitas.Dni%TYPE,
    Motivo IN PeticionCitas.Motivo%TYPE,
    FechaInicio IN PeticionCitas.FechaInicio%TYPE,
    IDPaciente IN PeticionCitas.IDPaciente%TYPE
    )IS
    BEGIN
    INSERT INTO PeticionCitas VALUES(0,Dni,Motivo,FechaInicio, IDPaciente);
  COMMIT WORK;
END ALTA_PETCITA;
/
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
    INSERT INTO Trabajadores VALUES(NUMEROTELEFONO,PASS,FECHANAC,NOMBRE,APELLIDOS,DIRECCION,Email,HORASTRABAJO,Sueldo,EsGestor,Dni,1);
  COMMIT WORK;
END ALTA_TRABAJADOR;
/
create or replace PROCEDURE ALTA_VETERINARIO(
   OIDTrabajador in Veterinarios.OIDTrabajador%TYPE
    )IS  
BEGIN
    INSERT INTO Veterinarios VALUES(0,OIDTrabajador);
  COMMIT WORK;
END ALTA_VETERINARIO;
/
create or replace PROCEDURE ALTA_CONSULTA(
    OIDVeterinario     IN Consultas.OIDVeterinario%TYPE,
    OIDCita            IN Citas.OIDCita%TYPE
    )IS
    BEGIN
    INSERT INTO Consultas VALUES(0,OIDVeterinario,OIDCita);
  COMMIT WORK;
END ALTA_CONSULTA;
/