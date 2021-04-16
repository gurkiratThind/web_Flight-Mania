<?php
require_once 'global_defines.php';

class WebPage
{
    public $icon = PAGE_DEFAULT_ICON;
    public $website = WEB_SITE_NAME;
    public $title = PAGE_DEFAULT_TITLE;
    public $Content = '';

    public function render()
    {
        if ($Content = '') {
            echo 'Error';
        } else {?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!--

Template 2093 Flight

http://www.tooplate.com/view/2093-flight

-->
    <title>Flight - Travel and Tour</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/fontAwesome.css">
    <link rel="stylesheet" href="css/hero-slider.css">
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/tooplate-style.css">
    <link rel="stylesheet" href="css/ticket.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/catalog.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="js/price.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body>
    <header>

        <section class='page-heading' id='top'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-6'>
                        <div class='logo'>
                            <img src='img/logo.png' alt='Flight Template'>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </header>
    <nav>
        <ul>
            <li class="nav" id="home"><a href="index.php?op=0" class="red"><i class="fa fa-home"></i> Home</a></li>
            <!-- <li class="nav" id="signin"><a href="index.php?op=2" class="red"><i class="fa fa-phone"></i> Sign-in</a>
            </li>
            <li class="nav" id="signup"><a href="index.php?op=2" class="red"><i class="fa fa-phone"></i> Sign-up</a> -->
            <!-- </li> -->
            <li class="nav" id="con"><a href="index.php?op=2" class="red"><i class="fa fa-phone"></i> Contact Us
                    Now</a>
            </li>
            <li class="nav" id="cart">
                <span>1</span><a href="index.php?op=3" class="red"><i class="fa fa-shopping-cart"></i> Wish List</a>
            </li>
            <?php
            if ($_SESSION['userName'] === '') {
                echo '<li class="nav" id="new">';
                echo '<a class="red" data-toggle="dropdown" ><span class="glyphicon glyphicon-user">Signin&nbsp;</span><span class="caret"></span>';
                echo '</a>';
                echo '<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';
                echo '<li><a href="index.php?op=53">Register</a></li>';
                echo ' <li class="dropdown-submenu">';
                echo ' <a tabindex="-1" href="index.php?op=51">Sign in</a>';
                echo '  <ul class="dropdown-menu">';
                echo '     <li><a tabindex="-1" href="index.php?op=51">Manager Sign in</a></li>';
                echo '       <li><a href="index.php?op=51">Customer Sign in</a></li>';
                echo ' </li>';
                echo ' </ul>';
                echo '</li>';
                echo ' </ul>';
                echo ' </li>';
            } else {
                echo '<li class="nav" id="old">';
                echo '<a class="red" data-toggle="dropdown"><span class="glyphicon glyphicon-user"';
                echo ' id="wuser">Welcome!'.$_SESSION['userName'].'</span>';
                echo ' <span class="caret"></span>';
                echo ' </a>';
                echo ' <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';
                echo '<li><a href="showhistory.php">History</a></li>';
                echo '<li><a href="#" id="logout">Sign out</a></li>';
                echo ' </ul>';
                echo ' </li>';
            }
    ?>
        </ul>
    </nav>
    <main>
        <?php
    echo $this->Content;
    ?>
    </main>
    <footer>
        <div class='container'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='primary-button'>
                        <a href='#' class='scroll-top'>Back To Top</a>
                    </div>
                </div>
                <div class='col-md-12'>
                    <ul class='social-icons'>
                        <li><a href='https://www.facebook.com/'><i class='fa fa-facebook'></i></a></li>
                        <li><a href='#'><i class='fa fa-twitter'></i></a></li>
                        <li><a href='#'><i class='fa fa-linkedin'></i></a></li>
                        <li><a href='#'><i class='fa fa-rss'></i></a></li>
                        <li><a href='#'><i class='fa fa-behance'></i></a></li>
                    </ul>
                </div>
                <div class='col-md-12'>
                    <p>Copyright &copy; 2018 Flight Tour and Travel Company</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
<?php
}
    }
}
