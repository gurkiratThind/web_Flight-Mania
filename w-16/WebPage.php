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
    <title>
        <?php echo $this->title; ?>
    </title>
    <link rel='stylesheet' href='design.css'>
    <link rel='stylesheet' href='HomePage.css'>
    <link rel='stylesheet' href='global.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </link>
</head>

<body>
    <header>
        <img src="<?php echo $this->icon; ?>" alt="head icon">
        <?php echo $this->website; ?>
        <?php if ($_SESSION['userName'] != '') {?>
        <a class="log" href='index.php?op=55'>
            <img class="himg"
                src="<?php echo $_SESSION['user_img']; ?>"
                alt="<?php echo $_SESSION['userName']; ?>">
            <?php echo $_SESSION['userName']; ?>
        </a>
        <?php } ?>
        <nav>
            <div>
                <ul>
                    <li><a href='index.php?op=0'>Home</a></li>
                    <?php if ($_SESSION['userName'] != '') {?>
                    <li><a href='index.php?op=100'>Log Out</a></li>
                    <?php } else { ?>
                    <li><a href='index.php?op=51'>Log in</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <?php echo $this->Content; ?>
    </main>
    <footer>
        this is footer
    </footer>
</body>

</html>

<?php
}
    }
}
