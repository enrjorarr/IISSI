create or replace PROCEDURE ELIMINAR_VETERINARIO(
v_OIDTrabajador IN veterinarios.oidtrabajador%TYPE)
 IS 
BEGIN
    DELETE FROM VETERINARIOS WHERE oidtrabajador = v_oidtrabajador;
    DELETE FROM Trabajadores WHERE oidtrabajador = v_oidtrabajador;
    COMMIT;
END ELIMINAR_VETERINARIO;