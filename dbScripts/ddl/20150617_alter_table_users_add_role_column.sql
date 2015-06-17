ALTER TABLE `users` ADD column `role` enum ('admin', 'user') NOT NULL DEFAULT 'user';
