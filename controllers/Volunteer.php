<?php

class Volunteer extends User
{
    function index()
    {
        $this->render('Volunteer/Home');
    }

    function upcoming_projects()
    {
        $this->render('Volunteer/Upcoming_projects');
    }

    function completed_projects()
    {
        $this->render('Volunteer/Completed_projects');
    }

    function request_projects()
    {
        session_start();
        $uid = $_SESSION['uid'];
        $this->loadModel('ProjectIdea');
        $this->pr_ideas = $this->model->getProjectIdea($uid);

        foreach ($this->pr_ideas as $idea) {
            $pi_id = $idea['PI_ID'];
            $this->pr_idea_images[$pi_id] = $this->model->getPI_Image($pi_id);
        }
        $this->render('Volunteer/New_ideas');
    }

    function profile()
    {
        $this->render('Volunteer/Profile');
    }

    function newIdeas()
    {
        $this->render('Volunteer/Request_projects');
    }

    function insertIdeas()
    {
        session_start();
        $location = $_POST['location'];
        $description = $_POST['des'];
        $uid = $_SESSION['uid'];

        $this->loadModel('ProjectIdea');
        $this->model->setProjectIdea($description, $location, $uid);

        $pi_id = $this->model->getPiId($uid, $location);
 
        $targetDir = "public/images/pi_images/";
        $allowTypes = array('jpg','png','jpeg','gif');

        if (!empty($_FILES["file"]["name"])) {

            $total = count($_FILES['file']['name']);
            for ($i = 0; $i < $total; $i++) {
                $fileName = $_FILES['file']['name'][$i];
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["file"]["tmp_name"][$i], $targetFilePath)){
                        $this->model->setPiImage($pi_id, $fileName);
                    }
                }else{
                    $statusMsg = 'Only JPG, JPEG, PNG & GIF files are allowed to upload.';
                }
            }
        }
        
    }


}