DROP TABLE IF EXISTS SOEIHuser;
CREATE TABLE SOEIHuser(
					username VARCHAR(15) NOT NULL,
					password VARCHAR(60),
					admin TINYINT(1),
					PRIMARY KEY(username)
					);
					
INSERT INTO SOEIHuser VALUES ('sdhoju', '$2y$10$MWEyM2Q5MGZjOTJiMzc1YetkntuXvMDedcfeX/tf7/PNwjSLTcvc2', 1);
INSERT INTO SOEIHuser VALUES ('admin', '$2y$10$MWEyM2Q5MGZjOTJiMzc1YetkntuXvMDedcfeX/tf7/PNwjSLTcvc2', 1);