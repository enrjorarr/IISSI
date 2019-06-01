create or replace PROCEDURE ELIMINAR_PELUQUERO(
v_OIDTrabajador IN PELUQUEROS.oidtrabajador%TYPE)
 IS 
BEGIN
DELETE FROM PELUQUEROS WHERE oidtrabajador = v_oidtrabajador;
DELETE FROM Trabajadores WHERE oidtrabajador = v_oidtrabajador;

    COMMIT;
END ELIMINAR_PELUQUERO;
