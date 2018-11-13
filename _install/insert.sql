INSERT into major(major_Name) VALUES
			("Biochemistry"),
			("Biomedical Engineering"),
			("Chemical Engineering"),
			("Civil Engineering"),
			("Computer Science"),
			("Electrical Engineering"),
			("General Engineering"),
			("Geological Engineering"),
			("Geology"),
			("Mechanical Engineering");


INSERT into classification(cls_Name) VALUES
			("Freshmen"),
			("Sophpmore"),
			("Junior"),
			("Senior"),
			("Graduate");






START TRANSACTION;
Insert into announcement 
				(created_at,announcement_ID,announcement_Title,announcement_Text,
				announcement_Location,start_day,end_day,announcement_time,published) 
				values(1542062366,1542062366,'Thanksgiving Potluck at OXCM + Harvest Angel Project',
				' aasdasd','Student Union','11-24-2018','','9:30 pm - 1:30 am',0);
				INSERT INTO submitter(announcement_ID,contact_Name,email,phone,S_organization)
				VALUES(1542062366,'asd','sdhoju@go.olemiss.edu','132-465-4657','');
COMMIT;




-- Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,
-- 		announcement_Location,start_date,announcement_time,published
-- 		) values(
-- 	'12',
-- 	'123457',
-- 	'Fall 2018 Career Expo',
-- 	"Please join us Wednesday, October 3rd for the All Majors Career Expo in the ballroom of the Inn at Ole Miss from12:00 pm - 4:00 pm. Career fairs provide students with a wonderful opportunity to network with employers and practice discussing qualifications in a professional setting. Whether you're a senior looking for a full-time job or a sophomore looking to make connections and gain career fair experience, all majors are welcome to come and explore various job and internship opportunities. 
-- 	Don't forget to dress professionally and bring plenty of copies of your resume. In the meantime, consider stopping by the Career Center to get your resume critiqued. We are open Monday-Friday from 8-5 PM. Please call us if you have any questions about the event. 
-- 	For more information, check out this link: https://events.olemiss.edu/event.php?value=4726 ",
-- 	'University of Mississippi',
-- 	'2018-10-18',
-- 	'5 PM',
-- 	0
-- );

-- Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,
-- 		announcement_Location,start_date,announcement_time,published
-- 		) values(
-- 	'12',
-- 	'12',
-- 	'Fall 2018 Career Expo',
-- 	"Please join us Wednesday, October 3rd for the All Majors Career Expo in the ballroom of the Inn at Ole Miss from12:00 pm - 4:00 pm. Career fairs provide students with a wonderful opportunity to network with employers and practice discussing qualifications in a professional setting. Whether you're a senior looking for a full-time job or a sophomore looking to make connections and gain career fair experience, all majors are welcome to come and explore various job and internship opportunities. 
-- 	Don't forget to dress professionally and bring plenty of copies of your resume. In the meantime, consider stopping by the Career Center to get your resume critiqued. We are open Monday-Friday from 8-5 PM. Please call us if you have any questions about the event. 
-- 	For more information, check out this link: https://events.olemiss.edu/event.php?value=4726 ",
-- 	'University of Mississippi',
-- 	'2018-10-18',
-- 	'5 PM',
-- 	1
-- );
-- Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,
-- 		announcement_Location,start_date,announcement_time,published
-- 		) values(
-- 	'12',
-- 	'465',
-- 	'Fall 2018 Career Expo',
-- 	"Please join us Wednesday, October 3rd for the All Majors Career Expo in the ballroom of the Inn at Ole Miss from12:00 pm - 4:00 pm. Career fairs provide students with a wonderful opportunity to network with employers and practice discussing qualifications in a professional setting. Whether you're a senior looking for a full-time job or a sophomore looking to make connections and gain career fair experience, all majors are welcome to come and explore various job and internship opportunities. 
-- 	Don't forget to dress professionally and bring plenty of copies of your resume. In the meantime, consider stopping by the Career Center to get your resume critiqued. We are open Monday-Friday from 8-5 PM. Please call us if you have any questions about the event. 
-- 	For more information, check out this link: https://events.olemiss.edu/event.php?value=4726 ",
-- 	'University of Mississippi',
-- 	'2018-10-18',
-- 	'5 PM',
-- 	1
-- );

-- Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,
-- 		announcement_Location,start_date,announcement_time,published
-- 		) values(
-- 	'12',
-- 	'798',
-- 	'Fall 2018 Career Expo',
-- 	"Please join us Wednesday, October 3rd for the All Majors Career Expo in the ballroom of the Inn at Ole Miss from12:00 pm - 4:00 pm. Career fairs provide students with a wonderful opportunity to network with employers and practice discussing qualifications in a professional setting. Whether you're a senior looking for a full-time job or a sophomore looking to make connections and gain career fair experience, all majors are welcome to come and explore various job and internship opportunities. 
-- 	Don't forget to dress professionally and bring plenty of copies of your resume. In the meantime, consider stopping by the Career Center to get your resume critiqued. We are open Monday-Friday from 8-5 PM. Please call us if you have any questions about the event. 
-- 	For more information, check out this link: https://events.olemiss.edu/event.php?value=4726 ",
-- 	'University of Mississippi',
-- 	'2018-10-18',
-- 	'5 PM',
-- 	1
-- );

-- Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,
-- 		announcement_Location,start_date,announcement_time,published
-- 		) values(
-- 	'12',
-- 	'345',
-- 	'Fall 2018 Career Expo',
-- 	"Please join us Wednesday, October 3rd for the All Majors Career Expo in the ballroom of the Inn at Ole Miss from12:00 pm - 4:00 pm. Career fairs provide students with a wonderful opportunity to network with employers and practice discussing qualifications in a professional setting. Whether you're a senior looking for a full-time job or a sophomore looking to make connections and gain career fair experience, all majors are welcome to come and explore various job and internship opportunities. 
-- 	Don't forget to dress professionally and bring plenty of copies of your resume. In the meantime, consider stopping by the Career Center to get your resume critiqued. We are open Monday-Friday from 8-5 PM. Please call us if you have any questions about the event. 
-- 	For more information, check out this link: https://events.olemiss.edu/event.php?value=4726 ",
-- 	'University of Mississippi',
-- 	'2018-10-18',
-- 	'5 PM',
-- 	1
-- );

-- START TRANSACTION;

-- Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,
-- 		announcement_Location,start_day,announcement_time,published
-- 		) values(
-- 	'12',
-- 	465789,
-- 	'Multiple Submitter',
-- 	"For more information, check out this link: https://events.olemiss.edu/event.php?value=4726 ",
-- 	'University of Mississippi',
-- 	'2018-10-18',
-- 	'5 PM',
-- 	1
-- );
-- INSERT INTO submitter(submitter_ID,
--                          announcement_ID,
--                          contact_Name,
--                          email,
--                          phone,
-- 						 S_organization)
-- VALUES(1,465789,'Sameer Dhoju','samee.dhoju@gmail.com','6622024876','sadasd'),
--      (2,465789,'Soul Shakerrr','sdhoju@go.olemiss.edu','132456798','asdghk');
      
-- COMMIT;

--  START TRANSACTION;
--  Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,
--  	announcement_Location,start_day,end_day,announcement_time,published) 
--  values(1541898975,1541898975,'Halloween Party ',' asdasdf','Student Union',
--  	'11-23-2018',NULL,'5 PM – 6:30 PM',0);
-- INSERT INTO submitter(announcement_ID,contact_Name,email,phone,S_organization)VALUES
--  (1541898975,'Sameer Dhoju','sa@gmail.com','','');
 
--  COMMIT;