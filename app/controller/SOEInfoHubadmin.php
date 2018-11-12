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
}