CREATE TABLE accounts (
  id SERIAL PRIMARY KEY NOT NULL ,
  email VARCHAR(40) NOT NULL,
  password CHAR(32) NOT NULL ,
  recovery_password CHAR(32),
  last_session DATE
);

CREATE TABLE profiles (
  id SERIAL PRIMARY KEY NOT NULL,
  name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  birthdate DATE,
  sex CHAR(1),
  photo BYTEA,
  CONSTRAINT  account_profileFK FOREIGN KEY (id) REFERENCES accounts(id)
);

CREATE TABLE notbooks (
  id SERIAL PRIMARY KEY NOT NULL,
  profile_id INT NOT NULL,
  unparsed BYTEA,
  parsed BYTEA,
  created TIMESTAMP NOT NULL ,
  last_parsed_date DATE,
  title VARCHAR(100),
  private BOOLEAN DEFAULT TRUE,
  CONSTRAINT profileFK FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE
);

CREATE TABLE notbook_comments (
  id SERIAL PRIMARY KEY NOT NULL,
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
  id SERIAL PRIMARY KEY NOT NULL,
  role VARCHAR(30)
);

CREATE TABLE permissions (
  id SERIAL PRIMARY KEY,
  permission VARCHAR(30)
);

CREATE TABLE role_permissions (
  id SERIAL PRIMARY KEY,
  role_id INT NOT NULL,
  permission_id int NOT NULL,
  CONSTRAINT rolepFK FOREIGN KEY (role_id) REFERENCES roles(id),
  CONSTRAINT permPFK FOREIGN KEY (permission_id) REFERENCES permissions(id)
);

CREATE TABLE profile_roles (
  id SERIAL PRIMARY KEY,
  profile_id INT NOT NULL,
  role_id INT NOT NULL,
  CONSTRAINT profilerFK FOREIGN KEY (profile_id) REFERENCES profiles(id),
  CONSTRAINT roleprFK FOREIGN KEY (role_id) REFERENCES roles(id)
);

INSERT INTO roles (role) VALUES ('admin'), ('user');
INSERT INTO permissions (permission) VALUES ('all');

CREATE USER reander WITH PASSWORD 'parsing':
GRANT ALL PRIVILEGES ON notbook TO reander;