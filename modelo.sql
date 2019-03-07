drop database if exists JUKEBOX_ON;
create database if not exists JUKEBOX_ON;

use JUKEBOX_ON;

-- DOWN
drop table if exists users;
drop table if exists room;
drop table if exists musics;

create table users(
    id_user         int primary key auto_increment,
    name_user    varchar(255) not null,
    user_pass    varchar(45) not null,
    user_place   int
    
);

create table room(
    id_room     int primary key auto_increment,
    fk_user_id  int,
    name_room   varchar(20),
 	theme_room 	varchar(10),
    foreign key (fk_user_id) references users(id_user)
    ON DELETE CASCADE
);

create table musics(
    id_music    int not null auto_increment primary key,
   	title varchar(255) not null,
  	artist 	    varchar(60),
  	ordem 		int not null,
    mp3 varchar(255) not null,
  	fk_id_user  int not null,
  	fk_sala_id  int not null,
    foreign key (fk_id_user) references users(id_user),
    foreign key (fk_sala_id) references room(id_room)
  ON DELETE CASCADE
);
-- ENDUP

-- drop user if exists web20182;
