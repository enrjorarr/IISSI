
DROP SEQUENCE SEC_HISTORIALES;
DROP SEQUENCE SEC_INFORMES;
DROP SEQUENCE SEC_TRABAJADORES;
DROP SEQUENCE SEC_GESTORES;
DROP SEQUENCE SEC_PELUQUEROS;
DROP SEQUENCE SEC_VETERINARIOS;
DROP SEQUENCE SEC_CITAS;
DROP SEQUENCE SEC_CONSULTAS;
DROP SEQUENCE SEC_PELUQUERIAS;
DROP SEQUENCE SEC_PETICIONCITAS;


CREATE SEQUENCE SEC_HISTORIALES;
CREATE SEQUENCE SEC_INFORMES;
CREATE SEQUENCE SEC_TRABAJADORES;
CREATE SEQUENCE SEC_GESTORES;
CREATE SEQUENCE SEC_PELUQUEROS;
CREATE SEQUENCE SEC_VETERINARIOS;
CREATE SEQUENCE SEC_CITAS;
CREATE SEQUENCE SEC_CONSULTAS;
CREATE SEQUENCE SEC_PELUQUERIAS;
CREATE SEQUENCE SEC_PETICIONCITAS;



--2
CREATE OR REPLACE TRIGGER crea_oid_historial
BEFORE INSERT ON historiales
FOR EACH ROW
BEGIN 
    SELECT SEC_HISTORIALES.NEXTVAL INTO :NEW.OIDHistorial FROM DUAL;
END;

--3
CREATE OR REPLACE TRIGGER crea_oid_informe
BEFORE INSERT ON informes
FOR EACH ROW
BEGIN 
    SELECT SEC_INFORMES.NEXTVAL INTO :NEW.OIDInforme FROM DUAL;
END;

--4

CREATE OR REPLACE TRIGGER crea_oid_trabajador
BEFORE INSERT ON trabajadores
FOR EACH ROW
BEGIN 
    SELECT SEC_TRABAJADORES.NEXTVAL INTO :NEW.OIDTrabajador FROM DUAL;
END;

--5
CREATE OR REPLACE TRIGGER crea_oid_gestor
BEFORE INSERT ON gestores
FOR EACH ROW
BEGIN 
    SELECT SEC_GESTORES.NEXTVAL INTO :NEW.OIDGestor FROM DUAL;
END;

--7
CREATE OR REPLACE TRIGGER crea_oid_peluquero
BEFORE INSERT ON peluqueros
FOR EACH ROW
BEGIN 
    SELECT SEC_PELUQUEROS.NEXTVAL INTO :NEW.OIDPeluquero FROM DUAL;
END;
--8
CREATE OR REPLACE TRIGGER crea_oid_veterinario
BEFORE INSERT ON veterinarios
FOR EACH ROW
BEGIN 
    SELECT SEC_VETERINARIOS.NEXTVAL INTO :NEW.OIDVeterinario FROM DUAL;
END;

--9
CREATE OR REPLACE TRIGGER crea_oid_cita
BEFORE INSERT ON citas
FOR EACH ROW
BEGIN 
    SELECT SEC_CITAS.NEXTVAL INTO :NEW.OIDCita FROM DUAL;
END;

--10
CREATE OR REPLACE TRIGGER crea_oid_consultas
BEFORE INSERT ON consultas
FOR EACH ROW
BEGIN 
    SELECT SEC_CONSULTAS.NEXTVAL INTO :NEW.OIDConsulta FROM DUAL;
END;

--11
CREATE OR REPLACE TRIGGER crea_oid_peluqueria
BEFORE INSERT ON peluquerias
FOR EACH ROW
BEGIN 
    SELECT SEC_PELUQUERIAS.NEXTVAL INTO :NEW.OIDPeluqueria FROM DUAL;
END;
--12
CREATE OR REPLACE TRIGGER crea_oid_petcita
BEFORE INSERT ON peticioncitas
FOR EACH ROW
BEGIN
    SELECT SEC_PETICIONCITAS.NEXTVAL INTO :NEW.OIDPetCita FROM DUAL;
END;
