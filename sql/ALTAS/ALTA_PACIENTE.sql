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