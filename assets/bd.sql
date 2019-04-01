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
    senha varchar(255) not null
);