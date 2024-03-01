CREATE DATABASE dbAgendamentos;
use dbAgendamentos;

create table tbSecretaria(
codigo int auto_increment primary key,
nome varchar(255) not null 
);

create table tbLocal(
codigo int auto_increment primary key,
nomeLocal varchar(255)not null,
infraestutura varchar(255),
lotacaoMaxima int not null,
endereco varchar(255) not null,
descricao varchar(255)
);

create table tbEquipamento(
codigo int auto_increment primary key,
nome varchar(255) not null,
marcar varchar(255) not null,
patrimonio int,
condicao varchar(45) not null,
qtdEstoque int
);

create table tbSetor(
codigo int auto_increment primary key,
nome varchar(255) not null,
codigoSecretaria int not null,
foreign key (codigoSecretaria) references tbSecretaria(codigo)
);

create table tbUsuario(
codigo int auto_increment primary key,
nome varchar(255) not null,
email varchar(255) not null,
telefone varchar(45) not null,
senha varchar(255) not null,
nivelPermissao int not null default 1,
codigoSetor int not null,
foreign key (codigoSetor) references tbSetor(codigo)
);

create table tbReserva(
codigo int auto_increment primary key,
diaEvento date not null,
horarioInicio time not null,
horarioFim time not null,
quantidadePessoa int not null,
descricao varchar(255) not null,
codigoUsuario int not null,
codigoLocal int not null,
foreign key (codigoUsuario) references tbUsuario(codigo),
foreign key (codigoLocal) references tbLocal(codigo)
);

create table tbReservaEquipamento(
codigo int auto_increment primary key,
dataEmprestimo datetime not null,
dataDevolucao datetime not null,
codigoReserva int not null,
codigoEquipamento int not null,
foreign key (codigoReserva) references tbReserva(codigo),
foreign key (codigoEquipamento) references tbEquipamento(codigo)
);


