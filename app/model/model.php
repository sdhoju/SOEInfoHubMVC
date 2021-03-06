<?php
class Model
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all announcements from database
     */
    public function getAllAnnouncements()
    {
        date_default_timezone_set('America/Chicago');
        $today = date('Y-m-d');
        // echo  $today; exit();
        $sql ="SELECT announcement.announcement_ID as announcement_ID, announcement_Title, announcement_Text, announcement_Location ,
                               start_day,start_time,end_day,end_time, external_link,
                                group_Concat(DISTINCT  Contact_Name SEPARATOR ',,,') as contact_Names, group_Concat(email SEPARATOR ',,,')as emails ,
                                group_Concat(  phone SEPARATOR ',,,') as phones,group_Concat(  S_organization SEPARATOR ',,,') as orgs,
                                file_name  as attachments,
                                group_Concat(DISTINCT major_ID SEPARATOR ',') as major_IDs,
                                group_Concat(DISTINCT cls_ID SEPARATOR ',') as cls_IDs

                                from (announcement natural join submitter natural join announceMajor natural join announceCls)
                                left join announcementFile on announcement.announcement_ID = announcementFile.announcement_ID 
                                where Published =1 and start_day >= '$today' 
                                group by announcement.announcement_ID order by start_day ;
                                ";
                                //limit 10

        $query = $this->db->prepare($sql);
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute();
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        
        return $query->fetchAll();
    }
  

  
    public function addAnnouncement(
        $created_at,$announcement_ID,
        $contact_Name, $email,$phone=[],$S_Organization=[],
        $announcement_Title,$announcement_Text,$announcement_Location,$start_day,$start_time,$end_day,$end_time, $external_link,
        $majors,$classifications,
        $filenames,$filetypes)
    {
        
        $parameters = array(':created_at' => $created_at, 
                            ':announcement_ID' => $announcement_ID, 
                            ':announcement_Title' => $announcement_Title,
                            ':announcement_Text' => $announcement_Text, 
                            ':announcement_Location' => $announcement_Location, 
                            ':start_day' => $start_day,
                            ':start_time' => $start_time,
                            ':end_day' => $end_day, 
                            ':end_time' => $end_time, 
                            ':external_link' => $external_link,
                            ':published' => 0
                                );
       
        //Start Transaction
       $sql="START TRANSACTION;";

        // Insert into table announcement
       $sql.= "Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,announcement_Location,start_day,start_time,end_day,end_time,external_link,published) 
                values(:created_at,:announcement_ID,:announcement_Title,:announcement_Text,:announcement_Location,:start_day,:start_time,:end_day,:end_time,:external_link,:published);";
            
    
        // Insert into table submitter
        $sql.= "INSERT INTO submitter(announcement_ID,contact_Name,email,phone,S_organization)VALUES";
        for($x = 0; $x < sizeof($contact_Name); $x++){
            $sql.="(:submitterannounce_ID$x,:contact_Name$x,:email$x,:phone$x,:S_organization$x),";
            $parameters[":submitterannounce_ID$x"]=$announcement_ID;
            $parameters[":contact_Name$x"]=$contact_Name[$x];
            $parameters[":email$x"]=$email[$x];
            $parameters[":phone$x"]=$phone[$x];
            $parameters[":S_organization$x"]=$S_Organization[$x];
        }
        $sql= rtrim($sql,',');
        $sql.=";";    
        
        // Insert into table announceMajor
        $sql.= "INSERT INTO announceMajor(announcement_ID,major_ID)VALUES";
        for($x = 0; $x < sizeof($majors); $x++){
            $sql.="(:announceMajorannounce_ID$x,:majors$x),";
            $parameters[":announceMajorannounce_ID$x"]=$announcement_ID;
            $parameters[":majors$x"]=$majors[$x];
        }
        $sql= rtrim($sql,',');
        $sql.=";";   

        // Insert into table announceCLS      
        $sql.= "INSERT INTO announceCls(announcement_ID,cls_ID)VALUES";
        for($x = 0; $x < sizeof($classifications); $x++){
            $sql.="(:announceClsannounce_ID$x,:classifications$x),";
            $parameters[":announceClsannounce_ID$x"]=$announcement_ID;
            $parameters[":classifications$x"]=$classifications[$x];
        }
        $sql= rtrim($sql,',');
        $sql.=";";  

        // Insert into table announceFile
        $sql.= "INSERT INTO announcementFile(announcement_ID,file_name,file_type)VALUES";
        for($x = 0; $x < sizeof($filenames); $x++){
            $sql.="(:announcementFileannounce_ID$x,:filenames$x,:filetypes$x),";
            $parameters[":announcementFileannounce_ID$x"]=$announcement_ID;
            $parameters[":filenames$x"]=$filenames[$x];
            $parameters[":filetypes$x"]=$filetypes[$x];
        }
        $sql= rtrim($sql,',');
        $sql.=";";  
        $sql.="COMMIT;";       
        
        
       
        $query = $this->db->prepare($sql);
        // print_r($parameters);
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        $reults=0;
        do {
            $reults+= $query->rowCount();
        } while ($query->nextRowset());
        
        return $reults;
    }



    public function getAllMajor()
    {
        $sql ="SELECT * from major";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    
    public function getAllClassification()
    {
        $sql ="SELECT * from classification";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


    /**
     * Get an Announcement by ID from database
     */
    public function getAnnouncementByID($announcement_ID)
    {
        //published =1 AND
        $sql = "SELECT * FROM announcement WHERE announcement_ID = :announcement_ID  LIMIT 1 ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch();
    }


    public function getImagesByID($announcement_ID)
    {
        //published =1 AND
        $sql = "SELECT file_name FROM announcementFile WHERE   announcement_ID = :announcement_ID and file_type != 'application/pdf' ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetchAll();
    }

    public function getPdfByID($announcement_ID)
    {
        //published =1 AND
        $sql = "SELECT file_name FROM announcementFile WHERE   announcement_ID = :announcement_ID and file_type = 'application/pdf' ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetchAll();
    }

    public function getContactsByID($announcement_ID)
    {
        //published =1 AND
        $sql = "SELECT * FROM submitter WHERE   announcement_ID = :announcement_ID ; ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetchAll();
    }

    public function getMajorsByID($announcement_ID)
    {
        //published =1 AND
        $sql = "SELECT * FROM announceMajor natural join major WHERE   announcement_ID = :announcement_ID ; ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetchAll();
    }

    public function getClassificationsByID($announcement_ID)
    {
        //published =1 AND
        $sql = "SELECT * FROM announceCls natural join classification WHERE   announcement_ID = :announcement_ID ; ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetchAll();
    }


    public function Emailexist($email){
        $sql = "SELECT email FROM subscribers where email = :email";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        if ($query->rowCount()>0) return true;
        else return false;
    }


    public function addSubscriber($first_name,$middle_name='',$last_name,$email)
    {
        $ID= uniqid(rand(), true);
        $sql= "Insert into subscribers (ID,first_name,middle_name,last_name,email,major_ID,hours_earned,subscribed) 
                values(:ID,:first_name,:middle_name,:last_name,:email,10,-1,1);";
        $query = $this->db->prepare($sql);
        $parameters = array(':ID' => $ID,
                           ':first_name'=> $first_name,
                           ':middle_name'=> $middle_name,
                           ':last_name'=> $last_name,
                           ':email'=> $email
                        );
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        // return $query->fetch();
    
    }
    
    public function getSubscriberID($email)
    {
        $sql = "SELECT ID FROM subscribers where email = :email";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function unsubscribe($ID)
    {
        $sql = "update subscribers set subscribed = 0 where ID =:ID ";
        $query = $this->db->prepare($sql);
        $parameters = array(':ID' => $ID);
        $query->execute($parameters);
    }


    public function resubscribe($ID)
    {
        $sql = "update subscribers set subscribed = 1 where ID =:ID ";
        $query = $this->db->prepare($sql);
        $parameters = array(':ID' => $ID);
        $query->execute($parameters);
    }
}