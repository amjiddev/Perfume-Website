-- Add payment columns to orders table if they don't exist

ALTER TABLE `orders` ADD COLUMN `payment_method` VARCHAR(255) NULL AFTER `status`;
ALTER TABLE `orders` ADD COLUMN `payment_status` VARCHAR(255) NOT NULL DEFAULT 'pending' AFTER `payment_method`;
ALTER TABLE `orders` ADD COLUMN `transaction_id` VARCHAR(255) NULL AFTER `payment_status`;

-- Also add confirmed and cancelled to status enum
ALTER TABLE `orders` MODIFY COLUMN `status` ENUM('pending', 'approved', 'rejected', 'confirmed', 'cancelled') DEFAULT 'pending';

-- Check if viewed column exists, if not add it
ALTER TABLE `orders` ADD COLUMN `viewed` BOOLEAN NOT NULL DEFAULT 0 AFTER `status`;
