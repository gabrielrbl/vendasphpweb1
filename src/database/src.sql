CREATE TABLE cliente(
	id SERIAL PRIMARY KEY NOT NULL,
	nome VARCHAR(60),
	cpf VARCHAR(15),
	telefone VARCHAR(11)
);

CREATE TABLE produto(
	id SERIAL PRIMARY KEY NOT NULL,
	nome VARCHAR(50),
	valor DECIMAL(7,2),
	quantidade INTEGER
);

CREATE TABLE venda(
	id SERIAL PRIMARY KEY NOT NULL,
	idcliente INTEGER,
	valortotal DECIMAL(7,2),
	FOREIGN KEY (idcliente) REFERENCES cliente(id)
);

CREATE TABLE itensvenda(
	id SERIAL PRIMARY KEY NOT NULL,
	idvenda INTEGER,
	idproduto INTEGER,
	quantidade DECIMAL(7,2),
	valorunitario DECIMAL(7,2),
	FOREIGN KEY (idvenda) REFERENCES venda(id) ON DELETE CASCADE,
	FOREIGN KEY (idproduto) REFERENCES produto(id)
);

CREATE OR REPLACE FUNCTION SET_ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
		UPDATE venda SET valortotal = valortotal + (NEW.quantidade * NEW.valorunitario) WHERE id = NEW.idvenda;
		UPDATE produto SET quantidade = quantidade - NEW.quantidade WHERE id = NEW.idproduto;
		RETURN NULL;
  END;
  $$ language plpgsql;
  
CREATE OR REPLACE FUNCTION ATT_ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
		UPDATE venda SET valortotal = valortotal - ((OLD.quantidade * OLD.valorunitario) * (NEW.quantidade * NEW.valorunitario)) WHERE id = NEW.idvenda;
		UPDATE produto SET quantidade = quantidade + (OLD.quantidade - NEW.quantidade) WHERE id = NEW.idproduto;
  END;
  $$ language plpgsql;

CREATE OR REPLACE FUNCTION DEL_ITEM_VENDA() RETURNS TRIGGER AS $$
  BEGIN
  	UPDATE venda SET valortotal = valortotal - (OLD.quantidade * OLD.valorunitario) WHERE id = OLD.idvenda;
		UPDATE produto SET quantidade = quantidade + OLD.quantidade WHERE id = OLD.idproduto;
		RETURN NULL;
  END;
  $$ language plpgsql;

CREATE OR REPLACE FUNCTION DEL_VENDA() RETURNS TRIGGER AS $$
  BEGIN
  	DELETE FROM itensvenda WHERE idvenda = OLD.id;
		RETURN NULL;
  END;
  $$ language plpgsql;

CREATE TRIGGER setitemvenda
AFTER INSERT ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE SET_ITEM_VENDA();

CREATE TRIGGER attitemvenda
AFTER UPDATE ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE ATT_ITEM_VENDA();

CREATE TRIGGER delitemvenda
AFTER DELETE ON itensvenda
FOR EACH ROW EXECUTE PROCEDURE DEL_ITEM_VENDA();

CREATE TRIGGER delvenda
AFTER DELETE ON venda
FOR EACH ROW EXECUTE PROCEDURE DEL_VENDA();