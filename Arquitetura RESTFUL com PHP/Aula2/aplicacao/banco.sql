CREATE TABLE cliente (
  idCliente INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  nome VARCHAR(200)  NOT NULL  ,
  cpf CHAR(14)  NOT NULL    ,
PRIMARY KEY(idCliente));


CREATE TABLE usuario (
  idUsuario INTEGER  NOT NULL   AUTO_INCREMENT,
  nome VARCHAR(200)  NULL  ,
  usuario VARCHAR(50)  NULL  ,
  senha VARCHAR(50)  NULL    ,
PRIMARY KEY(idUsuario));



CREATE TABLE permissao (
  idPermissao INTEGER  NOT NULL   AUTO_INCREMENT,
  descricao VARCHAR(100)  NULL  ,
  chave VARCHAR(100)  NULL    ,
PRIMARY KEY(idPermissao));



CREATE TABLE usuario_permissao (
  idUsuario INTEGER  NOT NULL  ,
  idPermissao INTEGER  NOT NULL    ,
PRIMARY KEY(idUsuario, idPermissao)  ,
INDEX usuario_has_permissao_FKIndex1(idUsuario)  ,
INDEX usuario_has_permissao_FKIndex2(idPermissao),
  FOREIGN KEY(idUsuario)
    REFERENCES usuario(idUsuario)
      ON DELETE CASCADE
      ON UPDATE NO ACTION,
  FOREIGN KEY(idPermissao)
    REFERENCES permissao(idPermissao)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



INSERT INTO permissao (chave, descricao) VALUES('REALIZAR_LOGIN','Realizar login no sistema');

INSERT INTO permissao (chave, descricao) VALUES('LISTAR_CLIENTE','Lista clientes cadastrados');
INSERT INTO permissao (chave, descricao) VALUES('RECUPERAR_CLIENTE','Recuperar cliente cadastrado');
INSERT INTO permissao (chave, descricao) VALUES('EXCLUIR_CLIENTE','Excluir cliente cadastrado');
INSERT INTO permissao (chave, descricao) VALUES('CRIAR_CLIENTE','Criar um novo cliente');
INSERT INTO permissao (chave, descricao) VALUES('ALTERAR_CLIENTE','Alterar cliente cadastrado');

INSERT INTO permissao (chave, descricao) VALUES('LISTAR_USUARIO','Lista usuários cadastrados');
INSERT INTO permissao (chave, descricao) VALUES('RECUPERAR_USUARIO','Recuperar usuário cadastrado');
INSERT INTO permissao (chave, descricao) VALUES('EXCLUIR_USUARIO','Excluir usuário cadastrado');
INSERT INTO permissao (chave, descricao) VALUES('CRIAR_USUARIO','Criar um novo usuário');
INSERT INTO permissao (chave, descricao) VALUES('ALTERAR_USUARIO','Alterar usuário cadastrado');

INSERT INTO permissao (chave, descricao) VALUES('LISTAR_PERMISSAO','Lista permissões cadastrados');
INSERT INTO permissao (chave, descricao) VALUES('RECUPERAR_PERMISSAO','Recuperar permissão cadastrado');
INSERT INTO permissao (chave, descricao) VALUES('EXCLUIR_PERMISSAO','Excluir permissão cadastrado');
INSERT INTO permissao (chave, descricao) VALUES('CRIAR_PERMISSAO','Criar um novo permissão');
INSERT INTO permissao (chave, descricao) VALUES('ALTERAR_PERMISSAO','Alterar permissão cadastrado');


INSERT INTO usuario_permissao(idPermissao, idUsuario)
SELECT idPermissao, 12 FROM permissao as p
WHERE NOT EXISTS(
	SELECT 1 
    FROM usuario_permissao 
    WHERE idPermissao=p.idPermissao AND idUsuario=12
)