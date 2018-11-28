<?php
class Admin extends Model
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getAllAnnouncements()
    {
        $sql ="SELECT announcement.announcement_ID as announcement_ID, announcement_Title, announcement_Text, announcement_Location ,
                                 start_day,start_time,end_day,end_time, published, 
                                group_Concat(DISTINCT  Contact_Name) as contact_Names, group_Concat(email)as emails ,group_Concat(  phone) as phones,group_Concat(  s_organization) as orgs,
                                group_Concat(file_name) as attachments
                                from (announcement natural join submitter)
                                left join announcementFile on announcement.announcement_ID = announcementFile.announcement_ID group by announcement.announcement_ID order by published;
                                ";

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

    public function getUserByUsername($username){
        $sql = "SELECT * FROM SOEIHuser WHERE  username = :username  LIMIT 1 ";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch();
    }

    public function deleteAnnouncement($announcement_ID){
        $sql="START TRANSACTION;";
        $sql.= "Delete  FROM announcementFile WHERE  announcement_ID = :announcement_IDF; ";
        $sql.= "Delete FROM announceMajor WHERE  announcement_ID = :announcement_IDM ;";
        $sql.= "Delete  FROM announceCls WHERE  announcement_ID = :announcement_IDC ;";
        $sql.= "Delete  FROM submitter WHERE  announcement_ID = :announcement_IDS ;";

        $sql.= "Delete FROM announcement WHERE  announcement_ID = :announcement_ID;";
        $sql.="COMMIT;";       
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_IDF' => $announcement_ID,
                        ':announcement_IDM' => $announcement_ID,
                        ':announcement_IDC' => $announcement_ID,  
                        ':announcement_IDS' => $announcement_ID,  
                        ':announcement_ID' => $announcement_ID   
                    );
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        // return $query->fetch();
        $reults=0;
        do {
            $reults+= $query->rowCount();
        } while ($query->nextRowset());
        
        return $reults;

    }
    public function getAnnouncement($announcement_ID){
        $sql = "SELECT * FROM announcement WHERE  announcement_ID = :announcement_ID  LIMIT 1 ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch();
    }

    public function getsubmitter($announcement_ID){
        $sql = "SELECT * FROM submitter WHERE  announcement_ID = :announcement_ID  ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetchAll();
    }


    public function getMajors($announcement_ID){
        $sql = "SELECT group_concat(DISTINCT major_ID) as major_ID FROM announceMajor WHERE  announcement_ID = :announcement_ID  group by announcement_ID limit 1;";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch();
    }
    
    public function getClassifications($announcement_ID){
        $sql = "SELECT group_concat(DISTINCT cls_ID) as cls_ID FROM announceCls WHERE  announcement_ID = :announcement_ID  group by announcement_ID limit 1;";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetch();
    }
    
    
    public function getAttachments($announcement_ID){
        $sql = "SELECT * FROM announcementFile WHERE  announcement_ID = :announcement_ID ";
        $query = $this->db->prepare($sql);
        $parameters = array(':announcement_ID' => $announcement_ID);
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->fetchAll();
    }

    public function togglePublish($announcement_ID){
        $sql ="UPDATE announcement SET published = IF(published=1, 0, 1)where announcement_ID=:announcement_ID";
        $query = $this->db->prepare($sql);
        $parameters = array( ':announcement_ID' => $announcement_ID    );
        $query->execute($parameters);
        // fetch() is the PDO method that get exactly one result
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        // return $query->fetch();
        $reults=0;
        do {
            $reults+= $query->rowCount();
        } while ($query->nextRowset());
        
        return $reults;
    }

    
    public function getPublishStatus($announcement_ID){
        $sql ="select Published from announcement where announcement_ID=:announcement_ID";
        $query = $this->db->prepare($sql);
        $parameters = array( ':announcement_ID' => $announcement_ID    );
        $query->execute($parameters);
        return $query->fetch();

    }
    
    public function getAnnounceMajorByID($announcement_ID){
        $sql ="select major_ID from announceMajor where announcement_ID=:announcement_ID";
        $query = $this->db->prepare($sql);
        $parameters = array( ':announcement_ID' => $announcement_ID    );
        $query->execute($parameters);
        return $query->fetchAll();

    }
    

    public function getTargetedStudentsEmail($major_ID,$classifications){
        $fr = " (hours_earned >0 and hours_earned <30) ";
        $so = " (hours_earned >=30 and hours_earned <60) ";
        $ju = " (hours_earned >=60 and hours_earned <90) ";
        $se = " (hours_earned >=90) ";
        $other = "(hours_earned = -1) ";

        $clsCon='  and (';
        $count=sizeof($classifications);
        foreach($classifications as $cls){
            if ($cls==1)
                $clsCon.=$fr;
            elseif($cls==2)
                $clsCon.=$so;
            elseif($cls==3)
                $clsCon.=$ju;
            elseif($cls==4)
                $clsCon.=$se;
            elseif($cls==5)
                $clsCon.=$other;
            $count= $count-1;    
            if($count >1 ){
                $clsCon.=' OR ';
            }    
        }
        $clsCon.=' )';

        $sql ="select first_name,middle_name,last_name, email from students where major_ID=:major_ID and  subscribed = 1 $clsCon ;";
        $query = $this->db->prepare($sql);
        $parameters = array( ':major_ID' => $major_ID );
        $query->execute($parameters);
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->fetchAll();

    }

}