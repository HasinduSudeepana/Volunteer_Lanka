<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: ' . BASE_URL);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/styles/blog.css">
    <title>My Blog</title>
</head>

<body>
    <!-- navigation bar -->
    <?php include 'views/includes/navbar_log.php'; ?>

    <div class="main" id="main">
        <!-- organization start -->
        <div class="organization">
            <div id="left">
                <img src="<?php echo BASE_URL; ?>public/images/org_image.jpg">
                <h3>Rotaract Club UOC</h3>
            </div>
            <div id="right">
                <p>A proud member of the Colombo Uptown Rotary family, the Rotaract Club of University of Colombo, Faculty of Arts was charted on the 26th of March 2010. The Club slogan, "United We Stand in Diversity", represents our hope for the club as well as our country. During the period since its charter, the club has been recognised at the District Rotaract Assembly for its numerous projects along with the Rotary and Rotaract district citations and recognition as one of the best reporting clubs.</p>
            </div>
        </div>
        <!-- organization end -->

        <!-- ***posts*** -->
        <div class="post-container">
            <div class="post-images">
                <img src="<?php echo BASE_URL; ?>public/images/card-img1.jpg">
                <img src="<?php echo BASE_URL; ?>public/images/card-img2.jpg">
                <img src="<?php echo BASE_URL; ?>public/images/card-img3.jpg">
            </div>
            <p class="description">
                fjbfjhbjbsdbfsdbfshjbfshdshhfshbfjshdjhs jsdjad dbsjbjad ajdabdjas asbdajbda bsajdjds asjajd
            </p>
        </div>
    </div>

</body>

</html>