DROP TABLE IF EXISTS announcement;
CREATE TABLE announcement(
	announcement_ID	Int(17) NOT NULL,
	contact_Name VARCHAR(200),
	email VARCHAR(200),
	phone Bigint(11),
	S_organization VARCHAR(200),
	announcement_Title VARCHAR(200),
	announcement_Text TEXT,
	announcement_Location VARCHAR(200),
	announcement_date DATE,
	announcement_time VARCHAR(50),
	announcement_media VARCHAR(200),
	published  TINYINT(1),
	PRIMARY KEY(announcement_ID)
);


insert into announcement values(
	'123457',
	'Sameer dhoju',
	'notemail@test.edu',
	'6622026786',
	" ",
	'Fall 2018 Career Expo',
	"Please join us Wednesday, October 3rd for the All Majors Career Expo in the ballroom of the Inn at Ole Miss from12:00 pm - 4:00 pm. Career fairs provide students with a wonderful opportunity to network with employers and practice discussing qualifications in a professional setting. Whether you're a senior looking for a full-time job or a sophomore looking to make connections and gain career fair experience, all majors are welcome to come and explore various job and internship opportunities. 
	Don't forget to dress professionally and bring plenty of copies of your resume. In the meantime, consider stopping by the Career Center to get your resume critiqued. We are open Monday-Friday from 8-5 PM. Please call us if you have any questions about the event. 
	For more information, check out this link: https://events.olemiss.edu/event.php?value=4726 ",
	
	'University of Mississippi',
	'2018-10-18',
	'5 PM',
"https://cdn1.orgsync.com/images/os-attachments/2b5ff01d-ec7d-446d-b752-2988511d9dbb.png?w=710",
0

);

insert into announcement values(
	'1234568',
	'Sameer dhoju',
	'notemail@test.edu',
	'6622026786',
	"Oxford ",
	'Volunteer Opportunity: The Great 38 Race',
	"The Great 38 Race needs volunteers for course marshals! These are people who simply stand on the course at intersections and turns and point the runners in the right direction. The first 100 volunteers (at least) to register and show up on on race weekend will receive a volunteer t-shirt.. Here is The Great 38 Race Weekend Volunteer Sign-Up page. Students can email marvin@runoxford.com for questions.",
	'University of Mississippi',
	'2018-10-18',
	'5 PM',
	'https://cdn1.orgsync.com/images/os-attachments/7042871f-09d1-4555-8874-ba7d85a079e7.png?w=710',
	1
);
insert into announcement values('1540326139', 'Sameer Dhoju', 'sdhoju@go.olemiss.edu', '6622024876', '', 'BOOS & BREWS – FREE BEER FROM JACKSON BEER CO. – MAKE ANY SIGN IN OUR GALLERY! $65', 'Choose your own wood sign from our gallery of 100 plus designs! Join our popular workshop and create your own unique wood sign! We customize the materials for you and take you step by step to create a gorgeous piece for your home or for a gift! Choose from a variety of paint colors and wood stain colors in the workshop.\r\n\r\nDrinks and light refreshments provided!', 'Oxford Board & Brush', '2018-10-24', '6:30 pm - 9:30 pm', 
'https://boardandbrush.com/wp-content/uploads/2018/09/christmas-church-trio-6x32-300x257.jpg, 
0');