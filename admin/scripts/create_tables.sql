-- --------------------------------------------------------
-- SQL Commands to set up the pmadb as described in Documentation.html.
-- 
-- DON'T RUN THIS SCRIPT ON MySQL 4.1.2 AND ABOVE!
-- Instead, please run create_tables_mysql_4_1_2+.sql.
--                                                 
-- This script expects the user pma to already be existing. If we would put a
-- line here to create him too many users might just use this script and end
-- up with having the same password for the controluser.
--                                                     
-- This user "pma" must be defined in config.inc.php (controluser/controlpass)                         
--                                                  
-- Please don't forget to set up the tablenames in config.inc.php                                 
-- 
-- $Id: create_tables.sql,v 2.9 2004/07/18 13:06:03 lem9 Exp $

-- --------------------------------------------------------

-- 
-- Database : `phpmyadmin`
-- 
DROP DATABASE IF EXISTS `phpmyadmin`;
CREATE DATABASE `phpmyadmin`;
USE phpmyadmin;

-- --------------------------------------------------------

-- 
-- Privileges
-- 
GRANT SELECT, INSERT, DELETE, UPDATE ON `phpmyadmin`.* TO
    'pma'@localhost;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_bookmark`
-- 

CREATE TABLE `pma_bookmark` (
    `id`    INT(11)      NOT NULL AUTO_INCREMENT,
    `dbase` VARCHAR(255) NOT NULL DEFAULT '',
    `user`  VARCHAR(255) NOT NULL DEFAULT '',
    `label` VARCHAR(255) NOT NULL DEFAULT '',
    `query` TEXT         NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = ISAM COMMENT ='Bookmarks';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_column_info`
-- 

CREATE TABLE `pma_column_info` (
    `id`                     INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `db_name`                VARCHAR(64)     NOT NULL DEFAULT '',
    `table_name`             VARCHAR(64)     NOT NULL DEFAULT '',
    `column_name`            VARCHAR(64)     NOT NULL DEFAULT '',
    `comment`                VARCHAR(255)    NOT NULL DEFAULT '',
    `mimetype`               VARCHAR(255)    NOT NULL DEFAULT '',
    `transformation`         VARCHAR(255)    NOT NULL DEFAULT '',
    `transformation_options` VARCHAR(255)    NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    UNIQUE KEY `db_name` (`db_name`, `table_name`, `column_name`)
)
    ENGINE = ISAM COMMENT ='Column information for phpMyAdmin';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_history`
-- 

CREATE TABLE `pma_history` (
    `id`        BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username`  VARCHAR(64)         NOT NULL DEFAULT '',
    `db`        VARCHAR(64)         NOT NULL DEFAULT '',
    `table`     VARCHAR(64)         NOT NULL DEFAULT '',
    `timevalue` TIMESTAMP(14)       NOT NULL,
    `sqlquery`  TEXT                NOT NULL,
    PRIMARY KEY (`id`),
    KEY `username` (`username`, `db`, `table`, `timevalue`)
)
    ENGINE = ISAM COMMENT ='SQL history for phpMyAdmin';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_pdf_pages`
-- 

CREATE TABLE `pma_pdf_pages` (
    `db_name`    VARCHAR(64)      NOT NULL DEFAULT '',
    `page_nr`    INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `page_descr` VARCHAR(50)      NOT NULL DEFAULT '',
    PRIMARY KEY (`page_nr`),
    KEY `db_name` (`db_name`)
)
    ENGINE = ISAM COMMENT ='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_relation`
-- 

CREATE TABLE `pma_relation` (
    `master_db`     VARCHAR(64) NOT NULL DEFAULT '',
    `master_table`  VARCHAR(64) NOT NULL DEFAULT '',
    `master_field`  VARCHAR(64) NOT NULL DEFAULT '',
    `foreign_db`    VARCHAR(64) NOT NULL DEFAULT '',
    `foreign_table` VARCHAR(64) NOT NULL DEFAULT '',
    `foreign_field` VARCHAR(64) NOT NULL DEFAULT '',
    PRIMARY KEY (`master_db`, `master_table`, `master_field`),
    KEY `foreign_field` (`foreign_db`, `foreign_table`)
)
    ENGINE = ISAM COMMENT ='Relation table';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_table_coords`
-- 

CREATE TABLE `pma_table_coords` (
    `db_name`         VARCHAR(64)    NOT NULL DEFAULT '',
    `table_name`      VARCHAR(64)    NOT NULL DEFAULT '',
    `pdf_page_number` INT(11)        NOT NULL DEFAULT '0',
    `x`               FLOAT UNSIGNED NOT NULL DEFAULT '0',
    `y`               FLOAT UNSIGNED NOT NULL DEFAULT '0',
    PRIMARY KEY (`db_name`, `table_name`, `pdf_page_number`)
)
    ENGINE = ISAM COMMENT ='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_table_info`
-- 

CREATE TABLE `pma_table_info` (
    `db_name`       VARCHAR(64) NOT NULL DEFAULT '',
    `table_name`    VARCHAR(64) NOT NULL DEFAULT '',
    `display_field` VARCHAR(64) NOT NULL DEFAULT '',
    PRIMARY KEY (`db_name`, `table_name`)
)
    ENGINE = ISAM COMMENT ='Table information for phpMyAdmin';
