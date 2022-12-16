<?php include('Navbar/navbar.php');
include 'conn.php';
session_start();
$error = null;

if (isset($_REQUEST["next"])) {

    $role = $_POST['role'];
    $email = $_POST['email'];
    $psw = $_POST['psw'];
    $confirm = $_POST['confirm-psw'];

    if ($confirm == $psw) {
        $_SESSION["role"] = $role;
        $_SESSION["email"] = $email;
        $_SESSION["psw"] = password_hash($psw, PASSWORD_BCRYPT);

        switch ($role) {
            case 'volunteer':
                header('Location: signup_volunteer.php');
                break;

            case 'sponsor':
                header('Location: signup_sponsor.php');
                break;

            case 'admin':
                header('Location: signup_auth.php');
                break;
        }
    } else {
        $error = "Password is not matched!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/signup.css">
    <title>Signup</title>
</head>

<body>
    <div class="main">
        <form action="signup.php" method="post">
            <div class="container">
                <h1>Signup</h1><br /><br />
                <p>Passionate about volunteering? <b>Come join us</b></p>
                <hr>

                <?php
                if ($error) {
                    echo '<label id="error"> ' . $error . '</label><br/><br/>';
                } ?>

                <label for="role"><b>Role</b></label>
                <label id="require"><strong>*</strong></label>

                <div class="select">
                    <select id="role" name="role" required>
                        <option value="organizer">Organizer</option>
                        <option value="volunteer">Volunteer</option>
                        <option value="sponsor">Sponsor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <label for="email"><b>Email</b></label>
                <label id="require"><strong>*</strong></label>
                <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required>

                <label for="psw"><b>Password</b></label>
                <label id="require"><strong>*</strong></label>
                <input type="password" name="psw" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>


                <label for="confirm-psw"><b>Confirm Password</b></label>
                <label id="require"><strong>*</strong></label>
                <input type="password" name="confirm-psw" required>

                <div class="clearfix">
                    <button class="cancel">Cancel</button>
                    <button class="next" name="next">Next</button>
                </div>

            </div>
        </form>
    </div>
</body>

</html>