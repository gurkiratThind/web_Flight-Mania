<?php

require_once 'WebPage.php';
require_once 'database.php';

class users
{
    private $error = ['m' => '', 'p' => '', 'f' => 'Forget Password?'];
    private $flag = 0;

    public function displayLoginPage()
    {
        $page = new WebPage();
        $page->title = 'Login';
        $page->Content = <<<HTML
        <div>
        <div class="form" style="color:red" >{$this->error['m']}</div>
            <form action="index.php?op=52" method="POST">
            <input class="form" type="text" Placeholder="UserName" required name="userName" value=""><br>
        <div class="form" style="color:red" >{$this->error['p']}</div>
            <input class="form" type="Password" maxlength="8" Placeholder="Password" required name="Password" ><br>
            <button class="form" value="Submit" >Log in</button><br>
            </div>
            </form>
        <div  class="form" style="color:blue"><a href="#">{$this->error['f']}</a></div>
        <a href="index.php?op=53"><button class="form" value="Submit" >Create New Account</button></a>
        HTML;
        $page->render();
    }

    public function verifyLogin()
    {
        $user_found = false;
        $db = new database();
        $users = $db->querySelect('select * from users');
        foreach ($users as $one) {
            foreach ($one as $key => $value) {
                if ($one['PW'] == $_POST['Password'] && $one['name'] == $_POST['userName']) {
                    $user_found = true;
                    $_SESSION['user_connected'] = true;
                    $_SESSION['User_email'] = $one['email'];
                    $_SESSION['User_Id'] = $one['id'];
                    $_SESSION['userName'] = $one['name'];
                    $_SESSION['user_img'] = $one['user_img'];
                }
            }
        }
        if (!$user_found) {
            $this->error['m'] = 'Invalid Creadentials';
            $this->displayLoginPage();
        } else {
            header('Location: index.php?op=0');
        }
    }

    public function registerUser()
    {
        $Provinces = ['Quebec', 'Ontario'];
        // $provincesSelect = '<select name="province">';
        // foreach ($Provinces as $one) {
        //     $provincesSelect .= '<option value="'.$one['code'].'"'.($one['code'] == $prev_values['province'] ? 'selected' : '').' >'.$one['name'];
        // }
        // $provincesSelect .= '</select>';
        $page = new WebPage();
        $page->title = 'Login';
        $page->Content = <<<HTML
        <div class="form" style="color:red;">{$this->error['m']}</div>
        <!-- if(isset()){
        <div><img class="bgimg" src="{$_SESSION['user_img']}" alt="{$_SESSION['userName']}">
    </div>  
        }  -->
    <form action="index.php?op=54" method="POST">
    <input class="form" type="text" name="fullname" required maxlength="50" placeholder="Name" value=""><br>
    <input class="form" type="address" name="address_line1" placeholder="Address1" maxlength="50" value=""><br>
    <input class="form" type="address" name="address_line2" placeholder="Address2" maxlength="50" value=""><br>
    <input class="form" type="text" name="city" maxlength="50" placeholder="City" value=""><br>
    <input class="form" type="text" name="postal_code" placeholder="Postal Code" value=""><br>
    <label class="abc" >Language :</label><br>
    <label class="abc" >English</label><input  type="radio" name="english" maxlength="50" value="english"><br>
    <label class="abc" >French</label><input   type="radio" name="french" maxlength="50" value="french"><br>
    <label class="abc" >Other </label><input  type="radio" name="french" value="english"><br>
    <input class="form" type="text" name="number" maxlength="10" placeholder="Phone No" value=""><br>
    <input class="form" type="email" name="email" maxlength="126" placeholder="Email" value=""><br>
    <input class="form" type="password" name="PW" maxlength="8" placeholder="Password" value=""><br>
    <input class="form" type="password" name="RPW" maxlength="8" placeholder="Confirm Password" value=""><br>
    <!-- <label class="form" for="user_img"> select pic</label><br>
    <input class="form" type="file" name="user_pic"><br> -->
    <input class="form" type="submit" value="Submit">
    <div class="form"></div>
    </form>
    HTML;
        $page->render();
    }

    public function verifyRegisterUser()
    {
        $email_t = false;
        // $DB = new db_pdo();
        // $users = $DB->querySelect('select * from users');
        if (isset($_POST['email']) && (isset($_POST['PW']))) {
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['PW'];
            $address1 = $_POST['address_line1'];
            $city = $_POST['city'];
            $phone = $_POST['number'];
        } else {
            crash(500, 'email Not found in login form ,class users.php');
        }

        if (strlen($_POST['PW']) != 8) {
            $this->error['m'] = 'Password must be 8 character<br>';
        }
        if ($_POST['PW'] !== $_POST['RPW']) {
            $this->error['m'] = 'Both Passwords are not identicals<br>';
        }
        if (strlen($_POST['postal_code']) !== 7) {
            $this->error['m'] = 'Postal code is not acceptable<br>';
        }
        if (strlen($_POST['fullname']) < 4) {
            $this->error['m'] = 'Name is not acceptable<br>';
        }

        // foreach ($users as $one) {
        //     foreach ($one as $key => $value) {
        //         if ($one['email'] == $_POST['email']) {
        //             $email_t = true;
        //         }
        //     }
        // }

        if ($email_t == true) {
            $this->error['m'] = 'Email is already taken,choose another';
        }

        if ($this->error['m'] != '') {
            $this->registerUser();
        } else {
            $_SESSION['userName'] = $_POST['fullname'];
            $DB = new database();
            if (isset($_POST['edit'])) {
                Picture_Save_File('user_pic', 'users_images/');
                $user_img = basename($_FILES['user_pic']['name']);
            } else {
                $user_img = 'user1.jpg';
            }
            $DB->query("insert into users(name,email,PW,user_img,Address1,phoneNo) 
            values('$name','$email','$password','$user_img','$address1','$phone')");
            header('Location: index.php?op=0');
        }
    }

    public function profile()
    {
        $page = new WebPage();
        $page->title = 'Login';
        $page->Content = <<<HTML
        <div>
        <div class="bgg"><img class="bgg" src="Diamond.jpg" alt="user"> 
        <div class="bg">
        <img class="bgimg" src="{$_SESSION['user_img']}" alt="{$_SESSION['userName']}"><br>
        <h3 class="bgimg">{$_SESSION['userName']} singh</h3>>
        </div><br><br><br><br><div class=><a href="index.php?op=53&&edit=1"><button type="file">Edit Profile</button></a></div><hr>
        </div> 
        </div>
        <div class="bg1">
        <div class="pro">
        <div class="cardout"><h3>Intro<h3><hr></div>
        <div class="cardin">
            <div class="field"> {$_SESSION['userName']}</div>
            <div class="field">{$_SESSION['userName']}</div>
            <div class="field">{$_SESSION['userName']}</div>
        </div> </div>
        <div class="pro">
        <div class="cardout"><h3>Travel History<h3><hr></div>
        <div class="cardin">
            <div class="field"> {$_SESSION['userName']}</div>
            <div class="field">{$_SESSION['userName']}</div>
            <div class="field">{$_SESSION['userName']}</div>
        </div></div> 
        </div>
        
        </div>
       HTML;
        $page->render();
    }

    public function logout()
    {
        $_SESSION['userName'] = '';
        header('Location: index.php?op=0');
    }
}
