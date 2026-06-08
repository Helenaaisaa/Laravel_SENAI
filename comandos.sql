create database mvc_Biblioteca;
use mvc_Biblioteca;

create table Livros(
	id int auto_increment primary key,
    livroNome varchar(100),
    autor varchar(100),
    descricao varchar(255),
    created_at timestamp null,
    updated_at timestamp null
);

ALTER TABLE Livros 
ADD COLUMN editora_id INT,
ADD CONSTRAINT fk_Livros_Editora
FOREIGN KEY (editora_id) REFERENCES Editora(id);

ALTER TABLE Livros
ADD COLUMN detalhes_id INT,
ADD CONSTRAINT fk_Livros_Detalhe
FOREIGN KEY (detalhes_id) REFERENCES Detalhes(id);

create table Editora(
	id int auto_increment primary key,
    editoraNome varchar(100),
    cnpj int,
    pais varchar(255),
    cidade varchar(255),
    created_at timestamp null,
    updated_at timestamp null
);

create table Detalhes(
	id int auto_increment primary key,
    custo varchar(100),
    preco varchar(100),
    imposto varchar(100),
    created_at timestamp null,
    updated_at timestamp null
);

select * from Livros;
select * from Editora;
select * from Detalhes;