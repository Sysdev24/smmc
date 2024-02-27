INSERT INTO scv_t_estatus(
siglas,
descripcion,
created_at,
updated_at)
VALUES (
'AC', 
'ACTIVO', 
CURRENT_TIMESTAMP, 
CURRENT_TIMESTAMP);

INSERT INTO scv_t_estatus( 
siglas,
descripcion,
created_at,
updated_at)
VALUES (
'IN', 
'INACTIVO', 
CURRENT_TIMESTAMP, 
CURRENT_TIMESTAMP);

INSERT INTO scv_t_estados( 
nombre,
id_status,
created_at,
updated_at)
VALUES (
'DISTRITO CAPITAL', 
1,
CURRENT_TIMESTAMP,
CURRENT_TIMESTAMP);

INSERT INTO scv_t_municipios(
nombre,
id_estado,
id_status,
created_at,
updated_at)
VALUES (
'DISTRITO CAPITAL', 
1, 
1, 
CURRENT_TIMESTAMP, 
CURRENT_TIMESTAMP);

INSERT INTO scv_t_tipos_usuarios (
descripcion,
id_status,
created_at,
updated_at)
VALUES (
'ADMINISTRADOR FUNCIONAL', 
1,
CURRENT_TIMESTAMP, 
CURRENT_TIMESTAMP);

INSERT INTO scv_t_tipos_usuarios( 
descripcion,
id_status,
created_at,
updated_at)
VALUES (
'ADMINISTRADOR CENTRO DE TRABAJO', 
1,
CURRENT_TIMESTAMP, 
CURRENT_TIMESTAMP);

INSERT INTO scv_t_tipos_usuarios( 
descripcion,
id_status,
created_at,
updated_at)
VALUES (
'OPERADOR',
1,
CURRENT_TIMESTAMP, 
CURRENT_TIMESTAMP);

INSERT INTO scv_t_centro_trabajo(
nombre,
siglas,
id_municipio,
id_status,
created_at,
updated_at)
VALUES
('EDIFICIO SAN BERNARDINO', 
'SB', 
1, 
1, 
CURRENT_TIMESTAMP, 
CURRENT_TIMESTAMP);

INSERT INTO scv_t_usuarios( 
ci,
usuario,
password,
no_carnet,
nombres,
apellidos,
email,
id_status,
id_centro_trabajo,
id_tipo_usuario,
created_at,
updated_at)
VALUES (
'0', 
'ADMIN', 
'$2y$10$rNbDFeMtUxHAC6IONuXFd.qrxjBfkqX/bWxK0RaL070wnx6eXDP3u', 
0, 
'USUARIO',
'ADMINISTRADOR', 
'N/A', 
1, 
1, 
1, 
CURRENT_TIMESTAMP, 
CURRENT_TIMESTAMP);





