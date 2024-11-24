CREATE DATABASE mma;

USE mma;

CREATE TABLE organizacao (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30),
    localidade VARCHAR(30)
);

CREATE TABLE lutador (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30),
    localidade VARCHAR(30),
    organizacao_id INT,
    CONSTRAINT fk_organizacao FOREIGN KEY (organizacao_id) REFERENCES organizacao(id)
);

CREATE TABLE evento (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    data DATE NOT NULL,
    organizacao_id INT NOT NULL,
    CONSTRAINT fk_organizacao_evento FOREIGN KEY (organizacao_id) REFERENCES organizacao(id)
);

CREATE TABLE luta (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    lutador1_id INT NOT NULL,
    lutador2_id INT NOT NULL,
    evento_id INT NOT NULL,
    CONSTRAINT fk_lutador1 FOREIGN KEY (lutador1_id) REFERENCES lutador(id),
    CONSTRAINT fk_lutador2 FOREIGN KEY (lutador2_id) REFERENCES lutador(id),
    CONSTRAINT fk_evento_luta FOREIGN KEY (evento_id) REFERENCES evento(id),
    CONSTRAINT chk_lutadores_diferentes CHECK (lutador1_id <> lutador2_id)
);

INSERT INTO organizacao (nome, localidade) VALUES ('UFC', 'Estados Unidos');
INSERT INTO organizacao (nome, localidade) VALUES ('Jungle Fight', 'Brasil');

INSERT INTO evento (nome, data, organizacao_id) VALUES ('UFC 300', '2024-12-15', 1);
INSERT INTO evento (nome, data, organizacao_id) VALUES ('Jungle Fight 100', '2024-12-20', 2);

INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Jon Jones', 'Estados Unidos', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Israel Adesanya', 'Nigéria', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Alexander Volkanovski', 'Austrália', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Kamaru Usman', 'Nigéria', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Francis Ngannou', 'Camarões', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Conor McGregor', 'Irlanda', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Charles Oliveira', 'Brasil', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Dustin Poirier', 'Estados Unidos', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Max Holloway', 'Havaí', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Glover Teixeira', 'Brasil', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Robert Whittaker', 'Austrália', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Justin Gaethje', 'Estados Unidos', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Colby Covington', 'Estados Unidos', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Henry Cejudo', 'Estados Unidos', 1);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Paulo Costa', 'Brasil', 1);

INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('José Aldo', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Anderson Silva', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Shogun Rua', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Lyoto Machida', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Fabricio Werdum', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Renan Barão', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Bibiano Fernandes', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Eduardo Dantas', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Marlon Moraes', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Patricky Pitbull', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Patrício Pitbull', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Thiago Santos', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Johnny Walker', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Demian Maia', 'Brasil', 2);
INSERT INTO lutador (nome, localidade, organizacao_id) VALUES ('Rafael dos Anjos', 'Brasil', 2);

INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (1, 2, 1);
INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (3, 4, 1);
INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (5, 6, 1);
INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (7, 8, 1);
INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (9, 10, 1);

INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (16, 17, 2);
INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (18, 19, 2);
INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (20, 21, 2);
INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (22, 23, 2);
INSERT INTO luta (lutador1_id, lutador2_id, evento_id) VALUES (24, 25, 2);
