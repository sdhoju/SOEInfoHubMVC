DROP TABLE IF EXISTS students;
CREATE TABLE students(
  student_ID   int(10) NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(50),
  middle_name VARCHAR(50),
  last_name VARCHAR(50),
  email VARCHAR(50),
  major_ID int(2),
  hours_earned int(50),
  PRIMARY KEY (student_ID),
 FOREIGN KEY (major_ID) REFERENCES major(major_ID)
);

insert into students (first_name,middle_name,last_name,email,major_ID,hours_earned) VALUES
			("Sameer"," ","Dhoju","sdhoju@go.olemiss.edu",5,115);

insert into students (first_name,middle_name,last_name,email,major_ID,hours_earned) VALUES 
      ("Marni"," ","Kendricks","mckendri@olemiss.edu",5,20);

-- insert into students (first_name,middle_name,last_name,email,major_ID,hours_earned) VALUES 
--       ("Marni"," ","Kendricks","mckendri@olemiss.edu",5,20);

-- insert into students (first_name,middle_name,last_name,email,major_ID,hours_earned) VALUES 
--       ("Marni"," ","Kendricks","mckendri@olemiss.edu",5,20);