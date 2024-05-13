<?php

$sql = array();

$sql[] = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "exampleclass` (
    `id_exampleclass` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `date_add` DATETIME NOT NULL,
    `date_upd` DATETIME NOT NULL,
    PRIMARY KEY (`id_examplemodule_setting`),
    KEY `name` (`name`)
) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8;";

return $sql;
