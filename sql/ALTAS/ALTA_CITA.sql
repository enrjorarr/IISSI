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

