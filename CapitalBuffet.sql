CREATE TABLE usuarios (
	id_usuario INT UNSIGNED AUTO_INCREMENT,
	nome_usuario VARCHAR(100) NOT NULL,
	senha VARCHAR(100) NOT NULL,
	cpf CHAR(14) UNIQUE,	#999.999.999-99
	cnpj CHAR(18) UNIQUE,	#99.999.999/9999-99 
	cep CHAR(9) NOT NULL,	#99999-999
	email_usuario VARCHAR(50) NOT NULL UNIQUE,
	telefone_usuario CHAR(15) NOT NULL, #(99) 99999-9999
		PRIMARY KEY (id_usuario)
);

CREATE TABLE registros_financeiros (
	id_registro INT UNSIGNED AUTO_INCREMENT,
	periodo DATE NOT NULL, #'AAAA-MM-DD'
	valor DECIMAL(11, 2) NOT NULL, #123456789.10
	descricao TEXT NOT NULL,
		PRIMARY KEY (id_registro)
);

CREATE TABLE pedidos (
	id_pedido INT UNSIGNED AUTO_INCREMENT,
	tipo_evento TINYTEXT NOT NULL,
	orcamento DECIMAL(11, 2) NOT NULL, #123456789.10
	status_pedido VARCHAR(20) DEFAULT 'Pendente',
	data_pedido DATE DEFAULT CURRENT_DATE(), #'AAAA-MM-DD'
	inicio_evento DATETIME NOT NULL,	#'AAAA-MM-DD HH:MM:SS'
	fim_evento DATETIME NOT NULL,		#'AAAA-MM-DD HH:MM:SS'
	qtd_convidados SMALLINT UNSIGNED NOT NULL,
	endereco TINYTEXT NOT NULL,
	observacoes TEXT,
		PRIMARY KEY (id_pedido),
  
	usuario_id INT UNSIGNED NOT NULL,
		FOREIGN KEY (usuario_id) REFERENCES usuarios (id_usuario)
);

CREATE TABLE funcionarios (
	cpf_funcionario CHAR(14),	#999.999.999-99
	nome_funcionario VARCHAR(100) NOT NULL,
	cargo TINYTEXT NOT NULL,
	salario DECIMAL(11, 2) NOT NULL,	#123456789.10
	email_funcionario VARCHAR(50) NOT NULL,
	telefone_funcionario CHAR(15) NOT NULL,	#(99) 99999-9999
		PRIMARY KEY (cpf_funcionario)
);

CREATE TABLE pedido_funcionarios (
	pedido_id INT UNSIGNED NOT NULL,
	funcionario_cpf CHAR(14) NOT NULL,
		FOREIGN KEY (pedido_id) REFERENCES pedidos (id_pedido),
		FOREIGN KEY (funcionario_cpf) REFERENCES funcionarios (cpf_funcionario)
);

CREATE TABLE utilitarios (
	id_utilitario INT UNSIGNED AUTO_INCREMENT,
	nome_utilitario VARCHAR(100) NOT NULL,
	preco_utilitario DECIMAL(11, 2) NOT NULL, #123456789.10
	estoque_utilitario INT UNSIGNED NOT NULL,
	descricao_utilitario TEXT,
		PRIMARY KEY (id_utilitario)
);

CREATE TABLE pedido_utilitarios (
	pedido_id INT UNSIGNED NOT NULL,
	utilitario_id INT UNSIGNED NOT NULL,
	qtd_utilitario SMALLINT UNSIGNED NOT NULL,
		FOREIGN KEY (pedido_id) REFERENCES pedidos (id_pedido),
		FOREIGN KEY (utilitario_id) REFERENCES utilitarios (id_utilitario)
);

CREATE TABLE comidas (
	id_comida INT UNSIGNED AUTO_INCREMENT,
	nome_comida VARCHAR(100) NOT NULL,
	preco_comida DECIMAL(11, 2) NOT NULL, #123456789.10
	estoque_comida INT UNSIGNED NOT NULL,
	tipo VARCHAR(9) NOT NULL, #Entrada, Principal, Sobremesa ou Bebida
  	categoria TINYTEXT NOT NULL,
	descricao_comida TEXT,
		PRIMARY KEY (id_comida)
);

CREATE TABLE pedido_comidas (
	pedido_id INT UNSIGNED NOT NULL,
	comida_id INT UNSIGNED NOT NULL,
	qtd_comida SMALLINT UNSIGNED NOT NULL,
		FOREIGN KEY (pedido_id) REFERENCES pedidos (id_pedido),
		FOREIGN KEY (comida_id) REFERENCES comidas (id_comida)
);