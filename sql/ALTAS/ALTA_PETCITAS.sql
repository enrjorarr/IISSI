create or replace PROCEDURE ALTA_PETCITA(
    Dni  IN PeticionCitas.Dni%TYPE,
    Motivo IN PeticionCitas.Motivo%TYPE,
    FechaInicio IN PeticionCitas.FechaInicio%TYPE,
    IDPaciente IN PeticionCitas.IDPaciente%TYPE,
    TipoCita IN PeticionCitas.TipoCita%TYPE
    )IS
    BEGIN
    INSERT INTO PeticionCitas VALUES(0,Dni,Motivo,FechaInicio, IDPaciente,TipoCita);
  COMMIT WORK;
END ALTA_PETCITA;