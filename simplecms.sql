create database simplecms

create table posts (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(130) NOT NULL,
	description TEXT NOT NULL,
	content TEXT NOT NULL,
	date_created DATETIME NOT NULL DEFAULT NOW(),
	author VARCHAR(70) NULL,
	user_id INT NOT NULL,
	published INT NOT NULL
	);

create table posts_image (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	post_id INT NOT NULL,
	location VARCHAR(50) NOT NULL
);

create table users (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(20) NOT NULL,
	name VARCHAR(70) NOT NULL,
	email VARCHAR(320) NOT NULL,
	password VARCHAR(255) NOT NULL,
	privilege VARCHAR(10) NOT NULL,
	date_created DATETIME NOT NULL DEFAULT NOW()
	); 
	
insert into users (
	username, 
	name, 
	password, 
	privilege
) values (
	"admin", 
	"admin", 
	"$2y$10$56rpvwcRTGb9DElHVzWKGuvrXBg9ZFb2n67t43ztYfPFHImLs3HAq", 
	"admin"
);
