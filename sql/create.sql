CREATE TABLE `yesno`
(
    `id`        INT       NOT NULL AUTO_INCREMENT,
    `mytime`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `articleid` INT,
    `result`    VARCHAR(10),
    PRIMARY KEY (`id`)
)