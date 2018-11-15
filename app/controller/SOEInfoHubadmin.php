<?php
class SOEInfoHubAdmin extends Controller
{
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/admin/login.php';
        require APP . 'view/_templates/footer.php';
    }

    public function login()
    {
        if (isset($_POST["login"])) {

            $username = $_POST["username"];
            $password = $_POST["password"];
            $login = $this->admin->getUserByUsername($username);
            // print_r($login);

            if(password_check($password,$login->password))
            {
				$_SESSION["username"]=$login->username;
				if($login->admin==1){
					$_SESSION["admin"]=$login->username;
                    header('location: ' . URL.'SOEInfoHubadmin/dashboard' );
                	}
				else{
                    $_SESSION["message"] = "Not an admin";
                    header('location: ' . URL.'SOEInfoHubadmin/index' );
				}
			}
			
			else {
			  $_SESSION["message"] = "Username/Password don't match";
            //   echo 'to login';
            header('location: ' . URL.'SOEInfoHubadmin/index' );

            }
            
        }
    }

    public function dashboard()
    {
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Admin ";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else{
            $announcements = $this->admin->getAllAnnouncements();
            require APP . 'view/_templates/header.php';
            require APP . 'view/admin/dashboard.php';
            require APP . 'view/_templates/footer.php';
        }
   
    }

    public function edit($announcement_ID)
    {
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Admin ";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else{
            require APP . 'view/_templates/header.php';
            require APP . 'view/admin/editAnnouncement.php';
            require APP . 'view/_templates/footer.php';


        }
   
    }

    public function delete()
    {
        if (!isset($_SESSION["username"]) || !isset($_SESSION["admin"])) {
            $_SESSION["message"] = "Admin ";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }else{
            if(isset($_POST["delete_announcement"])){
                $result= $this->admin->deleteAnnouncement($_POST['announcement_ID']);
                if($result!=0){
                    $_SESSION["message"] = "Announcement successfully deleted! ";
                    header('location: ' . URL.'SOEInfoHubadmin/dashboard' );
                }
                else{
                    $_SESSION["message"] = "Announcement couldn't be deleted! ";
                    header('location: ' . URL.'SOEInfoHubadmin/dashboard' );
                }
            }
           
        }
   
    }

    public function logout(){
    
        
        if(!isset($_SESSION["username"])) {
            $_SESSION["message"] = "You must login in first!";
            header('location: ' . URL.'SOEInfoHubadmin/index' );
        }
        
         $_SESSION["username"] = NULL;
         header('location: ' . URL.'SOEInfoHubadmin/index' );
        }
    
    

}