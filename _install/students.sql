DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS major;
CREATE TABLE major(
	major_ID	Int(17) NOT NULL,
	major_name VARCHAR(200),
	PRIMARY KEY(major_ID)
);
insert into major values(1,'Chemical Engineering');
insert into major values(2,'Computer Science');
insert into major values(3,'Electrical Engineering');
insert into major values(4,'General Engineering');
insert into major values(5,'Mechanical Engineering');

insert into major values(7,'Biomedical Engineering');
insert into major values(8,'Civil Engineering');
insert into major values(9,'Geological Engineering');
insert into major values(10,'Geology');


CREATE TABLE student(
	student_ID	Int(17) NOT NULL,
	first_name VARCHAR(200),
	middle_name VARCHAR(200),
	last_name VARCHAR(200),
	email  VARCHAR(200),
	major_ID Int(17),
	earned_hours Int(17),
	PRIMARY KEY(student_ID),
	FOREIGN KEY (major_ID) REFERENCES major (major_ID)
);
insert into student values (1,'Sameer',"NA","Dhoju",'sdhoju@go.olemiss.edu',2,117);
insert into student values (2,'Samee',"-","Dhoju",'samee.dhoju@gmail.com',3,117);


DROP TABLE IF EXISTS announcement;
DROP TABLE IF EXISTS SOEIHuser;
CREATE TABLE SOEIHuser(
	username VARCHAR(15) NOT NULL,
	password VARCHAR(60),
	isAdmin TINYINT(1),
	PRIMARY KEY(username)
);
CREATE TABLE announcement(
	announcement_ID	Int(17) NOT NULL,
	announcement_Title VARCHAR(200),
	announcement_Text TEXT,
	announcement_Location VARCHAR(200),
	announcement_date DATE,
	announcement_time VARCHAR(50),
	announcement_media VARCHAR(200),

	PRIMARY KEY(announcement_ID)
);

INSERT INTO SOEIHuser VALUES ('sdhoju', 
	'$2y$10$MWEyM2Q5MGZjOTJiMzc1YetkntuXvMDedcfeX/tf7/PNwjSLTcvc2', 
	1);
INSERT INTO SOEIHuser VALUES ('soul', 
	'$2y$10$MWEyM2Q5MGZjOTJiMzc1YetkntuXvMDedcfeX/tf7/PNwjSLTcvc2', 
	0);

insert into announcement values(
	'123456',
	'LGBTQ+ History Month',
	'October 1st marks the beginning of LGBTQ+ History Month, a month-long annual observance of lesbian, gay, bisexual and transgender history, and the history of the gay rights and related civil rights movements. The Center for Inclusion and Cross Cultural Engagement and Sarah Isom Center for Women and Gender Studies, along with various campus partners and student organizations, will host several events throughout the month of October in recognition of LGBTQ+ History Month.

		We will kick off the celebration with the Opening Ceremony on Tuesday, October 2, 2018 at 4:00 PM in the Bryant Hall Jan & Lawrence Farrington Gallery. All members of the university community are welcomed to attend this ceremony. The full calendar of events is available at https://inclusion.olemiss.edu/lgbtq-history-month-2018/.  

		Please feel free to contact the CICCE at inclusion@olemiss.ed if you have questions or would like additional information. ',
			'University of Mississippi',
			'2018-10-18',
			'5 PM',
			'https://cdn1.orgsync.com/images/os-attachments/07216051-1901-4461-a57b-052adf9718e9.jpg?w=710'
	
);

insert into announcement values(
	'123457',
	'Fall 2018 Career Expo',
	"Please join us Wednesday, October 3rd for the All Majors Career Expo in the ballroom of the Inn at Ole Miss from12:00 pm - 4:00 pm. Career fairs provide students with a wonderful opportunity to network with employers and practice discussing qualifications in a professional setting. Whether you're a senior looking for a full-time job or a sophomore looking to make connections and gain career fair experience, all majors are welcome to come and explore various job and internship opportunities. 


Don't forget to dress professionally and bring plenty of copies of your resume. In the meantime, consider stopping by the Career Center to get your resume critiqued. We are open Monday-Friday from 8-5 PM. Please call us if you have any questions about the event. 

For more information, check out this link: https://events.olemiss.edu/event.php?value=4726 ",
	
	'University of Mississippi',
	'2018-10-18',
			'5 PM',
"https://cdn1.orgsync.com/images/os-attachments/2b5ff01d-ec7d-446d-b752-2988511d9dbb.png?w=710"

);

insert into announcement values(
	'1234568',
	'Volunteer Opportunity: The Great 38 Race',
	"The Great 38 Race needs volunteers for course marshals! These are people who simply stand on the course at intersections and turns and point the runners in the right direction. The first 100 volunteers (at least) to register and show up on on race weekend will receive a volunteer t-shirt.. Here is The Great 38 Race Weekend Volunteer Sign-Up page. Students can email marvin@runoxford.com for questions.",
	'University of Mississippi',
	'2018-10-18',
	'5 PM',
	'https://cdn1.orgsync.com/images/os-attachments/7042871f-09d1-4555-8874-ba7d85a079e7.png?w=710'

);


