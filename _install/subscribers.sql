DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS subscribers;

-- CREATE TABLE students(
--   student_ID   int(10) NOT NULL AUTO_INCREMENT,
--   first_name VARCHAR(50),
--   middle_name VARCHAR(50),
--   last_name VARCHAR(50),
--   email VARCHAR(50),
--   major_ID int(2),
--   hours_earned int(50),
--   subscribed int(1),
--   secretchar varchar(18),
--   PRIMARY KEY (student_ID),
--  FOREIGN KEY (major_ID) REFERENCES major(major_ID)
-- );

CREATE TABLE subscribers(
          ID   varchar(50) NOT NULL,
          first_name VARCHAR(50),
          middle_name VARCHAR(50),
          last_name VARCHAR(50),
          email VARCHAR(50),
          major_ID int(2),
          hours_earned int(3),
          subscribed int(1),
          PRIMARY KEY (ID),
        FOREIGN KEY (major_ID) REFERENCES major(major_ID)
        );

Insert into subscribers (ID,first_name,middle_name,last_name,email,major_ID,hours_earned,subscribed) 
        values('5bfe5476a802f','SAmeer','','Dhoju','samee.dhoju@gmail.com',10,-1,1),
                  ('kjashdaskjd',"Student"," ","1","soulshakerrr26@gmail.com",1,47 ,1),
                  ('yuokjljjh',"Abigail","Gabriel","Gabriel","2agg@test.com",2,120,1),
                  ("asdasd","Gabriel"," ","Victoria","3gb@test.com",3,26,1),
                  ('asdasda',"Victoria"," ","Stevenson","4vs@test.com",4,127,1),
                  ('ihkasd',"Ronald"," ","Stevenson","5rs@test.com",5,79,1),
                  ('oiyhklasd',"Robert"," ","Stevenson","6saa@test.com",6,55,1),
                  ('oiklj',"David"," ","Ronald","7dr@test.com",7,147,1),
                  ('hihjop',"Darian"," ","Ronald","8dr@test.com",8,89,1),
                  ('poluohj',"Hunter"," ","Ronald","9dr@test.com",9,86,1),
                  ('hadsoiu',"Stevenson"," ","Ronald","1sr@test.com",1,56,1),
                  ('yoiasdy',"Bryce"," ","Ronald","1brr@test.com",10,-1,1),
                  ('hhiujasd',"Noah"," ","Ronald","2nrr@test.com",10,-1,1);
   