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
        $sql ="SELECT announcement.announcement_ID as announcement_ID, announcement_Title, announcement_Text, announcement_Location , start_day,start_time,end_day,end_time, 
                                group_Concat(Contact_Name) as contact_Names, group_Concat(email)as emails ,group_Concat(phone) as phones,group_Concat(s_organization) as orgs,
                                group_Concat(file_name) as attachments
                                from (announcement natural join submitter)
                                left join announcementFile on announcement.announcement_ID = announcementFile.announcement_ID group by announcement.announcement_ID; ";

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

    /**
     * Get an Announcement by ID from database
     */
    public function getAnnouncementByID($announcement_ID)
    {
        //published =1 AND
        $sql = "SELECT * FROM announcement natural join announcementFile WHERE  announcement_ID = :announcement_ID  LIMIT 1 ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch();
    }
  
    public function addAnnouncement($created_at,$announcement_ID,$contact_Name, $email,$phone=[],$S_Organization=[],
        $announcement_Title,$announcement_Text,$announcement_Location,$start_day,$start_time,$end_day,$end_time,
        $majors,$classifications,$filenames)
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
                            ':published' => 0
                                );
       

       $sql="START TRANSACTION;";
       $sql.= "Insert into announcement (created_at,announcement_ID,announcement_Title,announcement_Text,announcement_Location,start_day,start_time,end_day,end_time,published) 
                values(:created_at,:announcement_ID,:announcement_Title,:announcement_Text,:announcement_Location,:start_day,:start_time,:end_day,:end_time,:published);";
        
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
        
        
        $sql.= "INSERT INTO announceMajor(announcement_ID,major_ID)VALUES";
        for($x = 0; $x < sizeof($majors); $x++){
            $sql.="(:announceMajorannounce_ID$x,:majors$x),";
            $parameters[":announceMajorannounce_ID$x"]=$announcement_ID;
            $parameters[":majors$x"]=$majors[$x];
        }
        $sql= rtrim($sql,',');
        $sql.=";";   

        $sql.= "INSERT INTO announceCls(announcement_ID,cls_ID)VALUES";
        for($x = 0; $x < sizeof($classifications); $x++){
            $sql.="(:announceClsannounce_ID$x,:classifications$x),";
            $parameters[":announceClsannounce_ID$x"]=$announcement_ID;
            $parameters[":classifications$x"]=$classifications[$x];
        }
        $sql= rtrim($sql,',');
        $sql.=";";  

        $sql.= "INSERT INTO announcementFile(announcement_ID,file_name)VALUES";
        for($x = 0; $x < sizeof($filenames); $x++){
            $sql.="(:announcementFileannounce_ID$x,:filenames$x),";
            $parameters[":announcementFileannounce_ID$x"]=$announcement_ID;
            $parameters[":filenames$x"]=$filenames[$x];
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
}