--
-- PostgreSQL database dump
--

-- Dumped from database version 14.5
-- Dumped by pg_dump version 14.5

-- Started on 2023-07-30 10:42:01

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
-- TOC entry 214 (class 1259 OID 33659)
-- Name: applications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.applications (
    id integer NOT NULL,
    type character varying NOT NULL,
    amount integer NOT NULL,
    rate real NOT NULL,
    date_open date DEFAULT CURRENT_DATE NOT NULL,
    date_close date DEFAULT CURRENT_DATE NOT NULL,
    legal_id integer,
    individual_id integer
);


ALTER TABLE public.applications OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 33658)
-- Name: application_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.application_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.application_id_seq OWNER TO postgres;

--
-- TOC entry 3342 (class 0 OID 0)
-- Dependencies: 213
-- Name: application_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.application_id_seq OWNED BY public.applications.id;


--
-- TOC entry 217 (class 1259 OID 33767)
-- Name: application_id_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.applications ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.application_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 210 (class 1259 OID 33621)
-- Name: individual; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.individual (
    id integer NOT NULL,
    surname character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    patronymic character varying(255) NOT NULL,
    date_birth date DEFAULT CURRENT_DATE NOT NULL,
    inn bigint NOT NULL,
    serial integer NOT NULL,
    number integer NOT NULL,
    date_issue date DEFAULT CURRENT_DATE NOT NULL
);


ALTER TABLE public.individual OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 33743)
-- Name: individual_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.individual ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.individual_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 209 (class 1259 OID 33620)
-- Name: individuals_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.individuals_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.individuals_id_seq OWNER TO postgres;

--
-- TOC entry 3343 (class 0 OID 0)
-- Dependencies: 209
-- Name: individuals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.individuals_id_seq OWNED BY public.individual.id;


--
-- TOC entry 212 (class 1259 OID 33650)
-- Name: legal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.legal (
    id integer NOT NULL,
    surname character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    patronymic character varying(255) NOT NULL,
    inn_chief bigint NOT NULL,
    name_org character varying(255) NOT NULL,
    ogrn bigint NOT NULL,
    inn bigint NOT NULL,
    kpp bigint NOT NULL,
    address character varying(255) NOT NULL
);


ALTER TABLE public.legal OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 33649)
-- Name: legal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.legal_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.legal_id_seq OWNER TO postgres;

--
-- TOC entry 3344 (class 0 OID 0)
-- Dependencies: 211
-- Name: legal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.legal_id_seq OWNED BY public.legal.id;


--
-- TOC entry 216 (class 1259 OID 33766)
-- Name: legal_id_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.legal ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.legal_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 3333 (class 0 OID 33659)
-- Dependencies: 214
-- Data for Name: applications; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3329 (class 0 OID 33621)
-- Dependencies: 210
-- Data for Name: individual; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3331 (class 0 OID 33650)
-- Dependencies: 212
-- Data for Name: legal; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3345 (class 0 OID 0)
-- Dependencies: 213
-- Name: application_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.application_id_seq', 1, false);


--
-- TOC entry 3346 (class 0 OID 0)
-- Dependencies: 217
-- Name: application_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.application_id_seq1', 1, false);


--
-- TOC entry 3347 (class 0 OID 0)
-- Dependencies: 215
-- Name: individual_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.individual_id_seq', 6, true);


--
-- TOC entry 3348 (class 0 OID 0)
-- Dependencies: 209
-- Name: individuals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.individuals_id_seq', 1, false);


--
-- TOC entry 3349 (class 0 OID 0)
-- Dependencies: 211
-- Name: legal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.legal_id_seq', 1, false);


--
-- TOC entry 3350 (class 0 OID 0)
-- Dependencies: 216
-- Name: legal_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.legal_id_seq1', 1, false);


--
-- TOC entry 3186 (class 2606 OID 33666)
-- Name: applications application_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT application_pkey PRIMARY KEY (id);


--
-- TOC entry 3182 (class 2606 OID 33628)
-- Name: individual individuals_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.individual
    ADD CONSTRAINT individuals_pkey PRIMARY KEY (id);


--
-- TOC entry 3184 (class 2606 OID 33657)
-- Name: legal legal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.legal
    ADD CONSTRAINT legal_pkey PRIMARY KEY (id);


--
-- TOC entry 3187 (class 2606 OID 33790)
-- Name: applications individual_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT individual_id FOREIGN KEY (individual_id) REFERENCES public.individual(id) NOT VALID;


--
-- TOC entry 3188 (class 2606 OID 33795)
-- Name: applications legal_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT legal_id FOREIGN KEY (legal_id) REFERENCES public.legal(id) NOT VALID;


-- Completed on 2023-07-30 10:42:01

--
-- PostgreSQL database dump complete
--

