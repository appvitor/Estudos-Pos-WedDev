INSERT INTO cargo (nome) VALUES('Presidente');
INSERT INTO cargo (nome) VALUES('Senador');
INSERT INTO cargo (nome) VALUES('Deputado Federal');
INSERT INTO cargo (nome) VALUES('Governador');
INSERT INTO cargo (nome) VALUES('Deputado Estadual');

INSERT INTO partido (nome, legenda) VALUES('Movimento Democrático Brasileiro','MDB');
INSERT INTO partido (nome, legenda) VALUES('Partido dos Trabalhadores','PT');
INSERT INTO partido (nome, legenda) VALUES('Partido da Social Democracia Brasileira','PSDB');
INSERT INTO partido (nome, legenda) VALUES('Progressistas','PP');
INSERT INTO partido (nome, legenda) VALUES('Partido Democrático Trabalhista','PDT');
INSERT INTO partido (nome, legenda) VALUES('Partido Trabalhista Brasileiro','PTB');
INSERT INTO partido (nome, legenda) VALUES('Democratas','DEM');
INSERT INTO partido (nome, legenda) VALUES('Partido da República','PR');
INSERT INTO partido (nome, legenda) VALUES('Partido Socialista Brasileiro','PSB');
INSERT INTO partido (nome, legenda) VALUES('Partido Popular Socialista','PPS');
INSERT INTO partido (nome, legenda) VALUES('Partido Social Cristão','PSC');
INSERT INTO partido (nome, legenda) VALUES('Partido Republicano Brasileiro','PRB');
INSERT INTO partido (nome, legenda) VALUES('Partido Comunista do Brasil','PCdoB');
INSERT INTO partido (nome, legenda) VALUES('Partido Verde','PV');
INSERT INTO partido (nome, legenda) VALUES('Partido Social Democrático','PSD');
INSERT INTO partido (nome, legenda) VALUES('Partido Republicano Progressista','PRP');
INSERT INTO partido (nome, legenda) VALUES('Partido Social Liberal','PSL');
INSERT INTO partido (nome, legenda) VALUES('Partido da Mobilização Nacional','PMN');
INSERT INTO partido (nome, legenda) VALUES('Partido Humanista da Solidariedade','PHS');
INSERT INTO partido (nome, legenda) VALUES('Solidariedade','SD');
INSERT INTO partido (nome, legenda) VALUES('Partido Trabalhista Cristão','PTC');
INSERT INTO partido (nome, legenda) VALUES('Avante','AVANTE');
INSERT INTO partido (nome, legenda) VALUES('Democracia Cristã','DC');
INSERT INTO partido (nome, legenda) VALUES('Podemos','PODE');
INSERT INTO partido (nome, legenda) VALUES('Partido Socialismo e Liberdade','PSOL');
INSERT INTO partido (nome, legenda) VALUES('Partido Renovador Trabalhista Brasileiro','PRTB');
INSERT INTO partido (nome, legenda) VALUES('Partido Republicano da Ordem Social','PROS');
INSERT INTO partido (nome, legenda) VALUES('Patriota','PATRI');
INSERT INTO partido (nome, legenda) VALUES('Partido da Mulher Brasileira','PMB');
INSERT INTO partido (nome, legenda) VALUES('Partido Pátria Livre','PPL');
INSERT INTO partido (nome, legenda) VALUES('Partido Novo','NOVO');
INSERT INTO partido (nome, legenda) VALUES('Rede Sustentabilidade','REDE');
INSERT INTO partido (nome, legenda) VALUES('Partido Socialista dos Trabalhadores Unificado','PSTU');
INSERT INTO partido (nome, legenda) VALUES('Partido Comunista Brasileiro','PCB');
INSERT INTO partido (nome, legenda) VALUES('Partido da Causa Operária','PCO');


INSERT INTO estado (nome, sigla) VALUES('Brasil','BR');
INSERT INTO estado (nome, sigla) VALUES('Acre','AC');
INSERT INTO estado (nome, sigla) VALUES('Alagoas','AL');
INSERT INTO estado (nome, sigla) VALUES('Amapá','AP');
INSERT INTO estado (nome, sigla) VALUES('Amazonas','AM');
INSERT INTO estado (nome, sigla) VALUES('Bahia','BA');
INSERT INTO estado (nome, sigla) VALUES('Ceará','CE');
INSERT INTO estado (nome, sigla) VALUES('Distrito Federal','DF');
INSERT INTO estado (nome, sigla) VALUES('Espírito Santo','ES');
INSERT INTO estado (nome, sigla) VALUES('Goiás','GO');
INSERT INTO estado (nome, sigla) VALUES('Maranhão','MA');
INSERT INTO estado (nome, sigla) VALUES('Mato Grosso','MT');
INSERT INTO estado (nome, sigla) VALUES('Mato Grosso do Sul','MS');
INSERT INTO estado (nome, sigla) VALUES('Minas Gerais','MG');
INSERT INTO estado (nome, sigla) VALUES('Pará','PA)');
INSERT INTO estado (nome, sigla) VALUES('Paraíba','PB');
INSERT INTO estado (nome, sigla) VALUES('Paraná','PR');
INSERT INTO estado (nome, sigla) VALUES('Pernambuco','PE');
INSERT INTO estado (nome, sigla) VALUES('Piauí','PI');
INSERT INTO estado (nome, sigla) VALUES('Rio de Janeiro','RJ');
INSERT INTO estado (nome, sigla) VALUES('Rio Grande do Norte','RN');
INSERT INTO estado (nome, sigla) VALUES('Rio Grande do Sul','RS');
INSERT INTO estado (nome, sigla) VALUES('Rondônia','RO');
INSERT INTO estado (nome, sigla) VALUES('Roraima','RR');
INSERT INTO estado (nome, sigla) VALUES('Santa Catarina','SC');
INSERT INTO estado (nome, sigla) VALUES('São Paulo','SP');
INSERT INTO estado (nome, sigla) VALUES('Sergipe','SE');
INSERT INTO estado (nome, sigla) VALUES('Tocantins','TO');

INSERT INTO eleicao (nome, ano) VALUES('Eleição de 2014',2018);

INSERT INTO tipo (nome) VALUES('Apartamento');
INSERT INTO tipo (nome) VALUES('Veículo');
INSERT INTO tipo (nome) VALUES('Terreno');
INSERT INTO tipo (nome) VALUES('Casa');
INSERT INTO tipo (nome) VALUES('Propriedade Rural');

INSERT INTO candidato (idEleicao, idEstado, idPartido, idCargo, nome, cpf, apto) 
VALUES(1,1,1,1,'Maria de Souza','111.111.111-11','S');

INSERT INTO candidato (idEleicao, idEstado, idPartido, idCargo, nome, cpf, apto) 
VALUES(1,1,2,1,'João de Souza','222.222.222-22','S');

INSERT INTO candidato (idEleicao, idEstado, idPartido, idCargo, nome, cpf, apto) 
VALUES(1,1,3,1,'Carlos Aparecido','333.333.333-33','S');

INSERT INTO bem (idTipo, idCandidato, descricao, valor) VALUES(1,1,'Apartamento',300000.00);
INSERT INTO bem (idTipo, idCandidato, descricao, valor) VALUES(2,1,'Carro',100000.00);

INSERT INTO bem (idTipo, idCandidato, descricao, valor) VALUES(1,2,'Apartamento',500000.00);
INSERT INTO bem (idTipo, idCandidato, descricao, valor) VALUES(2,2,'Carro',50000.00);

INSERT INTO usuario (nome, usuario, senha, administrador) VALUES('Administrador','admin','admin','S');
INSERT INTO usuario (nome, usuario, senha, administrador) VALUES('Consulta','consulta','consulta','N');



