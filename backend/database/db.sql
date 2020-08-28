CREATE SCHEMA IF NOT EXISTS `tasker` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `tasker`;

CREATE TABLE IF NOT EXISTS `tasker`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
    `name` VARCHAR(100) NULL COMMENT '',
    `email` VARCHAR(100) NULL COMMENT '',
    `password` VARCHAR(100) NULL COMMENT '',
    PRIMARY KEY (`id`) COMMENT ''
)
ENGINE = InnoDB;
CREATE TABLE IF NOT EXISTS `tasker`.`tasks` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
    `title` VARCHAR(100) NULL COMMENT '',
    `created` DATE NULL COMMENT '',
    `status` CHAR(1) NULL COMMENT '',
    `user_id` INT NOT NULL COMMENT '',
    PRIMARY KEY (`id`) COMMENT '',
    INDEX `fk_tasks_user_idx` (`user_id` ASC) COMMENT '',
    CONSTRAINT `fk_tasks_users`
        FOREIGN KEY (`user_id`)
        REFERENCES `tasker`.`users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
)
ENGINE = InnoDB;