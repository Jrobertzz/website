CREATE TABLE account
(	username			VARCHAR(20)		NOT NULL PRIMARY KEY,
	hashed_password		CHAR(128)		NOT NULL,
	folder_id			INT,
	email				VARCHAR(254)	#max email string size is 254
);

CREATE TABLE user_group
(	group_id			VARCHAR(30)		NOT NULL PRIMARY KEY,
	folder				VARCHAR(20),
    admin_username		VARCHAR(20),
    users				VARCHAR(20),
    FOREIGN KEY (admin_username) REFERENCES account(username),
    FOREIGN KEY (users) REFERENCES account(username)
);

CREATE TABLE folder
(	folder_id			INT				NOT NULL PRIMARY KEY AUTO_INCREMENT,
	size				INT,
    user_owner			VARCHAR(20),
    group_owner			VARCHAR(20),
    type				VARCHAR(20),
    FOREIGN KEY (user_owner) REFERENCES account(username),
    FOREIGN KEY (group_owner) REFERENCES user_group(group_id)
);

CREATE TABLE system
(	sys_id				INT				NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username			VARCHAR(20),
	architecture		VARCHAR(20),
    operating_system	VARCHAR(20),
    FOREIGN KEY (username) REFERENCES account(username)
);

CREATE TABLE our_file
(	filename			VARCHAR(36)		NOT NULL PRIMARY KEY,
	folder_id			INT				NOT NULL,
    FOREIGN KEY (folder_id) REFERENCES folder(folder_id)
);

CREATE TABLE package
(	package_name		VARCHAR(20)		NOT NULL,
	sys_id				INT				NOT NULL,
	package_id			INT 			NOT NULL PRIMARY KEY AUTO_INCREMENT,
	FOREIGN KEY (sys_id) REFERENCES system(sys_id)
);

CREATE TABLE config
(	config_name			VARCHAR(20)		NOT NULL PRIMARY KEY,
	sys_id				INT				NOT NULL,
    FOREIGN KEY (sys_id) REFERENCES system(sys_id)
);
