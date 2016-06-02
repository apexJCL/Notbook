CREATE TABLE accounts (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  email VARCHAR(40) NOT NULL,
  password CHAR(32) NOT NULL ,
  recovery_password CHAR(32),
  last_session DATE
);

CREATE TABLE profiles (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  birthdate DATE,
  sex CHAR(1),
  photo MEDIUMBLOB,
  CONSTRAINT  account_profileFK FOREIGN KEY (id) REFERENCES accounts(id)
);

CREATE TABLE notbooks (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  profile_id INT NOT NULL,
  unparsed MEDIUMTEXT,
  parsed MEDIUMTEXT,
  created DATETIME NOT NULL ,
  last_parsed_date DATE,
  title VARCHAR(100),
  private BOOLEAN DEFAULT TRUE,
  CONSTRAINT profileFK FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE
);

CREATE TABLE notbook_comments (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  notbook_id INT NOT NULL,
  profile_id INT NOT NULL,
  comment VARCHAR(200) NOT NULL,
  comment_date TIMESTAMP,
  reply_to INT,
  CONSTRAINT commentnbFK FOREIGN KEY (notbook_id) REFERENCES notbooks(id) ON DELETE CASCADE ,
  CONSTRAINT commentprFK FOREIGN KEY (profile_id) REFERENCES profiles(id),
  CONSTRAINT commentReplyFK FOREIGN KEY (reply_to) REFERENCES notbook_comments(id)
);

CREATE TABLE roles (
  id INT UNSIGNED PRIMARY KEY NOT NULL  AUTO_INCREMENT,
  role VARCHAR(30)
);

CREATE TABLE permissions (
  id SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  permission VARCHAR(30)
);

CREATE TABLE role_permissions (
  id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  role_id INT UNSIGNED NOT NULL,
  permission_id SMALLINT UNSIGNED NOT NULL,
  CONSTRAINT rolepFK FOREIGN KEY (role_id) REFERENCES roles(id),
  CONSTRAINT permPFK FOREIGN KEY (permission_id) REFERENCES permissions(id)
);

CREATE TABLE profile_roles (
  id INT PRIMARY KEY AUTO_INCREMENT,
  profile_id INT NOT NULL,
  role_id INT UNSIGNED NOT NULL,
  CONSTRAINT profilerFK FOREIGN KEY (profile_id) REFERENCES profiles(id),
  CONSTRAINT roleprFK FOREIGN KEY (role_id) REFERENCES roles(id)
);
INSERT INTO roles (role) VALUES ('admin'), ('user');
INSERT INTO permissions (permission) VALUES ('all');

CREATE USER 'reander'@'localhost' IDENTIFIED BY 'parsing';
GRANT ALL PRIVILEGES ON notbook.* TO 'reander'@'localhost';