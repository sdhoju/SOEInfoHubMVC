/* INSERT into major(major_Name) VALUES
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

 */




START TRANSACTION;
Insert into announcement 
				(created_at,announcement_ID,announcement_Title,announcement_Text,
				announcement_Location,start_day,start_time,end_day,end_time,external_link,published) 
				values(1542062366,1542062366,'Thanksgiving Potluck at OXCM + Harvest Angel Project',
				' aasdasd','Student Union','11-24-2018','5:00','11-25-2018','5:00','asd',1);
				INSERT INTO submitter(announcement_ID,contact_Name,email,phone,S_organization)
				VALUES(1542062366,'asd','sdhoju@go.olemiss.edu','132-465-4657','');
COMMIT;

