CREATE TABLE produtos (
	id_produto INT UNSIGNED AUTO_INCREMENT,
	nome_produto VARCHAR(50) NOT NULL,
	qtd_estoque MEDIUMINT UNSIGNED NOT NULL,
	preco DECIMAL(9,2) NOT NULL,	#1234567.89
		PRIMARY KEY (id_produto)
);

CREATE TABLE clientes (
	id_cliente INT UNSIGNED AUTO_INCREMENT,
	cnpj CHAR(18) UNIQUE,
	cep CHAR(9) UNIQUE,
	email VARCHAR(50) NOT NULL UNIQUE,
	telefone CHAR(12) NOT NULL, #2199988-7766
		PRIMARY KEY (id_cliente)
);

CREATE TABLE pedidos (
	id_pedido INT UNSIGNED AUTO_INCREMENT,
		PRIMARY KEY (id_pedido)
);

CREATE TABLE pedidos_produtos (
	pedido_id INT UNSIGNED NOT NULL,
	produto_id INT UNSIGNED NOT NULL,
		FOREIGN KEY (pedido_id) REFERENCES pedidos (id_pedido),
		FOREIGN KEY (produto_id) REFERENCES produtos (id_produto)
);

CREATE TABLE financeiro (
	periodo DATE NOT NULL UNIQUE, #'AAAA-MM-DD'
	ganhos DECIMAL(11, 2) NOT NULL, #123456789.10
	despesas DECIMAL(11, 2) NOT NULL
);
