create or replace PROCEDURE ELIMINAR_GESTOR(
v_OIDTrabajador IN trabajadores.oidtrabajador%TYPE)
 IS 
BEGIN
DELETE FROM Gestores WHERE oidtrabajador = v_oidtrabajador;
DELETE FROM Trabajadores WHERE oidtrabajador = v_oidtrabajador;

    COMMIT;
END ELIMINAR_GESTOR;
