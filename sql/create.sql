CREATE TABLE `yesno`
(
    `id`        INT       NOT NULL AUTO_INCREMENT,
    `mytime`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `articleid` INT,
    `result`    VARCHAR(10),
    PRIMARY KEY (`id`)
)

-- for__part__2-------------------------------------------
CREATE TABLE `whyanswerlog`
(
    `id`        INT       NOT NULL AUTO_INCREMENT,
    `mytime`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `articleid` INT,
    `result`    VARCHAR(500),
    PRIMARY KEY (`id`)
);
