CREATE TABLE `tickets`(
	`id` int(255) NOT NULL,
	`ticketName` varchar(1000) NULL,
	`username` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL ,
	`currentDate` varchar(100),
	`empresa` varchar(100) ,
	`tecnologia` varchar(100) ,
	`affair` varchar(2000) NOT NULL,
	`description` varchar(5000) NOT NULL,
	`state` varchar(100) NOT NULL,
	`file` varchar(100) NULL

	
	
	
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	
ALTER TABLE `tickets`
	ADD PRIMARY KEY (`id`);
ALTER TABLE `tickets`
	MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;