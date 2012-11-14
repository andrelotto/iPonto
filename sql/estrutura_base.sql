--
-- PostgreSQL database dump
--

-- Started on 2009-05-29 01:37:37 BRT

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1478 (class 1259 OID 16386)
-- Dependencies: 6
-- Name: clientes; Type: TABLE; Schema: public; Owner: wponto; Tablespace: 
--

CREATE TABLE clientes (
);


ALTER TABLE public.clientes OWNER TO wponto;

--
-- TOC entry 1479 (class 1259 OID 16389)
-- Dependencies: 1754 1755 1756 1757 6
-- Name: funcionarios; Type: TABLE; Schema: public; Owner: wponto; Tablespace: 
--

CREATE TABLE funcionarios (
    id_funcionario integer NOT NULL,
    nome character varying(150) NOT NULL,
    endereco character varying(250),
    bairro character varying(100),
    cidade character varying(150),
    uf character varying(2),
    telefone character varying(15),
    cargo character varying(100),
    c_trabalho character varying(20),
    id_unidade integer NOT NULL,
    login character varying(30) NOT NULL,
    senha character varying(50) NOT NULL,
    data_admissao date,
    horas_dia time without time zone,
    horas_mes integer,
    hora_entrada_tarde time without time zone DEFAULT '00:00:00'::time without time zone,
    hora_saida_manha time without time zone DEFAULT '00:00:00'::time without time zone,
    hora_saida_tarde time without time zone DEFAULT '00:00:00'::time without time zone,
    hora_entrada_manha time without time zone DEFAULT '00:00:00'::time without time zone
);


ALTER TABLE public.funcionarios OWNER TO wponto;

--
-- TOC entry 1480 (class 1259 OID 16399)
-- Dependencies: 1479 6
-- Name: funcionarios_id_funcionario_seq; Type: SEQUENCE; Schema: public; Owner: wponto
--

CREATE SEQUENCE funcionarios_id_funcionario_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.funcionarios_id_funcionario_seq OWNER TO wponto;

--
-- TOC entry 1774 (class 0 OID 0)
-- Dependencies: 1480
-- Name: funcionarios_id_funcionario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wponto
--

ALTER SEQUENCE funcionarios_id_funcionario_seq OWNED BY funcionarios.id_funcionario;


--
-- TOC entry 1481 (class 1259 OID 16401)
-- Dependencies: 6
-- Name: ip_cliente; Type: TABLE; Schema: public; Owner: wponto; Tablespace: 
--

CREATE TABLE ip_cliente (
);


ALTER TABLE public.ip_cliente OWNER TO wponto;

--
-- TOC entry 1482 (class 1259 OID 16404)
-- Dependencies: 1759 6
-- Name: pontos; Type: TABLE; Schema: public; Owner: wponto; Tablespace: 
--

CREATE TABLE pontos (
    id_ponto integer NOT NULL,
    id_funcionario integer,
    tipo integer NOT NULL,
    data_hora timestamp without time zone NOT NULL,
    ip_ponto character varying(15) DEFAULT '0.0.0.0'::character varying
);


ALTER TABLE public.pontos OWNER TO wponto;

--
-- TOC entry 1483 (class 1259 OID 16408)
-- Dependencies: 6 1482
-- Name: pontos_id_ponto_seq; Type: SEQUENCE; Schema: public; Owner: wponto
--

CREATE SEQUENCE pontos_id_ponto_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pontos_id_ponto_seq OWNER TO wponto;

--
-- TOC entry 1775 (class 0 OID 0)
-- Dependencies: 1483
-- Name: pontos_id_ponto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wponto
--

ALTER SEQUENCE pontos_id_ponto_seq OWNED BY pontos.id_ponto;


--
-- TOC entry 1484 (class 1259 OID 16410)
-- Dependencies: 6
-- Name: unidades; Type: TABLE; Schema: public; Owner: wponto; Tablespace: 
--

CREATE TABLE unidades (
    id_unidade integer NOT NULL,
    nome_fantasia character varying(40) NOT NULL,
    endereco character varying(40),
    bairro character varying(40),
    cidade character varying(40),
    uf character varying(2),
    telefone character varying(15),
    gerente character varying(40),
    email character varying(50),
    obs text,
    razao_social character varying(100),
    cnpj character varying(25),
    id_ip integer
);


ALTER TABLE public.unidades OWNER TO wponto;

--
-- TOC entry 1485 (class 1259 OID 16416)
-- Dependencies: 6 1484
-- Name: unidades_id_unidade_seq; Type: SEQUENCE; Schema: public; Owner: wponto
--

CREATE SEQUENCE unidades_id_unidade_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.unidades_id_unidade_seq OWNER TO wponto;

--
-- TOC entry 1776 (class 0 OID 0)
-- Dependencies: 1485
-- Name: unidades_id_unidade_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wponto
--

ALTER SEQUENCE unidades_id_unidade_seq OWNED BY unidades.id_unidade;


--
-- TOC entry 1486 (class 1259 OID 16418)
-- Dependencies: 6
-- Name: usuarios; Type: TABLE; Schema: public; Owner: wponto; Tablespace: 
--

CREATE TABLE usuarios (
    id_usuario integer NOT NULL,
    usuario character varying(40),
    senha character(32) NOT NULL,
    tipo character(1)
);


ALTER TABLE public.usuarios OWNER TO wponto;

--
-- TOC entry 1487 (class 1259 OID 16421)
-- Dependencies: 1486 6
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: wponto
--

CREATE SEQUENCE usuarios_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_usuario_seq OWNER TO wponto;

--
-- TOC entry 1777 (class 0 OID 0)
-- Dependencies: 1487
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wponto
--

ALTER SEQUENCE usuarios_id_usuario_seq OWNED BY usuarios.id_usuario;


--
-- TOC entry 1758 (class 2604 OID 16423)
-- Dependencies: 1480 1479
-- Name: id_funcionario; Type: DEFAULT; Schema: public; Owner: wponto
--

ALTER TABLE funcionarios ALTER COLUMN id_funcionario SET DEFAULT nextval('funcionarios_id_funcionario_seq'::regclass);


--
-- TOC entry 1760 (class 2604 OID 16424)
-- Dependencies: 1483 1482
-- Name: id_ponto; Type: DEFAULT; Schema: public; Owner: wponto
--

ALTER TABLE pontos ALTER COLUMN id_ponto SET DEFAULT nextval('pontos_id_ponto_seq'::regclass);


--
-- TOC entry 1761 (class 2604 OID 16425)
-- Dependencies: 1485 1484
-- Name: id_unidade; Type: DEFAULT; Schema: public; Owner: wponto
--

ALTER TABLE unidades ALTER COLUMN id_unidade SET DEFAULT nextval('unidades_id_unidade_seq'::regclass);


--
-- TOC entry 1762 (class 2604 OID 16426)
-- Dependencies: 1487 1486
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: wponto
--

ALTER TABLE usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('usuarios_id_usuario_seq'::regclass);


--
-- TOC entry 1766 (class 2606 OID 16428)
-- Dependencies: 1486 1486
-- Name: id_usuario; Type: CONSTRAINT; Schema: public; Owner: wponto; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT id_usuario PRIMARY KEY (id_usuario);


--
-- TOC entry 1763 (class 1259 OID 16429)
-- Dependencies: 1479
-- Name: index_id_funcionario; Type: INDEX; Schema: public; Owner: wponto; Tablespace: 
--

CREATE UNIQUE INDEX index_id_funcionario ON funcionarios USING btree (id_funcionario);


--
-- TOC entry 1764 (class 1259 OID 16430)
-- Dependencies: 1484
-- Name: index_id_unidade; Type: INDEX; Schema: public; Owner: wponto; Tablespace: 
--

CREATE UNIQUE INDEX index_id_unidade ON unidades USING btree (id_unidade);


--
-- TOC entry 1767 (class 2606 OID 16431)
-- Dependencies: 1764 1479 1484
-- Name: $1; Type: FK CONSTRAINT; Schema: public; Owner: wponto
--

ALTER TABLE ONLY funcionarios
    ADD CONSTRAINT "$1" FOREIGN KEY (id_unidade) REFERENCES unidades(id_unidade) ON UPDATE CASCADE;


--
-- TOC entry 1768 (class 2606 OID 16436)
-- Dependencies: 1482 1479 1763
-- Name: $1; Type: FK CONSTRAINT; Schema: public; Owner: wponto
--

ALTER TABLE ONLY pontos
    ADD CONSTRAINT "$1" FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id_funcionario) ON UPDATE CASCADE;


--
-- TOC entry 1773 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2009-05-29 01:37:37 BRT

--
-- PostgreSQL database dump complete
--

