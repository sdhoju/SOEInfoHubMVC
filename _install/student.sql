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
  PRIMARY KEY (student_ID),
 FOREIGN KEY (major_ID) REFERENCES major(major_ID)
);

insert into students (first_name,middle_name,last_name,email,major_ID,hours_earned,subscribed) VALUES
			("Sameer"," ","Dhoju","sdhoju@go.olemiss.edu",5,115,1),
                  ("Andrew"," ","Sullivan","1as@test.com",1,47 ,1),
                  ("Abigail","Gabriel","Gabriel","2agg@test.com",2,120,1),
                  ("Gabriel"," ","Victoria","3gb@test.com",3,26,1),
                  ("Victoria"," ","Stevenson","4vs@test.com",4,127,1),
                  ("Ronald"," ","Stevenson","5rs@test.com",5,79,1),
                  ("Robert"," ","Stevenson","6saa@test.com",6,55,1),
                  ("David"," ","Ronald","7dr@test.com",7,147,1),
                  ("Darian"," ","Ronald","8dr@test.com",8,89,1),
                  ("Hunter"," ","Ronald","9dr@test.com",9,86,1),
                  ("Denaye"," ","Ronald","10dr@test.com",10,95,1),
                  ("Bryce"," ","Ronald","1brr@test.com",1,57,1),
                  ("Noah"," ","Ronald","2nrr@test.com",2,53,1),
                  ("Isuru"," ","Ronald","3irr@test.com",3,34,1),
                  ("Juliana"," ","Ronald","4jrr@test.com",4,124,1),
                  ("Alexandra"," ","Ronald","5arrs@test.com",5,43,1),
                  ("Justin"," ","Ronald","6jrr@test.com",6,205,1),
                  ("Kelly"," ","Ronald","7kr@test.com",7,43,1),
                  ("Tristan"," ","Stevenson","8ts@test.com",8,50,1),
                  ("Caroline"," ","Stevenson","9cs@test.com",9,73,1),
                  ("Jennifer"," ","Stevenson","10jss@test.com",10,23,1),
                  ("Stevenson"," ","Ronald","1sr@test.com",1,56,1);