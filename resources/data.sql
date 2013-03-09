CREATE TABLE IF NOT EXISTS `user` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `username` TEXT UNIQUE NOT NULL DEFAULT '',
  `password` TEXT NOT NULL DEFAULT '',
  `email` TEXT NOT NULL DEFAULT '',
  `salt` TEXT NOT NULL DEFAULT '',
  `roles`TEXT NOT NULL DEFAULT ''
);

CREATE TABLE IF NOT EXISTS `post` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `title` TEXT UNIQUE NOT NULL DEFAULT '',
  `annotation` TEXT NOT NULL DEFAULT '',
  `content` TEXT NOT NULL DEFAULT '',
  `createdAt` TEXT NOT NULL DEFAULT '',
  `owner_id` INTEGER NOT NULL,
  FOREIGN KEY(owner_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS `comment` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `content` TEXT NOT NULL DEFAULT '',
  `createdAt` TEXT NOT NULL DEFAULT '',
  `user_id` INTEGER NOT NULL,
  `post_id` INTEGER NOT NULL,
  FOREIGN KEY(user_id) REFERENCES user(id),
  FOREIGN KEY(post_id) REFERENCES post(id)
);
INSERT INTO `user` (`username`, `password`, `roles`, `email`) VALUES ('johann', 'BFEQkknI/c+Nd7BaG7AaiyTfUFby/pkMHy3UsYqKqDcmvHoPRX/ame9TnVuOV2GrBH0JK9g4koW+CgTYI9mK+w==', 'ROLE_USER', 'email@blog.localhost');
INSERT INTO `user` (`username`, `password`, `roles`, `email`) VALUES ('admin', 'admin', 'ROLE_USER', 'email@blog.localhost');