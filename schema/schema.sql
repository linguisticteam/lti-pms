CREATE TABLE `medias` (
  `id`                      int(11) NOT NULL AUTO_INCREMENT,
  `title`                   varchar(128) DEFAULT NULL,
  `description`             varchar(1024) DEFAULT NULL,
  `originator_id`           tinyint(4) DEFAULT NULL,
  `producer_id`             tinyint(4) DEFAULT NULL,
  `original_language_id`    tinyint(4) DEFAULT NULL,
  `state`                   tinyint(4) DEFAULT NULL,
  `type`                    tinyint(4) DEFAULT NULL,
  `language_id`             tinyint(4) DEFAULT NULL,
  `category`                tinyint(4) DEFAULT NULL,
  `parent_id`               tinyint(4) DEFAULT NULL,
  `working_location`        varchar(256) DEFAULT NULL,
  `original_location`       varchar(256) DEFAULT NULL,
  `publish_location`        varchar(256) DEFAULT NULL,
  `duration`                time DEFAULT NULL,
  `number_of_words`         int(11) DEFAULT NULL,
  `date_added`              date DEFAULT NULL,
  `date_finished`           date DEFAULT NULL,
--   `workgroup`               int(11) DEFAULT NULL,
  `chat_id`                 int(11) DEFAULT NULL,
  `forum_thread`            varchar(256) DEFAULT NULL,
  `notes`                   varchar(1024) DEFAULT NULL,

  PRIMARY KEY (`id`)
)

CREATE TABLE `users` (
  `id` 			int(11) NOT NULL AUTO_INCREMENT,
  `name` 		varchar(64) DEFAULT NULL,
  `email` 		varchar(64) DEFAULT NULL,
  `password` 		varchar(64) DEFAULT NULL,
  `dotsub_id` 		varchar(64) DEFAULT NULL,
  `pootle_id` 		varchar(64) DEFAULT NULL,
  `facebook_id` 	varchar(64) DEFAULT NULL,
  `skype_id` 		varchar(64) DEFAULT NULL,
  `status` 		tinyint(4) DEFAULT NULL,
  `date_added` 		date DEFAULT NULL,
  `type` 		tinyint(4) DEFAULT NULL,
  `description` 	varchar(1024) DEFAULT NULL,

  PRIMARY KEY (`id`)
)

CREATE TABLE `workgroups` (
    `id`        	int(11) NOT NULL AUTO_INCREMENT,
    `user_id`           int(11) NOT NULL,
    `function_id`       int(11) NOT NULL,
)

CREATE TABLE `functions` (
    `id`        	int(11) NOT NULL AUTO_INCREMENT,
    `name`        	varchar(64) DEFAULT NULL,
    `description`      	varchar(512) DEFAULT NULL,
)

CREATE TABLE `language` (
    `id`                int(11) NOT NULL AUTO_INCREMENT,
    `name`              varchar(64) DEFAULT NULL,
    `description`       varchar(1024) DEFAULT NULL,
    `youtube_channel`   varchar(256) DEFAULT NULL,
    `facebook_group`    varchar(256) DEFAULT NULL,
    `facebook_page`     varchar(256) DEFAULT NULL,
    `website`           varchar(256) DEFAULT NULL,
    `forum_playground`  varchar(256) DEFAULT NULL,
    `workgroup`         int(11) DEFAULT NULL,
)

CREATE TABLE `chat` (
    `id`                int(11) NOT NULL AUTO_INCREMENT,
    `user_id`           int(11) NOT NULL,
    `message`           varchar(1024) DEFAULT NULL,
    `media_id`          int(11) NOT NULL,
)

ALTER TABLE `workgroups` ADD CONSTRAINT `fk_`
ALTER TABLE `tab_clientes` ADD CONSTRAINT `fk_cidade` FOREIGN KEY (`cidade_cliente`) REFERENCES `tab_cidades` (`cod_cidade`);

