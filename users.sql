CREATE DATABASE `etbweb`


CREATE TABLE `users`(
	`id` int(100) NOT NULL,
	`username` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL ,
	`wholeName` varchar(100)  NOT NULL,
	`etb` varchar(100)  ,
	`furel` varchar(100)  ,
	`bftel` varchar(100)  ,
	`intercob` varchar(100)  ,
	`silec` varchar(100)  ,
	
	`rol` int (100)  NOT NULL,
	`password` varchar(100) NOT NULL
	
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	
ALTER TABLE `users`
	ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
	MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
INSERT INTO users VALUES (1, "crisilc", "Cristian Camilo Silva Carreño",
 "etb", "furel", "bftel", "intercob", "silec", 1, 123)
COMMIT;