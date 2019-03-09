CREATE TABLE partido (
  idPartido INTEGER  NOT NULL   AUTO_INCREMENT,
  nome VARCHAR(100)  NULL  ,
  legenda VARCHAR(10)  NULL    ,
PRIMARY KEY(idPartido));



CREATE TABLE estado (
  idEstado INTEGER  NOT NULL   AUTO_INCREMENT,
  nome VARCHAR(100)  NULL  ,
  sigla CHAR(2)  NULL    ,
PRIMARY KEY(idEstado));



CREATE TABLE usuario (
  idUsuario INTEGER UNSIGNED  NOT NULL  ,
  nome VARCHAR(250)  NULL  ,
  usuario VARCHAR(100)  NULL  ,
  senha VARCHAR(100)  NULL  ,
  administrador CHAR(1)  NULL    ,
PRIMARY KEY(idUsuario));



CREATE TABLE tipo (
  idTipo INTEGER  NOT NULL   AUTO_INCREMENT,
  nome VARCHAR(100)  NULL    ,
PRIMARY KEY(idTipo));



CREATE TABLE cargo (
  idCargo INTEGER  NOT NULL   AUTO_INCREMENT,
  nome VARCHAR(100)  NULL    ,
PRIMARY KEY(idCargo));



CREATE TABLE eleicao (
  idEleicao INTEGER  NOT NULL   AUTO_INCREMENT,
  nome VARCHAR(100)  NULL  ,
  ano INTEGER  NULL    ,
PRIMARY KEY(idEleicao));



CREATE TABLE candidato (
  idCandidato INTEGER  NOT NULL   AUTO_INCREMENT,
  idEleicao INTEGER  NOT NULL  ,
  idEstado INTEGER  NOT NULL  ,
  idPartido INTEGER  NOT NULL  ,
  idCargo INTEGER  NOT NULL  ,
  nome VARCHAR(250)  NULL  ,
  cpf VARCHAR(14)  NULL  ,
  apto CHAR(1)  NULL    ,
PRIMARY KEY(idCandidato)  ,
INDEX candidato_FKIndex1(idCargo)  ,
INDEX candidato_FKIndex2(idPartido)  ,
INDEX candidato_FKIndex3(idEstado)  ,
INDEX candidato_FKIndex4(idEleicao),
  FOREIGN KEY(idCargo)
    REFERENCES cargo(idCargo)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idPartido)
    REFERENCES partido(idPartido)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idEstado)
    REFERENCES estado(idEstado)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idEleicao)
    REFERENCES eleicao(idEleicao)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE bem (
  idBem INTEGER  NOT NULL   AUTO_INCREMENT,
  idTipo INTEGER  NOT NULL  ,
  idCandidato INTEGER  NOT NULL  ,
  descricao VARCHAR(250)  NULL  ,
  valor DECIMAL(10,2)  NULL    ,
PRIMARY KEY(idBem)  ,
INDEX bem_FKIndex1(idCandidato)  ,
INDEX bem_FKIndex2(idTipo),
  FOREIGN KEY(idCandidato)
    REFERENCES candidato(idCandidato)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idTipo)
    REFERENCES tipo(idTipo)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



