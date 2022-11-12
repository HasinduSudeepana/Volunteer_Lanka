<?php
require 'conn.php';
session_start();
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
}
require 'Navbar/navbar_log.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cards/cards.css">
    <title>Upcoming Projects</title>
</head>
<body>
<div id="main" class="main">
    <br/><h2>Upcoming Projects</h2><br/><br/>
    <section class="container">
        <div class="card">
            <div class="card-image card1">
            </div>
            <h2>Project Name</h2>
            <p>Date</p>
            <a class="btn" href="">View</a>
        </div>
        <div class="card">
            <div class="card-image card2">
            </div>
            <h2>Project Name</h2>
            <p>Date</p>
            <a class="btn" href="">View</a>
        </div>
        <div class="card">
            <div class="card-image card3">
            </div>
            <h2>Project Name</h2>
            <p>Date</p>
            <a class="btn" href="">View</a>
        </div>
    </section>
</div>
</body>
</html>