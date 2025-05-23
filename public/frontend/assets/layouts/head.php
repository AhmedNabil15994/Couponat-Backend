<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/icon.png">
    <title>couponat</title>
    <!-- CSS Files -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/font/icons/bootstrap-icons.css" />
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" />

    <?php 
    if(isset($styles) && count($styles)){
        foreach($styles as $style){
            echo "<link rel=\"stylesheet\" href=\"assets/css/{$style}.css\">";
        }
    }
    ?>
    <link rel="stylesheet" href="assets/css/venobox.min.css">
    <link rel="stylesheet" href="assets/font/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/date-picker.css">
    <link rel="stylesheet" href="assets/css/style-ar.css" />
    <link rel="stylesheet" href="assets/css/responsive-ar.css" />
</head>

<body>
  