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