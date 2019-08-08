create or replace PROCEDURE ELIMINAR_TRABAJADOR(
v_OIDTrabajador IN trabajadores.oidtrabajador%TYPE)
 IS 
BEGIN
    DELETE FROM Trabajadores WHERE oidtrabajador = v_oidtrabajador;
    COMMIT;
END ELIMINAR_TRABAJADOR;