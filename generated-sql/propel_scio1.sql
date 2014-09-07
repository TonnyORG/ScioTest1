
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `user_id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_name` VARCHAR(20) NOT NULL,
    `created_date` DATETIME NOT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE INDEX `user_name` (`user_name`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- commets
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `commets`;

CREATE TABLE `commets`
(
    `comment_id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `comment` VARCHAR(255) NOT NULL,
    `created_date` DATETIME NOT NULL,
    PRIMARY KEY (`comment_id`),
    INDEX `commets_fi_72218f` (`user_id`),
    CONSTRAINT `commets_fk_72218f`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
