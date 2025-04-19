CREATE TABLE `user`
(
    `uuid`          VARCHAR(36) PRIMARY KEY NOT NULL,
    `username`      VARCHAR(255)            NOT NULL UNIQUE,
    `hash_password` VARCHAR(255)            NOT NULL,
    `first_name`     VARCHAR(255)            NOT NULL,
    `last_name`     VARCHAR(255)            NOT NULL,
    `email`         VARCHAR(255)            NOT NULL,
    `address`       VARCHAR(255)            NOT NULL,
    `phone`         VARCHAR(15)             NOT NULL,
    `avatar`        VARCHAR(255) NULL,
    `created_at`    datetime                NOT NULL,
    `updated_at`    datetime NULL
);

CREATE TABLE `food`
(
    `uuid`        VARCHAR(36) PRIMARY KEY NOT NULL,
    `name`        VARCHAR(255)            NOT NULL,
    `description` VARCHAR(255) NULL,
    `image`       VARCHAR(255) NULL,
    `price`       int                     NOT NULL,
    `created_at`  datetime                NOT NULL,
    `updated_at`  datetime NULL,
    `created_by`  VARCHAR(255) NULL,
    `updated_by`  VARCHAR(255) NULL
);

CREATE TABLE `order`
(
    `id`         int PRIMARY KEY NOT NULL,
    `user_uuid`  VARCHAR(36)     NOT NULL,
    `status`     VARCHAR(255)    NOT NULL,
    `address`    VARCHAR(255) NULL,
    `phone`      VARCHAR(15) NULL,
    `order_date` datetime NULL,
    `created_at` datetime        NOT NULL,
    `updated_at` datetime NULL,
    `created_by` VARCHAR(255) NULL,
    `updated_by` VARCHAR(255) NULL
);

CREATE TABLE `order_detail`
(
    `uuid`       VARCHAR(36) PRIMARY KEY NOT NULL,
    `order_id`   int                     NOT NULL,
    `food_uuid`  VARCHAR(36)             NOT NULL,
    `amount`     int                     NOT NULL,
    `created_at` datetime                NOT NULL,
    `updated_at` datetime NULL,
    `created_by` VARCHAR(255) NULL,
    `updated_by` VARCHAR(255) NULL
);

ALTER TABLE `order`
    ADD CONSTRAINT fk_order_user
        FOREIGN KEY (`user_uuid`)
            REFERENCES `user` (`uuid`);

ALTER TABLE `order_detail`
    ADD CONSTRAINT fk_od_order
        FOREIGN KEY (`order_id`)
            REFERENCES `order` (`id`);

ALTER TABLE `order_detail`
    ADD CONSTRAINT fk_od_food
        FOREIGN KEY (food_uuid)
            REFERENCES `food` (`uuid`);