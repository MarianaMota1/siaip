/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Mary
 * Created: 25/03/2019
 */

create table if not exists usuario(
    id int not null primary key auto_increment,
    nome varchar(255) not null,
    email varchar(255) not null,
    senha varchar(255) not null,
    nivel varchar(25) not null
);

create table if not exists disciplina(
	id int not null primary key auto_increment,
	nome varchar(255) not null
);

create table if not exists turma(
  id int not null primary key auto_increment,
  nome varchar(255) not null,
  serie varchar(255) not null
);

create table if not exists turma_professor(
	id int not null primary key auto_increment,
	turma int not null,
	disciplina int not null,
	professor int not null,
	foreign key (turma) references turma(id) ON DELETE CASCADE,
	foreign key (disciplina) references disciplina(id) ON DELETE CASCADE,
	foreign key (professor) references usuario(id) ON DELETE CASCADE
);

create table if not exists aluno(
  id int not null primary key auto_increment,
  nome varchar(255) not null,
  datanascimento date not null,
  numeromatricula varchar(255) not null,
  pai varchar(255),
  mae varchar(255),
  telefonepai varchar(25),
  telefonemae varchar(25),
  turma int not null,
  foreign key (turma) references turma(id) ON DELETE CASCADE
);