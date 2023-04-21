<?php 
class ChatModel extends Model{
    function __construct()
    {
        parent::__construct();
    }
    //to get our user name after clicking chat icon from our home page
    function getUserDatatoChat($uid,$role){
        $query = "SELECT Name FROM " .$role. " WHERE U_ID = '$uid'";
        $statement = $this->db->prepare($query);
        if ($statement->execute()) {
            // if query successful
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            // if query failed
            return 'query failed';
        }
    }
    // function searchUserInChat($outgoing_id,$searchTerm){
    //     $query = "SELECT * FROM organizer WHERE NOT U_ID = {$outgoing_id} AND (Name LIKE '%{$searchTerm}%')";
    //     $statement = $this->db->prepare($query);
    //     if ($statement->execute()) {
    //         // if query successful
    //         return $statement->fetch(PDO::FETCH_ASSOC);
    //     } else {
    //         // if query failed
    //         return 'query failed';
    //     }
    // }
    //to get all user names to our chat
    function getAlluserstochat($uid){
        $query = "SELECT 
                  organizer.U_ID, organizer.Name, user.Role FROM organizer INNER JOIN user ON 
                  organizer.U_ID=user.U_ID  WHERE NOT user.U_ID = {$uid} 
                  UNION 
                  SELECT sponsor.U_ID, sponsor.Name, user.Role FROM sponsor INNER JOIN user ON 
                  sponsor.U_ID=user.U_ID  WHERE NOT user.U_ID = {$uid}";
        $statement = $this->db->prepare($query);
        if ($statement->execute()) {
            // if query successful
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // if query faileds
            return 'query failed';
        }
    }
    //get last message to our chat
    function getLastmsg($uid){
        $query = "SELECT * FROM messages WHERE (incoming_msg_id = {$uid}
        OR outgoing_msg_id = {$uid}) AND (outgoing_msg_id = {$uid} 
        OR incoming_msg_id = {$uid}) ORDER BY msg_id DESC LIMIT 1";
         $statement = $this->db->prepare($query);
         if ($statement->execute()) {
             // if query successful
             return $statement->fetchAll(PDO::FETCH_ASSOC);
         } else {
             // if query failed
             return 'query failed';
         }
    }
    //to get username of the user we click
    function getUserName($user_id,$user_role){
        $query = "SELECT Name FROM " .$user_role. " WHERE U_ID = '$user_id'";
        $statement = $this->db->prepare($query);
         if ($statement->execute()) {
             // if query successful
             return $statement->fetch(PDO::FETCH_ASSOC);
         } else {
             // if query failed
             return 'query failed';
         }
    }
    function getAllMessages(){
        
    }
}




?>