create or replace PROCEDURE ELIMINAR_CLIENTE_POR_DNI(v_Dni IN Clientes.Dni%TYPE)
IS
BEGIN
    DELETE FROM Clientes WHERE Dni = v_Dni;
    COMMIT;
END ELIMINAR_CLIENTE_POR_DNI;
/
create or replace PROCEDURE ELIMINAR_CONSULTA_POR_CITA (v_OIDCitas IN Citas.OIDCita%TYPE)
IS
BEGIN
    DELETE FROM Consultas WHERE OIDCita = v_OIDCitas;
    DELETE FROM CITAS WHERE OIDCita = v_OIDCitas;

    COMMIT;
END ELIMINAR_CONSULTA_POR_CITA;
/
create or replace PROCEDURE ELIMINAR_GESTOR(
v_OIDTrabajador IN veterinarios.oidtrabajador%TYPE)
 IS 
BEGIN
DELETE FROM Gestores WHERE oidtrabajador = v_oidtrabajador;
DELETE FROM Trabajadores WHERE oidtrabajador = v_oidtrabajador;

    COMMIT;
END ELIMINAR_GESTOR;
/
create or replace PROCEDURE ELIMINAR_PELUQUERIA_POR_CITA (v_OIDCitas IN Citas.OIDCita%TYPE)
IS
BEGIN
    DELETE FROM Peluquerias WHERE OIDCita = v_OIDCitas;
    DELETE FROM citas WHERE OIDCita = v_OIDCitas;

    COMMIT;
END ELIMINAR_PELUQUERIA_POR_CITA;
/
create or replace PROCEDURE ELIMINAR_PELUQUERO(
v_OIDTrabajador IN PELUQUEROS.oidtrabajador%TYPE)
 IS 
BEGIN
DELETE FROM PELUQUEROS WHERE oidtrabajador = v_oidtrabajador;
DELETE FROM Trabajadores WHERE oidtrabajador = v_oidtrabajador;

    COMMIT;
END ELIMINAR_PELUQUERO;
/
create or replace PROCEDURE ELIMINAR_VETERINARIO(
v_OIDTrabajador IN veterinarios.oidtrabajador%TYPE)
 IS 
BEGIN
    DELETE FROM VETERINARIOS WHERE oidtrabajador = v_oidtrabajador;
    DELETE FROM Trabajadores WHERE oidtrabajador = v_oidtrabajador;
    COMMIT;
END ELIMINAR_VETERINARIO;
/