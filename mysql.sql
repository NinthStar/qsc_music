CREATE DATABASE qsc_music;

USE qsc_music

CREATE TABLE music
(
  mid INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  clientName CHAR(20) NOT NULL,
  uploadDate date,
  uid INT(11) NOT NULL,
  votes INT(11) DEFAULT 0
)CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE user
(
  uid INT(11) NOT NULL PRIMARY KEY,
  userName CHAR(20) NOT NULL,
  uploadTimes INT(11) DEFAULT 0
)CHARACTER SET utf8 COLLATE utf8_general_li;

CREATE USER 'qsc_music'@'%' IDENTIFIED BY  '***';

GRANT USAGE ON * . * TO  'qsc_music'@'%' IDENTIFIED BY  '***' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT ALL PRIVILEGES ON  `qsc_music` . * TO  'qsc_music'@'%';

CREATE *_music
(
)