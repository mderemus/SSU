--
-- Database: `SSU_db`
--

CREATE DATABASE IF NOT EXISTS `SSU_db`;
USE `SSU_db`;


-- ENTITIES

--
-- Struttura della tabella `account`
--

CREATE TABLE IF NOT EXISTS `account` (
	`Active` bool ,
	`Description` varchar(40) ,
	`Name` varchar(40)  NOT NULL,
	
	-- RELAZIONI

	`_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT 

);




--
-- Struttura della tabella `cashflow`
--

CREATE TABLE IF NOT EXISTS `cashflow` (
	`addition` bool ,
	`amount` decimal(6,2) ,
	`description` varchar(40) ,
	`transaction_date` date ,
	
	-- RELAZIONI

	`_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT 

);



-- relation m:m accountid CashFlow - Account
CREATE TABLE IF NOT EXISTS `CashFlow_accountid` (
    `_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `id_CashFlow` int(11)  NOT NULL REFERENCES CashFlow(_id),
    `id_Account` int(11)  NOT NULL REFERENCES Account(_id)
);



-- relation m:m userid CashFlow - User
CREATE TABLE IF NOT EXISTS `CashFlow_userid` (
    `_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `id_CashFlow` int(11)  NOT NULL REFERENCES CashFlow(_id),
    `id_User` int(11)  NOT NULL REFERENCES User(_id)
);




--
-- Struttura della tabella `user`
--

CREATE TABLE IF NOT EXISTS `user` (
	`mail` varchar(40) ,
	`name` varchar(40) ,
	`password` varchar(40)  NOT NULL,
	`roles` varchar(40) ,
	`surname` varchar(40) ,
	`username` varchar(40)  NOT NULL,
	
	-- RELAZIONI
	`accountid` int(11)  REFERENCES account(_id),

	`_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT 

);







INSERT INTO `SSU_db`.`user` (`username`, `password`, `_id`) VALUES ('admin', '1a1dc91c907325c69271ddf0c944bc72', 1);

CREATE TABLE IF NOT EXISTS `roles` (
	`role` varchar(30) ,
	
	-- RELAZIONI

	`_user` int(11)  NOT NULL REFERENCES user(_id),
	`_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT 

);
INSERT INTO `SSU_db`.`roles` (`role`, `_user`, `_id`) VALUES ('ADMIN', '1', 1);