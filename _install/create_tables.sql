DROP TABLE IF EXISTS announceMajor,announceCls;
DROP TABLE IF EXISTS SOEIHadmin, major, classification, submitter, announcementFile;
DROP TABLE IF EXISTS announcement; 

CREATE TABLE announcement(
    created_at DATETIME,
	announcement_ID	Int(20) NOT NULL,
	announcement_Title VARCHAR(200),
	announcement_Text TEXT,
	announcement_Location VARCHAR(200),
	start_day DATE,
    end_day DATE,
	announcement_time VARCHAR(50),
	published  TINYINT(1),
	PRIMARY KEY(announcement_ID)
);

CREATE TABLE SOEIHadmin(
    username VARCHAR(15) NOT NULL,
    password VARCHAR(60),
    PRIMARY KEY (username)
);

CREATE TABLE major(
  major_ID   int(2) NOT NULL AUTO_INCREMENT,
  major_Name VARCHAR(50),
  PRIMARY KEY (major_ID)
);

CREATE TABLE classification(
  cls_ID   int(2) NOT NULL AUTO_INCREMENT,
  cls_Name VARCHAR(50),
  PRIMARY KEY (cls_ID)
);

CREATE TABLE announceMajor(
    announcement_ID	Int(20) NOT NULL,
    major_ID   int(2) NOT NULL,
    PRIMARY KEY (announcement_ID, major_ID),
    FOREIGN KEY (announcement_ID) REFERENCES announcement(announcement_ID),
    FOREIGN KEY (major_ID) REFERENCES major(major_ID)
);

CREATE TABLE announceCls(
	announcement_ID	Int(20) NOT NULL,
     cls_ID   int(2) NOT NULL,
    PRIMARY KEY (announcement_ID, cls_ID),
    FOREIGN KEY (announcement_ID) REFERENCES announcement(announcement_ID),
    FOREIGN KEY (cls_ID) REFERENCES classification(cls_ID)
);

CREATE TABLE submitter(
    submitter_ID Int(10) Not Null AUTO_INCREMENT,
    announcement_ID	Int(20) NOT NULL,
    contact_Name VARCHAR(200),
	email VARCHAR(200),
	phone Bigint(11),
	S_organization VARCHAR(200),  
    PRIMARY KEY(submitter_ID),
    FOREIGN KEY (announcement_ID) REFERENCES announcement(announcement_ID)
);

CREATE TABLE announcementFile(
    file_ID Int(10) Not Null AUTO_INCREMENT,
    announcement_ID	Int(20) NOT NULL,
   	file_name VARCHAR(200),
    PRIMARY KEY(file_ID),
    FOREIGN KEY (announcement_ID) REFERENCES announcement(announcement_ID)
);

