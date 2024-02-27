--
-- PostgreSQL database dump
--

-- Dumped from database version 12.12 (Ubuntu 12.12-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.12 (Ubuntu 12.12-0ubuntu0.20.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO scv_udes;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO scv_udes;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO scv_udes;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO scv_udes;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO scv_udes;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO scv_udes;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO scv_udes;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: scv_t_carnets; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_carnets (
    carnet character varying(13) NOT NULL,
    id_centro_trabajo bigint NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    motivo character varying(120),
    asignado boolean DEFAULT false NOT NULL
);


ALTER TABLE public.scv_t_carnets OWNER TO scv_udes;

--
-- Name: scv_t_centro_trabajo; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_centro_trabajo (
    id_centro_trabajo bigint NOT NULL,
    nombre character varying(60) NOT NULL,
    siglas character varying(10) NOT NULL,
    id_municipio bigint NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_centro_trabajo OWNER TO scv_udes;

--
-- Name: scv_t_centro_trabajo_id_centro_trabajo_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_centro_trabajo_id_centro_trabajo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_centro_trabajo_id_centro_trabajo_seq OWNER TO scv_udes;

--
-- Name: scv_t_centro_trabajo_id_centro_trabajo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_centro_trabajo_id_centro_trabajo_seq OWNED BY public.scv_t_centro_trabajo.id_centro_trabajo;


--
-- Name: scv_t_codigos_area; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_codigos_area (
    id_area bigint NOT NULL,
    codigo_area character varying(4) NOT NULL,
    referencia character varying(400) NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_codigos_area OWNER TO scv_udes;

--
-- Name: scv_t_codigos_area_id_area_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_codigos_area_id_area_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_codigos_area_id_area_seq OWNER TO scv_udes;

--
-- Name: scv_t_codigos_area_id_area_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_codigos_area_id_area_seq OWNED BY public.scv_t_codigos_area.id_area;


--
-- Name: scv_t_destino_centro_trabajo; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_destino_centro_trabajo (
    id_destino bigint NOT NULL,
    destino character varying(200) NOT NULL,
    id_centro_trabajo bigint NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_destino_centro_trabajo OWNER TO scv_udes;

--
-- Name: scv_t_destino_centro_trabajo_id_destino_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_destino_centro_trabajo_id_destino_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_destino_centro_trabajo_id_destino_seq OWNER TO scv_udes;

--
-- Name: scv_t_destino_centro_trabajo_id_destino_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_destino_centro_trabajo_id_destino_seq OWNED BY public.scv_t_destino_centro_trabajo.id_destino;


--
-- Name: scv_t_equipos; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_equipos (
    id_equipo bigint NOT NULL,
    descripcion_equipo character varying(60) NOT NULL,
    serial character varying(16) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    id_visitante bigint,
    salio boolean DEFAULT false NOT NULL,
    entro boolean DEFAULT false NOT NULL,
    ci_pasaporte character varying(15) NOT NULL,
    observacion character varying(150)
);


ALTER TABLE public.scv_t_equipos OWNER TO scv_udes;

--
-- Name: scv_t_equipos_id_equipo_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_equipos_id_equipo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_equipos_id_equipo_seq OWNER TO scv_udes;

--
-- Name: scv_t_equipos_id_equipo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_equipos_id_equipo_seq OWNED BY public.scv_t_equipos.id_equipo;


--
-- Name: scv_t_estados; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_estados (
    id_estado bigint NOT NULL,
    nombre character varying(25) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    id_status bigint DEFAULT '1'::bigint NOT NULL
);


ALTER TABLE public.scv_t_estados OWNER TO scv_udes;

--
-- Name: scv_t_estados_id_estado_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_estados_id_estado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_estados_id_estado_seq OWNER TO scv_udes;

--
-- Name: scv_t_estados_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_estados_id_estado_seq OWNED BY public.scv_t_estados.id_estado;


--
-- Name: scv_t_estatus; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_estatus (
    id_status bigint NOT NULL,
    siglas character varying(2) NOT NULL,
    descripcion character varying(16) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_estatus OWNER TO scv_udes;

--
-- Name: scv_t_estatus_id_status_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_estatus_id_status_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_estatus_id_status_seq OWNER TO scv_udes;

--
-- Name: scv_t_estatus_id_status_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_estatus_id_status_seq OWNED BY public.scv_t_estatus.id_status;


--
-- Name: scv_t_historico_visitantes; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_historico_visitantes (
    id_visitante bigint NOT NULL,
    ci_pasaporte character varying(15) NOT NULL,
    nombres character varying(20) NOT NULL,
    apellidos character varying(20) NOT NULL,
    telefono character varying(12),
    procedencia character varying(30),
    no_carnet_asignado character varying(15),
    fecha_hora_entrada timestamp(0) without time zone NOT NULL,
    fecha_hora_salida timestamp(0) without time zone,
    nombres_apellidos_visitado character varying(45) NOT NULL,
    ci_visitado character varying(15) NOT NULL,
    nombres_apellidos_autoriza character varying(45) NOT NULL,
    ci_autoriza character varying(15) NOT NULL,
    observacion character varying(300),
    id_tipo_visitante bigint DEFAULT '1'::bigint NOT NULL,
    id_motivo_visita bigint DEFAULT '1'::bigint NOT NULL,
    id_centro_trabajo bigint DEFAULT '1'::bigint NOT NULL,
    id_destino bigint DEFAULT '1'::bigint NOT NULL,
    id_equipo bigint,
    id_operador bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_historico_visitantes OWNER TO scv_udes;

--
-- Name: scv_t_historico_visitantes_id_visitante_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_historico_visitantes_id_visitante_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_historico_visitantes_id_visitante_seq OWNER TO scv_udes;

--
-- Name: scv_t_historico_visitantes_id_visitante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_historico_visitantes_id_visitante_seq OWNED BY public.scv_t_historico_visitantes.id_visitante;


--
-- Name: scv_t_motivos_visitas; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_motivos_visitas (
    id_motivo_visita bigint NOT NULL,
    descripcion character varying(300) NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_motivos_visitas OWNER TO scv_udes;

--
-- Name: scv_t_motivos_visitas_id_motivo_visita_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_motivos_visitas_id_motivo_visita_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_motivos_visitas_id_motivo_visita_seq OWNER TO scv_udes;

--
-- Name: scv_t_motivos_visitas_id_motivo_visita_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_motivos_visitas_id_motivo_visita_seq OWNED BY public.scv_t_motivos_visitas.id_motivo_visita;


--
-- Name: scv_t_municipios; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_municipios (
    id_municipio bigint NOT NULL,
    nombre character varying(50) NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    id_estado bigint NOT NULL
);


ALTER TABLE public.scv_t_municipios OWNER TO scv_udes;

--
-- Name: scv_t_municipios_id_municipio_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_municipios_id_municipio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_municipios_id_municipio_seq OWNER TO scv_udes;

--
-- Name: scv_t_municipios_id_municipio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_municipios_id_municipio_seq OWNED BY public.scv_t_municipios.id_municipio;


--
-- Name: scv_t_tipos_usuarios; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_tipos_usuarios (
    id_tipo_usuario bigint NOT NULL,
    perfil_usuario character varying(40) NOT NULL,
    descripcion character varying(200) NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_tipos_usuarios OWNER TO scv_udes;

--
-- Name: scv_t_tipos_usuarios_id_tipo_usuario_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_tipos_usuarios_id_tipo_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_tipos_usuarios_id_tipo_usuario_seq OWNER TO scv_udes;

--
-- Name: scv_t_tipos_usuarios_id_tipo_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_tipos_usuarios_id_tipo_usuario_seq OWNED BY public.scv_t_tipos_usuarios.id_tipo_usuario;


--
-- Name: scv_t_tipos_visitantes; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_tipos_visitantes (
    id_tipo_visitante bigint NOT NULL,
    descripcion character varying(100) NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_tipos_visitantes OWNER TO scv_udes;

--
-- Name: scv_t_tipos_visitantes_id_tipo_visitante_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_tipos_visitantes_id_tipo_visitante_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_tipos_visitantes_id_tipo_visitante_seq OWNER TO scv_udes;

--
-- Name: scv_t_tipos_visitantes_id_tipo_visitante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_tipos_visitantes_id_tipo_visitante_seq OWNED BY public.scv_t_tipos_visitantes.id_tipo_visitante;


--
-- Name: scv_t_usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_usuarios_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_usuarios_id_usuario_seq OWNER TO scv_udes;

--
-- Name: scv_t_usuarios; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_usuarios (
    id_usuario bigint DEFAULT nextval('public.scv_t_usuarios_id_usuario_seq'::regclass) NOT NULL,
    ci character varying(10) NOT NULL,
    usuario character varying(10) NOT NULL,
    password character varying(255),
    no_carnet integer,
    nombres character varying(20) NOT NULL,
    apellidos character varying(20) NOT NULL,
    email character varying(30) NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL,
    id_centro_trabajo bigint NOT NULL,
    id_tipo_usuario bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.scv_t_usuarios OWNER TO scv_udes;

--
-- Name: scv_t_visitantes; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_visitantes (
    id_visitante bigint NOT NULL,
    ci_pasaporte character varying(15) NOT NULL,
    nombres character varying(20) NOT NULL,
    apellidos character varying(20) NOT NULL,
    telefono character varying(12),
    procedencia character varying(30),
    no_carnet_asignado character varying(15),
    fecha_hora_entrada timestamp(0) without time zone NOT NULL,
    fecha_hora_salida timestamp(0) without time zone,
    nombres_apellidos_visitado character varying(45) NOT NULL,
    ci_visitado character varying(15) NOT NULL,
    nombres_apellidos_autoriza character varying(45) NOT NULL,
    ci_autoriza character varying(15) NOT NULL,
    observacion character varying(300),
    id_tipo_visitante bigint DEFAULT '1'::bigint NOT NULL,
    id_motivo_visita bigint DEFAULT '1'::bigint NOT NULL,
    id_centro_trabajo bigint DEFAULT '1'::bigint NOT NULL,
    id_destino bigint DEFAULT '1'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    id_opetador_entrada bigint DEFAULT '1'::bigint NOT NULL,
    id_opetador_salida bigint
);


ALTER TABLE public.scv_t_visitantes OWNER TO scv_udes;

--
-- Name: scv_t_visitantes_id_visitante_seq; Type: SEQUENCE; Schema: public; Owner: scv_udes
--

CREATE SEQUENCE public.scv_t_visitantes_id_visitante_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scv_t_visitantes_id_visitante_seq OWNER TO scv_udes;

--
-- Name: scv_t_visitantes_id_visitante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: scv_udes
--

ALTER SEQUENCE public.scv_t_visitantes_id_visitante_seq OWNED BY public.scv_t_visitantes.id_visitante;


--
-- Name: scv_t_visitentes_restringidos; Type: TABLE; Schema: public; Owner: scv_udes
--

CREATE TABLE public.scv_t_visitentes_restringidos (
    ci_pasaporte character varying(20) NOT NULL,
    nombres character varying(20) NOT NULL,
    apallidos character varying(20) NOT NULL,
    empresa character varying(30),
    motivo character varying(300) NOT NULL,
    fecha_hora_evento timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    id_usuario bigint NOT NULL,
    id_centro_trabajo bigint NOT NULL,
    id_status bigint DEFAULT '1'::bigint NOT NULL
);


ALTER TABLE public.scv_t_visitentes_restringidos OWNER TO scv_udes;

--
-- Name: scv_v_reporte_vistantes_historico; Type: VIEW; Schema: public; Owner: scv_udes
--

CREATE VIEW public.scv_v_reporte_vistantes_historico AS
 SELECT v.id_visitante,
    v.ci_pasaporte,
    v.nombres,
    v.apellidos,
    v.telefono,
    v.procedencia,
    v.no_carnet_asignado,
    v.fecha_hora_entrada,
    v.fecha_hora_salida,
    v.nombres_apellidos_visitado,
    v.ci_visitado,
    v.nombres_apellidos_autoriza,
    v.ci_autoriza,
    v.observacion,
    t.descripcion AS tipo_visitante,
    m.descripcion AS motivo_visita,
    ct.nombre AS centro_trabajo,
    d.destino,
    u.usuario
   FROM ((((((public.scv_t_historico_visitantes v
     LEFT JOIN public.scv_t_usuarios u ON ((u.id_usuario = v.id_operador)))
     LEFT JOIN public.scv_t_destino_centro_trabajo d ON ((d.id_destino = v.id_destino)))
     LEFT JOIN public.scv_t_centro_trabajo ct ON ((ct.id_centro_trabajo = v.id_centro_trabajo)))
     LEFT JOIN public.scv_t_tipos_visitantes t ON ((t.id_tipo_visitante = v.id_tipo_visitante)))
     LEFT JOIN public.scv_t_motivos_visitas m ON ((m.id_motivo_visita = v.id_motivo_visita)))
     LEFT JOIN public.scv_t_carnets c ON (((c.carnet)::text = (v.no_carnet_asignado)::text)))
  WHERE ((date_part('week'::text, v.fecha_hora_entrada) = (date_part('week'::text, CURRENT_TIMESTAMP) - (1)::double precision)) OR (date_part('week'::text, v.fecha_hora_entrada) = date_part('week'::text, CURRENT_TIMESTAMP)));


ALTER TABLE public.scv_v_reporte_vistantes_historico OWNER TO scv_udes;

--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: scv_t_centro_trabajo id_centro_trabajo; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_centro_trabajo ALTER COLUMN id_centro_trabajo SET DEFAULT nextval('public.scv_t_centro_trabajo_id_centro_trabajo_seq'::regclass);


--
-- Name: scv_t_codigos_area id_area; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_codigos_area ALTER COLUMN id_area SET DEFAULT nextval('public.scv_t_codigos_area_id_area_seq'::regclass);


--
-- Name: scv_t_destino_centro_trabajo id_destino; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_destino_centro_trabajo ALTER COLUMN id_destino SET DEFAULT nextval('public.scv_t_destino_centro_trabajo_id_destino_seq'::regclass);


--
-- Name: scv_t_equipos id_equipo; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_equipos ALTER COLUMN id_equipo SET DEFAULT nextval('public.scv_t_equipos_id_equipo_seq'::regclass);


--
-- Name: scv_t_estados id_estado; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_estados ALTER COLUMN id_estado SET DEFAULT nextval('public.scv_t_estados_id_estado_seq'::regclass);


--
-- Name: scv_t_estatus id_status; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_estatus ALTER COLUMN id_status SET DEFAULT nextval('public.scv_t_estatus_id_status_seq'::regclass);


--
-- Name: scv_t_historico_visitantes id_visitante; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes ALTER COLUMN id_visitante SET DEFAULT nextval('public.scv_t_historico_visitantes_id_visitante_seq'::regclass);


--
-- Name: scv_t_motivos_visitas id_motivo_visita; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_motivos_visitas ALTER COLUMN id_motivo_visita SET DEFAULT nextval('public.scv_t_motivos_visitas_id_motivo_visita_seq'::regclass);


--
-- Name: scv_t_municipios id_municipio; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_municipios ALTER COLUMN id_municipio SET DEFAULT nextval('public.scv_t_municipios_id_municipio_seq'::regclass);


--
-- Name: scv_t_tipos_usuarios id_tipo_usuario; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_tipos_usuarios ALTER COLUMN id_tipo_usuario SET DEFAULT nextval('public.scv_t_tipos_usuarios_id_tipo_usuario_seq'::regclass);


--
-- Name: scv_t_tipos_visitantes id_tipo_visitante; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_tipos_visitantes ALTER COLUMN id_tipo_visitante SET DEFAULT nextval('public.scv_t_tipos_visitantes_id_tipo_visitante_seq'::regclass);


--
-- Name: scv_t_visitantes id_visitante; Type: DEFAULT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes ALTER COLUMN id_visitante SET DEFAULT nextval('public.scv_t_visitantes_id_visitante_seq'::regclass);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_100000_create_password_resets_table	1
2	2019_08_19_000000_create_failed_jobs_table	1
3	2019_12_14_000001_create_personal_access_tokens_table	1
4	2022_03_08_124817_create_scv_t_estatus_table	1
5	2022_03_08_131136_create_scv_t_estados_table	1
6	2022_03_08_132340_create_scv_t_municipios_table	1
7	2022_03_08_140356_create_scv_t_centro_trabajo_table	1
8	2022_03_08_141501_create_scv_t_tipos_usuarios_table	1
9	2022_03_08_142153_create_scv_t_usuarios_table	1
10	2022_03_30_181254_create_scv_t_motivos_visitas	1
11	2022_03_30_200113_create_scv_t_tipos_visitantes	1
12	2022_03_31_130245_create_scv_t_carnets	1
13	2022_04_20_131601_create_scv_t_destino_centro_trabajo	1
14	2022_04_20_181926_create_scv_t_codigos_area	1
15	2022_04_25_141605_create_scv_t_visitentes_restringidos	1
24	2022_09_20_135417_create_scv_t_equipos	2
25	2022_09_20_135418_create_scv_t_visitantes	2
26	2022_10_03_123708_add_asignado_to_scv_t_carnets	3
27	2022_10_11_212540_create_table_scv_t_historico_visitantes	4
36	2022_12_06_171955_apadate_table_scv_t_visitantes	5
41	2022_12_06_214435_add_column_id_visitante_to_scv_t_equipos	8
43	2022_12_06_215655_edit_columnse_to_scv_t_equipos	9
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
1	App\\Models\\User	1	auth-name	12d0348ba79263d89c7e4c3f10f119185041f7f2c9d7248d358b0460d92d428f	["*"]	\N	2022-10-20 01:51:03	2022-10-20 01:51:03
2	App\\Models\\User	1	auth-name	1401d8d14cc38b7ebfaa01673430e0dede4c3b4a3c9f8ec1dd2ce98521b2a59f	["*"]	\N	2022-10-20 02:29:39	2022-10-20 02:29:39
\.


--
-- Data for Name: scv_t_carnets; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_carnets (carnet, id_centro_trabajo, id_status, created_at, updated_at, motivo, asignado) FROM stdin;
EDFMARQUES-03	3	1	2022-09-15 20:51:06	2022-09-15 20:51:06	\N	f
SB-07	1	1	2022-11-18 14:56:30	2022-12-22 16:14:27	\N	f
SB-04	1	1	2022-12-02 12:50:26	2022-12-08 12:26:26	\N	f
SB-06	1	1	2022-12-06 20:16:12	2022-12-08 14:00:12	\N	f
SB-05	1	1	2022-12-06 22:03:30	2022-12-08 14:04:54	\N	f
SB-20	1	1	2022-12-07 12:51:39	2022-12-07 12:51:39	\N	f
SB-25	1	1	2022-12-07 12:51:45	2022-12-07 12:51:45	\N	f
SB-11	1	1	2022-11-18 14:57:13	2022-12-02 12:15:34	\N	f
SB-10	1	1	2022-11-18 14:57:21	2022-12-02 12:46:32	\N	f
SB-09	1	1	2022-12-02 12:50:35	2022-12-05 11:58:32	\N	f
SB-13	1	1	2022-12-02 12:50:31	2022-12-06 20:13:09	\N	f
EDFMARQUES-01	3	1	\N	2023-01-17 17:17:31		f
SB-08	1	1	2022-12-06 20:16:16	2022-12-06 20:42:31	\N	f
SB-12	1	1	2022-12-06 22:03:34	2022-12-07 11:35:44	\N	f
SB-18	1	1	2022-12-06 22:03:38	2022-12-07 12:47:20	\N	f
SB-15	1	1	2022-12-07 12:51:35	2022-12-07 12:52:13	\N	f
EDFSANBDNO-17	1	1	\N	2023-01-19 10:14:24	\N	t
SB-02	1	1	2022-11-18 14:02:00	2023-01-19 16:36:24	\N	t
SB-03	1	1	2022-11-18 14:56:24	2023-01-20 15:06:02	\N	t
EDFSANBDNO-01	1	1	\N	2023-01-26 11:21:57	\N	t
\.


--
-- Data for Name: scv_t_centro_trabajo; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_centro_trabajo (id_centro_trabajo, nombre, siglas, id_municipio, id_status, created_at, updated_at) FROM stdin;
1	EDIFICIO SAN BERNARDINO	SB	1	1	2022-05-02 11:28:23	2022-05-02 11:28:23
3	EDIFICIO ADMINISTRATIVO EL MARQUÉS	EDFMARQUES	1	1	2022-05-04 17:09:51	2022-08-11 20:37:33
\.


--
-- Data for Name: scv_t_codigos_area; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_codigos_area (id_area, codigo_area, referencia, id_status, created_at, updated_at) FROM stdin;
1	0252	CARORA ESTADO LARA MUNICIPIO C/G PEDRO LEÓNTORRES	1	2022-05-02 15:29:35	2022-05-02 15:30:01
2	0281	ANZOÁTEGUI - BARCELONA, BERGANTÍN, BOCA DE UCHIRE, CAIGUA, CLARINES, CURATAQUICHE, EL CARITO, EL HATILLO, EL MORRO, GUANAPE, GUANAPITO, GUANTA, GUARIBE, LECHERÍAS, MUCURA, MUNDO NUEVO, ONOTO, PALITAL, PARADERO, PARDILLAL, PIRARA, PÍRITU, POZUELOS, PUERTO LA CRUZ, PUERTO PÍRITU, PUTUCUAL, QUIAMARE, SABANA DE UCHIRE, SAN DIEGO DE CABRUTICA, SAN FRANCISCO, SAN PEDRO, SANTA CRUZ, VALLE GUANAPE	1	2022-05-06 13:48:36	2022-05-06 13:48:36
5	0212	MIRANDA - ARAIRA, CARACAS, CARRIZALEZ, FILAS DE MARICHE, GUARENAS, GUATIRE, EL JARILLO, EL JUNQUITO, LOS TEQUES, PARACOTOS, SAN ANTONIO DE LOS ALTOS, SAN JOSÉ DE LOS ALTOS, SAN PEDRO, SAN PEDRO DE LOS ALTOS, TURUMO	1	2022-05-06 13:50:04	2022-05-06 13:50:04
6	0412	DIGITEL	1	2022-10-04 20:04:51	2022-09-27 20:04:59
8	1234	DD	1	2023-01-19 16:09:31	2023-01-19 16:09:51
\.


--
-- Data for Name: scv_t_destino_centro_trabajo; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_destino_centro_trabajo (id_destino, destino, id_centro_trabajo, id_status, created_at, updated_at) FROM stdin;
1	SERV. MÉDICOS - AP3	3	1	2022-05-04 17:19:28	2022-05-04 17:22:43
8	GERENCIA ATIT - P7	3	1	2022-05-04 17:24:14	2022-05-04 17:24:14
15	12345678901234567890	3	1	2022-08-10 21:11:25	2022-08-10 21:11:25
16	SOTANO1	3	1	2022-10-24 14:54:41	2022-10-24 14:54:41
24	SOTANO1	1	1	2022-10-28 19:39:04	2022-10-28 19:39:04
\.


--
-- Data for Name: scv_t_equipos; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_equipos (id_equipo, descripcion_equipo, serial, created_at, updated_at, id_visitante, salio, entro, ci_pasaporte, observacion) FROM stdin;
31	Proyextor de imagenes BENQ	4324234-fgg	2022-12-22 16:29:10	2022-12-22 16:29:10	145	f	t	V-17343230	\N
30	Laptos LENOVO	15548dssads	2022-12-22 16:29:10	2022-12-22 16:30:01	145	t	t	V-17343230	\N
34	Proyextor de imagenes BENQ	4324234-fgg	2023-01-26 11:18:46	2023-01-26 11:18:46	147	t	f	V-17343230	\N
32	PC	5465464	2023-01-20 15:06:02	2023-01-20 15:06:02	151	f	t	V-17343230	OBSERVACIONES
33	print	565 sdasdsa	2023-01-20 15:06:02	2023-01-20 15:06:02	151	f	t	V-17343230	OBSERVACIONES
\.


--
-- Data for Name: scv_t_estados; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_estados (id_estado, nombre, created_at, updated_at, id_status) FROM stdin;
1	DISTRITO CAPITAL	2022-05-02 11:28:23	2022-05-02 11:28:23	1
2	AMAZONAS	2022-05-03 22:54:05	2022-05-03 22:54:05	1
9	CARABOBO	2022-05-04 14:26:27	2022-05-04 14:26:27	1
10	CARABÓBO	2022-05-04 14:26:45	2022-05-04 14:39:43	1
12	ZULIA	2022-05-04 14:27:44	2022-05-04 14:27:44	1
14	COJEDES	2022-05-04 14:28:11	2022-05-04 14:28:11	1
15	ARAGUA	2022-05-04 14:28:19	2022-05-04 14:28:19	1
16	LARA	2022-05-04 14:29:01	2022-05-04 14:29:01	1
17	MÉRIDA	2022-05-04 14:29:09	2022-05-04 14:29:09	1
18	GUÁRICO	2022-05-04 14:30:23	2022-05-04 14:30:23	1
19	LA GUAIRA	2022-05-04 14:30:32	2022-05-04 14:30:32	1
21	MIRANDA	2022-08-12 12:19:23	2022-08-12 12:19:23	1
24	PRUEBA	2022-11-18 11:53:25	2022-11-18 11:53:25	1
\.


--
-- Data for Name: scv_t_estatus; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_estatus (id_status, siglas, descripcion, created_at, updated_at) FROM stdin;
1	AC	ACTIVO	2022-05-02 11:28:23	2022-05-02 11:28:23
2	IN	INACTIVO	2022-05-02 11:28:23	2022-05-02 11:28:23
\.


--
-- Data for Name: scv_t_historico_visitantes; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_historico_visitantes (id_visitante, ci_pasaporte, nombres, apellidos, telefono, procedencia, no_carnet_asignado, fecha_hora_entrada, fecha_hora_salida, nombres_apellidos_visitado, ci_visitado, nombres_apellidos_autoriza, ci_autoriza, observacion, id_tipo_visitante, id_motivo_visita, id_centro_trabajo, id_destino, id_equipo, id_operador, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: scv_t_motivos_visitas; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_motivos_visitas (id_motivo_visita, descripcion, id_status, created_at, updated_at) FROM stdin;
1	ASISTIR A CONSULTA MÉDICA	1	2022-05-04 18:52:34	2022-05-04 18:52:34
3	ASISTIR A RUEDA DE PRENSA	1	2022-05-04 18:53:05	2022-05-04 18:53:05
5	CONSIGNAR DOCUMENTOS	1	2022-05-04 18:53:26	2022-05-04 18:55:26
2	ASISTIR A REUNIÓN DE TRABAJO	1	2022-05-04 18:52:50	2022-05-04 18:55:34
4	CONSIGNAR DOCUMENTOS	1	2022-05-04 18:53:21	2022-05-04 18:55:51
\.


--
-- Data for Name: scv_t_municipios; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_municipios (id_municipio, nombre, id_status, created_at, updated_at, id_estado) FROM stdin;
1	DISTRITO CAPITAL	1	2022-05-02 11:28:23	2022-05-02 11:28:23	1
2	BOLÍVAR	1	2022-05-04 14:33:43	2022-05-04 14:37:00	2
3	CAMATAGUA	1	2022-05-04 14:33:59	2022-05-04 14:37:33	9
4	CAMATAGUA	1	2022-05-04 14:34:21	2022-05-04 14:34:21	9
5	CAMATAGUA	1	2022-05-04 14:36:07	2022-05-04 14:36:07	10
6	BEJUMA	1	2022-05-04 14:38:47	2022-05-04 14:38:47	18
7	BOLÍVAR	1	2022-08-12 12:21:47	2022-08-12 12:21:47	2
\.


--
-- Data for Name: scv_t_tipos_usuarios; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_tipos_usuarios (id_tipo_usuario, perfil_usuario, descripcion, id_status, created_at, updated_at) FROM stdin;
2	ADMINISTRADOR CENTRO DE TRABAJO	Gestiona y Administra toda la data relativa a su Centro de Trabajo.	1	2022-05-02 11:28:23	2022-05-02 11:28:23
3	OPERADOR	Registra las Entradas/Salidas de Visitantes.	1	2022-05-02 11:28:23	2022-05-02 11:28:23
1	ADMINISTRADOR FUNCIONAL	Con acceso a todo el Sistema. Único autorizado para Crear  Estados-Municipios-Sedes, Motivos de Visitas, Tipos de Visitantes, Códigos Telefónicos de Área y Adm. Funcionales y de Centros de Trabajo.	1	2022-05-02 11:28:23	2022-05-02 11:28:23
\.


--
-- Data for Name: scv_t_tipos_visitantes; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_tipos_visitantes (id_tipo_visitante, descripcion, id_status, created_at, updated_at) FROM stdin;
1	CONSEJO COMUNAL	1	2022-05-04 18:56:50	2022-05-04 18:56:50
2	CONSEJO COMUNAL	1	2022-05-04 18:56:56	2022-05-04 18:56:56
4	FUNCIONARIO DE ENTES ADSCRIPTOS	1	2022-05-04 18:58:16	2022-05-04 18:58:16
3	EMPLEADO DE LA INSTITUCIÓN (SIN CARNET)	1	2022-05-04 18:57:23	2022-05-04 18:59:32
\.


--
-- Data for Name: scv_t_usuarios; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_usuarios (id_usuario, ci, usuario, password, no_carnet, nombres, apellidos, email, id_status, id_centro_trabajo, id_tipo_usuario, created_at, updated_at) FROM stdin;
2	6033451	JFREIRE	\N	118046	JOSE	FREIRE	jfreire@corpoelec.gob.ve	1	1	1	2022-05-03 22:41:02	2022-05-03 22:41:02
1	0	ADMIN	$2y$10$rNbDFeMtUxHAC6IONuXFd.qrxjBfkqX/bWxK0RaL070wnx6eXDP3u	0	USUARIO	ADMINISTRADOR	N/A	1	1	1	2022-05-02 11:28:23	2022-05-02 11:28:23
5	17343230	A7343230	\N	145365	MARCOS ALEXANDER	ORTEGANO MENDOZA	MORTEGANO@CORPOELEC.GOB.VE	1	1	1	2022-10-28 20:01:12	2022-10-28 20:01:42
6	22027877	DEBELLO	\N	464646	DARIO ELIAS	BELLO PEREZ	DEBELLO@MPPEE.GOB.VE	1	3	1	2022-11-16 20:48:35	2022-11-16 20:48:35
3	11587323	A1587323	\N	1	LIANFADER	DURAN	LJDURAN@CORPOELEC.GOB.VE	1	3	1	2022-05-03 22:43:21	2023-01-18 08:54:55
\.


--
-- Data for Name: scv_t_visitantes; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_visitantes (id_visitante, ci_pasaporte, nombres, apellidos, telefono, procedencia, no_carnet_asignado, fecha_hora_entrada, fecha_hora_salida, nombres_apellidos_visitado, ci_visitado, nombres_apellidos_autoriza, ci_autoriza, observacion, id_tipo_visitante, id_motivo_visita, id_centro_trabajo, id_destino, created_at, updated_at, id_opetador_entrada, id_opetador_salida) FROM stdin;
145	V-17343230	MARCOS	ORTEGANO	0412-7747491		SB-02	2022-12-22 16:29:10	2022-12-22 16:30:01	JOSE FREIRES	V-5321250	JOSE FREIRES	V-5321250	\N	3	5	1	24	2022-12-22 16:29:10	2022-12-22 16:30:01	1	1
146	V-17343230	MARCOS	ORTEGANO	0412-7747491		EDFSANBDNO-17	2023-01-16 16:28:01	2023-01-17 11:01:05	PEDRO	V-17343230	PEDRO	V-17343230	\N	3	1	1	24	2023-01-16 16:28:01	2023-01-17 11:01:05	1	1
148	V-4	OVERFLOW	OVERFLOW	0212-4445566		EDFSANBDNO-17	2023-01-19 10:14:24	\N	123456789012345678901234567890123456789012345	V-17343230	1234567 901234567 8901234678901234567 8901234	V-5	observacionobser aciovacionobservacionobservacionobservacionobservacionobservacionobservacionobservacionobservac00 observacionobservacionobservacionobservaci onobservacionobservacionobservacionobserva cionobservacionobservacionobservac00observacionobservaci onobservacionobservaciono bservacionobse  	1	1	1	24	2023-01-19 10:14:24	2023-01-19 10:14:24	1	\N
149	P-1234567890123	MAX	MAX	0212-1235588		SB-02	2023-01-19 16:36:24	\N	MIGREATE	V-324324	MIGREATE	V-324324	\N	1	1	1	24	2023-01-19 16:36:24	2023-01-19 16:36:24	1	\N
150	V-5	OBSERVACIONES	OBSERVACIONES	0212-3214455		SB-03	2023-01-20 15:06:02	\N	MIGREATE	V-17343230	MIGREATE	V-17343230	\N	1	1	1	24	2023-01-20 15:06:02	2023-01-20 15:06:02	1	\N
147	V-17343230	MARCOS	ORTEGANO	0412-7747491		EDFSANBDNO-01	2023-01-18 14:25:12	2023-01-26 11:18:46	ADDEQUIPOS	V-17343230	ADDEQUIPOS	V-17343230	\N	3	1	1	24	2023-01-18 14:25:12	2023-01-26 11:18:46	1	1
151	V-17343230	MARCOS	ORTEGANO	0412-7747491	Procedencia	EDFSANBDNO-01	2023-01-26 11:21:57	\N	MIGREATE	V-17343230	MIGREATE	V-17343231	Obsercaciones	1	2	1	24	2023-01-26 11:21:57	2023-01-26 11:21:57	1	\N
\.


--
-- Data for Name: scv_t_visitentes_restringidos; Type: TABLE DATA; Schema: public; Owner: scv_udes
--

COPY public.scv_t_visitentes_restringidos (ci_pasaporte, nombres, apallidos, empresa, motivo, fecha_hora_evento, created_at, updated_at, id_usuario, id_centro_trabajo, id_status) FROM stdin;
V-17343231	MARCOS	ORTEGANO	CORPOELEC-LARA	PRUEBA	2022-08-31 19:43:00	2022-09-21 23:44:40	2022-11-01 19:27:23	1	3	1
P-124567890	PEDRO	PEREZ		MOTIVO	2022-09-09 14:07:00	2022-09-09 18:22:26	2022-11-17 18:06:16	1	1	1
P-0222222	CARLOS	LOSADA	DESCONOCIDA	JUDICIAL	2022-12-01 12:45:00	2022-05-06 19:22:31	2022-12-05 12:45:21	1	3	2
V-17343233	TEST FECHA	TEST FECHA	TEST FECHA	TEST FECHA	2022-11-17 14:05:00	2022-11-17 18:11:38	2022-12-05 12:47:46	1	3	1
P-555555	PEDRO	MONTES	MONTES & ASOCIADOS	POR HURTO	2022-12-05 08:00:00	2022-05-06 19:24:17	2022-12-05 14:55:00	1	1	2
V--78787	43534543	43243243		UYTYUYUY	2023-01-05 09:01:00	2023-01-18 09:21:05	2023-01-18 09:21:05	1	3	1
V-17343230	CARLOS	LOSADA	DESCONOCIDA	COVID-19	2020-03-12 00:00:00	2022-05-06 19:23:26	2023-01-18 09:43:37	1	3	2
\.


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 2, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.migrations_id_seq', 43, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 3, true);


--
-- Name: scv_t_centro_trabajo_id_centro_trabajo_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_centro_trabajo_id_centro_trabajo_seq', 4, true);


--
-- Name: scv_t_codigos_area_id_area_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_codigos_area_id_area_seq', 8, true);


--
-- Name: scv_t_destino_centro_trabajo_id_destino_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_destino_centro_trabajo_id_destino_seq', 25, true);


--
-- Name: scv_t_equipos_id_equipo_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_equipos_id_equipo_seq', 35, true);


--
-- Name: scv_t_estados_id_estado_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_estados_id_estado_seq', 25, true);


--
-- Name: scv_t_estatus_id_status_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_estatus_id_status_seq', 3, true);


--
-- Name: scv_t_historico_visitantes_id_visitante_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_historico_visitantes_id_visitante_seq', 15, true);


--
-- Name: scv_t_motivos_visitas_id_motivo_visita_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_motivos_visitas_id_motivo_visita_seq', 6, true);


--
-- Name: scv_t_municipios_id_municipio_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_municipios_id_municipio_seq', 8, true);


--
-- Name: scv_t_tipos_usuarios_id_tipo_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_tipos_usuarios_id_tipo_usuario_seq', 4, true);


--
-- Name: scv_t_tipos_visitantes_id_tipo_visitante_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_tipos_visitantes_id_tipo_visitante_seq', 5, true);


--
-- Name: scv_t_usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_usuarios_id_usuario_seq', 7, true);


--
-- Name: scv_t_visitantes_id_visitante_seq; Type: SEQUENCE SET; Schema: public; Owner: scv_udes
--

SELECT pg_catalog.setval('public.scv_t_visitantes_id_visitante_seq', 151, true);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: scv_t_carnets scv_t_carnet_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_carnets
    ADD CONSTRAINT scv_t_carnet_pkey PRIMARY KEY (carnet);


--
-- Name: scv_t_centro_trabajo scv_t_centro_trabajo_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_centro_trabajo
    ADD CONSTRAINT scv_t_centro_trabajo_pkey PRIMARY KEY (id_centro_trabajo);


--
-- Name: scv_t_codigos_area scv_t_codigos_area_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_codigos_area
    ADD CONSTRAINT scv_t_codigos_area_pkey PRIMARY KEY (id_area);


--
-- Name: scv_t_destino_centro_trabajo scv_t_destino_centro_trabajo_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_destino_centro_trabajo
    ADD CONSTRAINT scv_t_destino_centro_trabajo_pkey PRIMARY KEY (id_destino);


--
-- Name: scv_t_equipos scv_t_equipos_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_equipos
    ADD CONSTRAINT scv_t_equipos_pkey PRIMARY KEY (id_equipo);


--
-- Name: scv_t_estados scv_t_estados_nombre_unique; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_estados
    ADD CONSTRAINT scv_t_estados_nombre_unique UNIQUE (nombre);


--
-- Name: scv_t_estados scv_t_estados_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_estados
    ADD CONSTRAINT scv_t_estados_pkey PRIMARY KEY (id_estado);


--
-- Name: scv_t_estatus scv_t_estatus_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_estatus
    ADD CONSTRAINT scv_t_estatus_pkey PRIMARY KEY (id_status);


--
-- Name: scv_t_estatus scv_t_estatus_siglas_unique; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_estatus
    ADD CONSTRAINT scv_t_estatus_siglas_unique UNIQUE (siglas);


--
-- Name: scv_t_historico_visitantes scv_t_historico_visitantes_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes
    ADD CONSTRAINT scv_t_historico_visitantes_pkey PRIMARY KEY (id_visitante);


--
-- Name: scv_t_motivos_visitas scv_t_motivos_visitas_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_motivos_visitas
    ADD CONSTRAINT scv_t_motivos_visitas_pkey PRIMARY KEY (id_motivo_visita);


--
-- Name: scv_t_municipios scv_t_municipios_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_municipios
    ADD CONSTRAINT scv_t_municipios_pkey PRIMARY KEY (id_municipio);


--
-- Name: scv_t_tipos_usuarios scv_t_tipos_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_tipos_usuarios
    ADD CONSTRAINT scv_t_tipos_usuarios_pkey PRIMARY KEY (id_tipo_usuario);


--
-- Name: scv_t_tipos_visitantes scv_t_tipos_visitantes_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_tipos_visitantes
    ADD CONSTRAINT scv_t_tipos_visitantes_pkey PRIMARY KEY (id_tipo_visitante);


--
-- Name: scv_t_usuarios scv_t_usuarios_ci_unique; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_usuarios
    ADD CONSTRAINT scv_t_usuarios_ci_unique UNIQUE (ci);


--
-- Name: scv_t_usuarios scv_t_usuarios_email_unique; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_usuarios
    ADD CONSTRAINT scv_t_usuarios_email_unique UNIQUE (email);


--
-- Name: scv_t_usuarios scv_t_usuarios_no_carnet_unique; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_usuarios
    ADD CONSTRAINT scv_t_usuarios_no_carnet_unique UNIQUE (no_carnet);


--
-- Name: scv_t_usuarios scv_t_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_usuarios
    ADD CONSTRAINT scv_t_usuarios_pkey PRIMARY KEY (id_usuario);


--
-- Name: scv_t_visitantes scv_t_visitantes_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes
    ADD CONSTRAINT scv_t_visitantes_pkey PRIMARY KEY (id_visitante);


--
-- Name: scv_t_visitentes_restringidos scv_t_visitentes_restringidos_pkey; Type: CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitentes_restringidos
    ADD CONSTRAINT scv_t_visitentes_restringidos_pkey PRIMARY KEY (ci_pasaporte);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: scv_udes
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: scv_udes
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: scv_t_carnets scv_t_carnets_id_centro_trabajo_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_carnets
    ADD CONSTRAINT scv_t_carnets_id_centro_trabajo_foreign FOREIGN KEY (id_centro_trabajo) REFERENCES public.scv_t_centro_trabajo(id_centro_trabajo);


--
-- Name: scv_t_carnets scv_t_carnets_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_carnets
    ADD CONSTRAINT scv_t_carnets_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_centro_trabajo scv_t_centro_trabajo_id_municipio_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_centro_trabajo
    ADD CONSTRAINT scv_t_centro_trabajo_id_municipio_foreign FOREIGN KEY (id_municipio) REFERENCES public.scv_t_municipios(id_municipio);


--
-- Name: scv_t_centro_trabajo scv_t_centro_trabajo_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_centro_trabajo
    ADD CONSTRAINT scv_t_centro_trabajo_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_codigos_area scv_t_codigos_area_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_codigos_area
    ADD CONSTRAINT scv_t_codigos_area_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_destino_centro_trabajo scv_t_destino_centro_trabajo_id_centro_trabajo_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_destino_centro_trabajo
    ADD CONSTRAINT scv_t_destino_centro_trabajo_id_centro_trabajo_foreign FOREIGN KEY (id_centro_trabajo) REFERENCES public.scv_t_centro_trabajo(id_centro_trabajo);


--
-- Name: scv_t_destino_centro_trabajo scv_t_destino_centro_trabajo_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_destino_centro_trabajo
    ADD CONSTRAINT scv_t_destino_centro_trabajo_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_equipos scv_t_equipos_id_visitante_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_equipos
    ADD CONSTRAINT scv_t_equipos_id_visitante_foreign FOREIGN KEY (id_visitante) REFERENCES public.scv_t_visitantes(id_visitante) ON DELETE CASCADE;


--
-- Name: scv_t_estados scv_t_estados_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_estados
    ADD CONSTRAINT scv_t_estados_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_historico_visitantes scv_t_historico_visitantes_id_centro_trabajo_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes
    ADD CONSTRAINT scv_t_historico_visitantes_id_centro_trabajo_foreign FOREIGN KEY (id_centro_trabajo) REFERENCES public.scv_t_centro_trabajo(id_centro_trabajo);


--
-- Name: scv_t_historico_visitantes scv_t_historico_visitantes_id_destino_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes
    ADD CONSTRAINT scv_t_historico_visitantes_id_destino_foreign FOREIGN KEY (id_destino) REFERENCES public.scv_t_destino_centro_trabajo(id_destino);


--
-- Name: scv_t_historico_visitantes scv_t_historico_visitantes_id_equipo_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes
    ADD CONSTRAINT scv_t_historico_visitantes_id_equipo_foreign FOREIGN KEY (id_equipo) REFERENCES public.scv_t_equipos(id_equipo);


--
-- Name: scv_t_historico_visitantes scv_t_historico_visitantes_id_motivo_visita_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes
    ADD CONSTRAINT scv_t_historico_visitantes_id_motivo_visita_foreign FOREIGN KEY (id_motivo_visita) REFERENCES public.scv_t_motivos_visitas(id_motivo_visita);


--
-- Name: scv_t_historico_visitantes scv_t_historico_visitantes_id_operador_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes
    ADD CONSTRAINT scv_t_historico_visitantes_id_operador_foreign FOREIGN KEY (id_operador) REFERENCES public.scv_t_usuarios(id_usuario);


--
-- Name: scv_t_historico_visitantes scv_t_historico_visitantes_id_tipo_visitante_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes
    ADD CONSTRAINT scv_t_historico_visitantes_id_tipo_visitante_foreign FOREIGN KEY (id_tipo_visitante) REFERENCES public.scv_t_tipos_visitantes(id_tipo_visitante);


--
-- Name: scv_t_historico_visitantes scv_t_historico_visitantes_no_carnet_asignado_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_historico_visitantes
    ADD CONSTRAINT scv_t_historico_visitantes_no_carnet_asignado_foreign FOREIGN KEY (no_carnet_asignado) REFERENCES public.scv_t_carnets(carnet);


--
-- Name: scv_t_motivos_visitas scv_t_motivos_visitas_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_motivos_visitas
    ADD CONSTRAINT scv_t_motivos_visitas_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_municipios scv_t_municipios_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_municipios
    ADD CONSTRAINT scv_t_municipios_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_tipos_usuarios scv_t_tipos_usuarios_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_tipos_usuarios
    ADD CONSTRAINT scv_t_tipos_usuarios_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_tipos_visitantes scv_t_tipos_visitantes_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_tipos_visitantes
    ADD CONSTRAINT scv_t_tipos_visitantes_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_usuarios scv_t_usuarios_id_centro_trabajo_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_usuarios
    ADD CONSTRAINT scv_t_usuarios_id_centro_trabajo_foreign FOREIGN KEY (id_centro_trabajo) REFERENCES public.scv_t_centro_trabajo(id_centro_trabajo);


--
-- Name: scv_t_usuarios scv_t_usuarios_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_usuarios
    ADD CONSTRAINT scv_t_usuarios_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_usuarios scv_t_usuarios_id_tipo_usuario_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_usuarios
    ADD CONSTRAINT scv_t_usuarios_id_tipo_usuario_foreign FOREIGN KEY (id_tipo_usuario) REFERENCES public.scv_t_tipos_usuarios(id_tipo_usuario);


--
-- Name: scv_t_visitantes scv_t_visitantes_id_centro_trabajo_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes
    ADD CONSTRAINT scv_t_visitantes_id_centro_trabajo_foreign FOREIGN KEY (id_centro_trabajo) REFERENCES public.scv_t_centro_trabajo(id_centro_trabajo);


--
-- Name: scv_t_visitantes scv_t_visitantes_id_destino_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes
    ADD CONSTRAINT scv_t_visitantes_id_destino_foreign FOREIGN KEY (id_destino) REFERENCES public.scv_t_destino_centro_trabajo(id_destino);


--
-- Name: scv_t_visitantes scv_t_visitantes_id_motivo_visita_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes
    ADD CONSTRAINT scv_t_visitantes_id_motivo_visita_foreign FOREIGN KEY (id_motivo_visita) REFERENCES public.scv_t_motivos_visitas(id_motivo_visita);


--
-- Name: scv_t_visitantes scv_t_visitantes_id_opetador_entrada_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes
    ADD CONSTRAINT scv_t_visitantes_id_opetador_entrada_foreign FOREIGN KEY (id_opetador_entrada) REFERENCES public.scv_t_usuarios(id_usuario);


--
-- Name: scv_t_visitantes scv_t_visitantes_id_opetador_salida_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes
    ADD CONSTRAINT scv_t_visitantes_id_opetador_salida_foreign FOREIGN KEY (id_opetador_salida) REFERENCES public.scv_t_usuarios(id_usuario);


--
-- Name: scv_t_visitantes scv_t_visitantes_id_tipo_visitante_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes
    ADD CONSTRAINT scv_t_visitantes_id_tipo_visitante_foreign FOREIGN KEY (id_tipo_visitante) REFERENCES public.scv_t_tipos_visitantes(id_tipo_visitante);


--
-- Name: scv_t_visitantes scv_t_visitantes_no_carnet_asignado_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitantes
    ADD CONSTRAINT scv_t_visitantes_no_carnet_asignado_foreign FOREIGN KEY (no_carnet_asignado) REFERENCES public.scv_t_carnets(carnet);


--
-- Name: scv_t_visitentes_restringidos scv_t_visitentes_restringidos_id_centro_trabajo_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitentes_restringidos
    ADD CONSTRAINT scv_t_visitentes_restringidos_id_centro_trabajo_foreign FOREIGN KEY (id_centro_trabajo) REFERENCES public.scv_t_centro_trabajo(id_centro_trabajo);


--
-- Name: scv_t_visitentes_restringidos scv_t_visitentes_restringidos_id_status_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitentes_restringidos
    ADD CONSTRAINT scv_t_visitentes_restringidos_id_status_foreign FOREIGN KEY (id_status) REFERENCES public.scv_t_estatus(id_status);


--
-- Name: scv_t_visitentes_restringidos scv_t_visitentes_restringidos_id_usuario_foreign; Type: FK CONSTRAINT; Schema: public; Owner: scv_udes
--

ALTER TABLE ONLY public.scv_t_visitentes_restringidos
    ADD CONSTRAINT scv_t_visitentes_restringidos_id_usuario_foreign FOREIGN KEY (id_usuario) REFERENCES public.scv_t_usuarios(id_usuario);


--
-- PostgreSQL database dump complete
--

