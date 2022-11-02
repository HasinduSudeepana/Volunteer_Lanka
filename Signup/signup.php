<?php include ('../Navbar/navbar.php') ?>
<style><?php include ('../Navbar/navbar.css') ?></style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <title>Signup</title>
    <body>
    <form action="signup_volunteer.php" method="post">
    <div class="container">
    <h1>Signup</h1><br/><br/>
    <p>Passionate about volunteering? <b>Come join us</b></p><hr>
    
        <label for="role"><b>Role</b></label>
        <div class="select">
        <select id="role" name="role">
            <option value="organizer">Organizer</option>
            <option value="volunteer">Volunteer</option>
            <option value="sponsor">Sponsor</option>
        </select>
        </div>

        <label for="email"><b>Email</b></label>
        <input type="text" name="email">

        <label for="psw"><b>Password</b></label>
        <input type="password" name="psw">

        <label for="confirm-psw"><b>Confirm Password</b></label>
        <input type="password" name="confirm-psw">

        <div class="clearfix">
            <button class="cancel"><b>Cancel</b></button>
            <button class="next"><b>Next</b></button>
        </div>

    </div>
    </form>
    </body>
</head>
</html>