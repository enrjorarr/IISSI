
DROP TABLE Peluquerias;

DROP TABLE Consultas;

DROP TABLE Citas;

DROP TABLE Veterinarios;

DROP TABLE Peluqueros;

DROP TABLE Gestores;

DROP TABLE Trabajadores;

DROP TABLE Informes;

DROP TABLE Historiales;

DROP TABLE PeticionCitas;

DROP TABLE Pacientes;

DROP TABLE Clientes;





CREATE TABLE Clientes (
    Dni                   CHAR(9)          NOT NULL,
    FechaNac              DATE             NOT NULL,         
    NumeroTelefono        CHAR(9),
    Pass                  VARCHAR2(30)     NOT NULL,
    Direccion             VARCHAR2(50)     NOT NULL,
    Email                 VARCHAR2(50)     NOT NULL UNIQUE,
    Nombre                VARCHAR2(50)     NOT NULL,
    Apellidos             VARCHAR2(50),

    PRIMARY KEY(DNI),
    CONSTRAINT COMPROBAR_DNI CHECK (REGEXP_LIKE(Dni, '[0-9]{8}[A-Z]')),
    CONSTRAINT COMPROBAR_NumeroTelefono CHECK (REGEXP_LIKE(NumeroTelefono, '[0-9]{9}')),
	UNIQUE(NumeroTelefono,Email)
);	
            
CREATE TABLE Pacientes(          
    IDPaciente            CHAR(9)            NOT NULL,
    FechaNac              DATE               NOT NULL,
    ColorPelo             VARCHAR2(50)         NOT NULL,
    Raza                  VARCHAR2(50)        NOT NULL,
    Especie               VARCHAR2(50),
    Dni                   CHAR(9),

    CONSTRAINT COMPROBAR_IDPACIENTE CHECK (REGEXP_LIKE(IDPaciente, '[0-9]{9}')),
    PRIMARY KEY(IDPaciente),
    FOREIGN KEY(Dni)    REFERENCES     Clientes 
);
                       
CREATE TABLE Historiales(
    OIDHistorial          SMALLINT,
    IDPaciente            CHAR(9),

    CONSTRAINT COMPROBAR_IDPACIENTE2 CHECK (REGEXP_LIKE(IDPaciente, '[0-9]{5}')),
    PRIMARY KEY(OIDHistorial),
    FOREIGN KEY(IDPaciente)    REFERENCES    Pacientes 
);
            
CREATE TABLE Informes (
    OIDInforme              SMALLINT,
    FechaConsulta           DATE,
    MotivoConsulta          VARCHAR2(100),
    Tratamiento             VARCHAR2(100),
    OIDHistorial          SMALLINT,

    PRIMARY KEY(OIDInforme),
    FOREIGN KEY(OIDHistorial) REFERENCES Historiales
);


CREATE TABLE Trabajadores (
    NumeroTelefono        CHAR(9),
    Pass       VARCHAR2(30) NOT NULL,
    FechaNac        DATE        NOT NULL,
    Nombre          VARCHAR2(50) NOT NULL,
    Apellidos       VARCHAR2(50) NOT NULL,
    Direccion       VARCHAR2(50),
    Email           Varchar2(50) NOT NULL UNIQUE,
    HorasTrabajo    VARCHAR2(50),
    Sueldo          NUMBER(12,2) NOT NULL,
    EsGestor        CHAR(1),    
    DNI             CHAR(9)     NOT NULL,
    OIDTrabajador   SMALLINT    NOT NULL,

    CONSTRAINT COMPROBAR_DNI3 CHECK (REGEXP_LIKE(DNI, '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z]')),
    UNIQUE (Apellidos, Nombre),
    PRIMARY KEY (OIDTrabajador)
);

CREATE TABLE Gestores (
    OIDGestor       SMALLINT    NOT NULL,
    OIDTrabajador   SMALLINT    NOT NULL,

    FOREIGN KEY (OIDTrabajador)  REFERENCES Trabajadores,
    PRIMARY KEY (OIDGestor)
);

CREATE TABLE Peluqueros (
    OIDPeluquero    SMALLINT    NOT NULL,
    OIDTrabajador   SMALLINT    NOT NULL,

    PRIMARY KEY (OIDPeluquero),
    FOREIGN KEY (OIDTrabajador)  REFERENCES Trabajadores
);

CREATE TABLE Veterinarios (
    OIDVeterinario  SMALLINT    NOT NULL,
    OIDTrabajador   SMALLINT    NOT NULL,

    PRIMARY KEY (OIDVeterinario),
    FOREIGN KEY (OIDTrabajador)  REFERENCES Trabajadores
);


   
    
CREATE TABLE PeticionCitas (
    OIDPetCita SMALLINT NOT NULL,
    Dni  CHAR(9) NOT NULL,
    Motivo Varchar(50),
    FechaInicio DATE NOT NULL,
    IDPaciente CHAR(9),
    TipoCita Varchar2(10),

    PRIMARY KEY (OIDPetCita),
    FOREIGN KEY (Dni) REFERENCES Clientes,
    FOREIGN KEY (IDPaciente) REFERENCES Pacientes
);

CREATE TABLE Citas (
    OIDCita SMALLINT NOT NULL,
    Dni  CHAR(9) NOT NULL,
    OIDGestor SMALLINT NOT NULL,
    FechaInicio DATE NOT NULL,
    HoraInicio Varchar2(5) NOT NULL,
    DuracionMin NUMBER(4) NOT NULL,
    Coste NUMBER(4,2) NOT NULL,

    PRIMARY KEY (OIDCita),
    FOREIGN KEY (Dni) REFERENCES Clientes,
    FOREIGN KEY (OIDGestor) REFERENCES Gestores,
    CONSTRAINT ComprobarCoste CHECK(Coste>0)
    );
    
CREATE TABLE Consultas(
    OIDConsulta                  SMALLINT NOT NULL,
    OIDVeterinario               SMALLINT NOT NULL,
    OIDCita                      SMALLINT,
            
    PRIMARY KEY (OIDConsulta),
    FOREIGN KEY (OIDCita) REFERENCES Citas,
    FOREIGN KEY (OIDVeterinario) REFERENCES Veterinarios
    );
  
CREATE TABLE Peluquerias(
    OIDPeluqueria            SMALLINT NOT NULL,
    OIDPeluquero            SMALLINT NOT NULL,
    OIDCita                  SMALLINT,

    PRIMARY KEY (OIDPeluqueria),
    FOREIGN KEY (OIDPeluquero) REFERENCES Peluqueros,
    FOREIGN KEY (OIDCita) REFERENCES Citas
    );