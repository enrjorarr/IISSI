create or replace PROCEDURE ALTA_CITA(
    
    OIDGestor IN CitaS.OIDGestor%TYPE,
    Dni  IN CitaS.Dni%TYPE,
    FechaInicio IN CitaS.FechaInicio%TYPE,
    HoraInicio IN CitaS.HoraInicio%TYPE,
    DuracionMin IN CitaS.DuracionMin%TYPE,
    Coste IN CitaS.Coste%TYPE,
    OIDTrabajador IN CitaS.OIDTrabajador%TYPE,
    TipoCita IN CitaS.TipoCita%TYPE
    )IS
    BEGIN
    INSERT INTO CitaS VALUES(0,
    Dni,
    OIDGestor,
    
    FechaInicio,
    HoraInicio,
    DuracionMin,
    Coste,
    TipoCita,
    OIDTrabajador);
    
  COMMIT WORK;
END ALTA_CITA;

