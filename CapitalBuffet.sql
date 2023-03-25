CREATE TABLE usuarios (
	id_usuario INT UNSIGNED AUTO_INCREMENT,
	nome_usuario VARCHAR(100) NOT NULL,
	cpf CHAR(14) UNIQUE,
	cnpj CHAR(18) UNIQUE,
	cep CHAR(9) NOT NULL,
	email_usuario VARCHAR(50) NOT NULL UNIQUE,
	telefone_usuario CHAR(12) NOT NULL, #2199988-7766
	funcionario CHAR(1) NOT NULL, #S ou N
		PRIMARY KEY (id_usuario)
);

CREATE TABLE registros_financeiros (
	id_registro INT UNSIGNED AUTO_INCREMENT,
	periodo DATE NOT NULL, #'AAAA-MM-DD'
	valor DECIMAL(11, 2) NOT NULL, #123456789.10
	descricao TEXT,
		PRIMARY KEY (id_registro)
);

CREATE TABLE pedidos (
	id_pedido INT UNSIGNED AUTO_INCREMENT,
	tipo_evento TINYTEXT NOT NULL,
	data_pedido DATE NOT NULL, #'AAAA-MM-DD'
	data_evento DATE NOT NULL, #'AAAA-MM-DD'
	endereco TEXT NOT NULL,
	qtd_convidados SMALLINT UNSIGNED NOT NULL,
		PRIMARY KEY (id_pedido),
  
	usuario_id INT UNSIGNED NOT NULL,
		FOREIGN KEY (usuario_id) REFERENCES usuarios (id_usuario)
);

CREATE TABLE funcionarios (
	cpf_funcionario CHAR(14),
	nome_funcionario VARCHAR(100) NOT NULL,
	cargo TINYTEXT NOT NULL,
	salario DECIMAL(11, 2) NOT NULL,	#123456789.10
	telefone_funcionario CHAR(12) NOT NULL,	#2199988-7766
	email_funcionario VARCHAR(50) NOT NULL UNIQUE,
		PRIMARY KEY (cpf_funcionario)
);

CREATE TABLE pedido_funcionarios (
	pedido_id INT UNSIGNED NOT NULL,
	funcionario_cpf CHAR(14) NOT NULL,
		FOREIGN KEY (pedido_id) REFERENCES pedidos (id_pedido),
		FOREIGN KEY (funcionario_cpf) REFERENCES funcionarios (cpf_funcionario)
);

CREATE TABLE produtos (
	id_produto INT UNSIGNED AUTO_INCREMENT,
	nome_produto VARCHAR(100) NOT NULL,
	preco_produto DECIMAL(11, 2) NOT NULL, #123456789.10
	estoque_produto INT UNSIGNED NOT NULL,
	descricao_produto TEXT,
		PRIMARY KEY (id_produto)
);

CREATE TABLE pedido_produtos (
	pedido_id INT UNSIGNED NOT NULL,
	produto_id INT UNSIGNED NOT NULL,
	quantidade_p SMALLINT UNSIGNED NOT NULL,
		FOREIGN KEY (pedido_id) REFERENCES pedidos (id_pedido),
		FOREIGN KEY (produto_id) REFERENCES produtos (id_produto)
);

CREATE TABLE comidas (
	id_comida INT UNSIGNED AUTO_INCREMENT,
	nome_comida VARCHAR(100) NOT NULL,
	preco_comida DECIMAL(11, 2) NOT NULL, #123456789.10
	estoque_comida INT UNSIGNED NOT NULL,
	tipo TINYTEXT NOT NULL,
  	periodo TINYTEXT NOT NULL,
		PRIMARY KEY (id_comida)
);

CREATE TABLE pedido_comidas (
	pedido_id INT UNSIGNED NOT NULL,
	comida_id INT UNSIGNED NOT NULL,
	quantidade_c SMALLINT UNSIGNED NOT NULL,
		FOREIGN KEY (pedido_id) REFERENCES pedidos (id_pedido),
		FOREIGN KEY (comida_id) REFERENCES comidas (id_comida)
);