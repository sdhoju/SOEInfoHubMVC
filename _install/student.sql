DROP TABLE IF EXISTS students;
CREATE TABLE students(
  student_ID   int(10) NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(50),
  middle_name VARCHAR(50),
  last_name VARCHAR(50),
  email VARCHAR(50),
  major_ID int(2),
  hours_earned int(50),
  subscribed int(1),
  secret varchar(18),
  PRIMARY KEY (student_ID),
 FOREIGN KEY (major_ID) REFERENCES major(major_ID)
);

insert into students (first_name,middle_name,last_name,email,major_ID,hours_earned,subscribed) VALUES
			("Sameer"," ","Dhoju","sdhoju@go.olemiss.edu",5,115,'asdasdasdasd',1),
                  ("Andrew"," ","Sullivan","1as@test.com",1,47 ,'kjashdaskjd',1),
                  ("Abigail","Gabriel","Gabriel","2agg@test.com",2,120,'yuokjljjh',1),
                  ("Gabriel"," ","Victoria","3gb@test.com",3,26,"asdasd",1),
                  ("Victoria"," ","Stevenson","4vs@test.com",4,127,'asdasda',1),
                  ("Ronald"," ","Stevenson","5rs@test.com",5,79,'ihkasd',1),
                  ("Robert"," ","Stevenson","6saa@test.com",6,55,'oiyhklasd',1),
                  ("David"," ","Ronald","7dr@test.com",7,147,'oiklj',1),
                  ("Darian"," ","Ronald","8dr@test.com",8,89,'hihjop',1),
                  ("Hunter"," ","Ronald","9dr@test.com",9,86,'poluohj',1),
                  ("Stevenson"," ","Ronald","1sr@test.com",1,56,'hadsoiu',1);

DROP TABLE IF EXISTS subscribers;
        CREATE TABLE subscribers(
          student_ID   int(10) NOT NULL AUTO_INCREMENT,
          first_name VARCHAR(50),
          middle_name VARCHAR(50),
          last_name VARCHAR(50),
          email VARCHAR(50),
          major_ID int(2),
          hours_earned int(50),
          subscribed int(1),
          secret varchar(18),
          PRIMARY KEY (student_ID),
        FOREIGN KEY (major_ID) REFERENCES major(major_ID)
        );
        
insert into subscribers (first_name,middle_name,last_name,email,major_ID,hours_earned,subscribed) VALUES
          ("Bryce"," ","Ronald","1brr@test.com",10,-1,'yoiasdy',1),
          ("Noah"," ","Ronald","2nrr@test.com",10,-1,'hhiujasd',1),
          ("Isuru"," ","Ronald","3irr@test.com",10,-1,'uihasd',1),
          ("Juliana"," ","Ronald","4jrr@test.com",10,-1,'pioasas',1),
          ("Alexandra"," ","Ronald","5arrs@test.com",10,-1,'opikooi',1),
          ("Justin"," ","Ronald","6jrr@test.com",10,-1,'uiaiisd',1),
          ("Kelly"," ","Ronald","7kr@test.com",10,-1,'huasd',1),
          ("Tristan"," ","Stevenson","8ts@test.com",10,-1,'oiuasd',1),
          ("Caroline"," ","Stevenson","9cs@test.com",10,-1,'asdonas',1),
          ("Jennifer"," ","Stevenson","10jss@test.com",10,-1,'sadasj',1),
          ("Denaye"," ","Ronald","10dr@test.com",10,-1,'oouasta',1);