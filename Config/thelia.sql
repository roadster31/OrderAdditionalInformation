
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- order_additional_information
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order_additional_information`;

CREATE TABLE `order_additional_information`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `order_id` INTEGER NOT NULL,
    `` LONGTEXT,
    PRIMARY KEY (`id`),
    INDEX `FI_order_additional_order_order_id` (`order_id`),
    CONSTRAINT `fk_order_additional_order_order_id`
        FOREIGN KEY (`order_id`)
        REFERENCES `order` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
