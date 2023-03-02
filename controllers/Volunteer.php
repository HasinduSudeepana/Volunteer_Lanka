<?php

class Volunteer extends User
{

    function __construct()
    {
        parent::__construct();
        $this->role = 'volunteer';
    }

    function index()
    {
        $this->loadModel('Project');
        $date_now = Time();
        $this->uprojects = $this->model->getUpcomingProjects($date_now);

        foreach ($this->uprojects as $uproject) {
            $pid = $uproject['P_ID'];
            $this->prImage[$pid] = $this->model->getProjectImage($pid);
        }

        $this->projects = $this->model->getSuggestedProjects();
        foreach ($this->projects as $project) {
            $pid = $project['P_ID'];
            $this->prImage[$pid] = $this->model->getProjectImage($pid);
        }

        $this->loadModel('Ad');
        $this->ads = $this->model->getAds();

        foreach ($this->ads as $ad) {
            $adid = $ad['AD_ID'];
            $this->adImage[$adid] = $this->model->getAdImage($adid);
        }

        $this->loadModel('Sponsor');
        foreach ($this->ads as $ad) {
            $uid = $ad['Sponsor'];
            $this->sponsor[$ad['AD_ID']] = $this->model->getSponsorName($uid);
        }
        $this->render('Volunteer/Home');
    }

    function my_upcoming_projects()
    {
        session_start();
        $uid = $_SESSION['uid'];
        $this->loadModel('Project');
        $date_now = Time();
        $jprojects = $this->model->getJoinedProjects($uid);

        foreach ($jprojects as $jproject) {
            $pid = $jproject['P_ID'];
            $this->uprojects = $this->model->getMyUpcomingProjects($pid, $date_now);
            $this->prImage[$pid] = $this->model->getProjectImage($pid);
        }
        $this->render('Volunteer/Upcoming_projects');
    }

    function my_completed_projects()
    {
        session_start();
        $uid = $_SESSION['uid'];
        $this->loadModel('Project');
        $jprojects = $this->model->getJoinedProjects($uid);

        foreach ($jprojects as $jproject) {
            $pid = $jproject['P_ID'];
            $this->cprojects = $this->model->getMyCompletedProjects($pid);
            $this->prImage[$pid] = $this->model->getProjectImage($pid);
        }
        $this->render('Volunteer/Completed_projects');
    }

    function view_projects($pid)
    {
        $this->loadModel('Project');
        $this->project = $this->model->getProject($pid);
        $this->images = $this->model->getProjectImage($pid);
        $this->render('Volunteer/View_project_volunteer');
    }

    function join_form($pid)
    {
        $this->pid = $pid;
        $this->render('Volunteer/Join_form');
    }

    function join_project($pid) {

        if(!isset($_SESSION)) {
            session_start();
        }
        $uid = $_SESSION['uid'];
        $contact = $_POST['contact'];
        $meal = $_POST['radio-meal'];
        $prior = $_POST['radio-prior'];

        if ($prior == 'yes') {
            $prior = 1;
        } else if ($prior == 'no') {
            $prior = 0;
        }

        if ($meal == 'veg') {
            $meal = "Veg";
        } else if ($meal == 'nonveg') {
           $meal = "NonVeg";
        }

        $this->loadmodel('Project');
        $this->model->joinProject($uid, $pid, $contact, $meal, $prior);
    }

    function new_ideas()
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
        session_start();
        $uid = $_SESSION['uid'];
        $this->loadModel('Volunteer');
        $this->profile = $this->model->getUserData($uid);
        $this->user = $this->model->getVolunteerData($uid);

        $this->render('Volunteer/Profile');
    }

    function request_projects()
    {
        $this->render('Volunteer/Request_projects');
    }

    function calendar()
    {
        $this->render('Calendar');
    }

    function search_organizer()
    {
        if (isset($_POST['search'])) {

            $key = trim($_POST['key']);
            $this->loadModel('Organizer');
            $this->organizers = $this->model->searchOrganizers($key);
        } else {
            $this->loadModel('Organizer');
            $this->organizers = $this->model->getOrganizerData();
        }

        $this->render('Volunteer/Search_organizer');
    }

    function view_organizer($uid)
    {
        $this->render('Organizer/Blog');
    }

    function insert_Ideas()
    {
        session_start();
        $location = $_POST['location'];
        $description = $_POST['des'];
        $uid = $_SESSION['uid'];

        $this->loadModel('ProjectIdea');
        $this->model->setProjectIdea($description, $location, $uid);

        $pi_id = $this->model->getPiId($uid, $location);

        $targetDir = "public/images/pi_images/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        if (!empty($_FILES["file"]["name"])) {

            $total = count($_FILES['file']['name']);
            for ($i = 0; $i < $total; $i++) {
                $fileName = $_FILES['file']['name'][$i];
                $targetFilePath = $targetDir . $fileName;
                $fileType =  strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $targetFilePath)) {
                        $this->model->setPiImage($pi_id, $fileName);
                    }
                } else {
                    $statusMsg = 'Only JPG, JPEG, PNG & GIF files are allowed to upload.';
                }
            }
        }
        header('Location: ' . BASE_URL . 'volunteer/new_ideas');
    }

    function delete_ideas($piId)
    {
        $this->loadModel('ProjectIdea');
        $this->model->deleteProjectIdea($piId);
    }

}
