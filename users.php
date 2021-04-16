<?php

require_once 'WebPage.php';
require_once 'database.php';
require_once 'Tool.php';

class users
{
    private $error = ['m' => ''];
    private $flag = 0;

    public function displayLoginPage()
    {
        $page = new WebPage();
        $page->title = 'Login';
        $page->Content = <<<HTML
        <section class="signup">
            <div class="container" style="width:660px">
                <div class="signup-content">
                    <form action='index.php?op=52' method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Login here</h2>
                        <div style='color:red;'><p>{$this->error['m']}</p></div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>                       
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign In"/>
                        </div>
                    </form>
                    <a href='index.php?op=56'><div>Forget Password?</div></a>
                    <p class="loginhere">
                        Don't have account yet? <a href="index.php?op=53" class="loginhere-link">Sign Up here!</a>
                    </p>
                </div>
            </div>
        </section>
         <!-- JS -->
        <script src="js/vendor/jquery.min.js"></script>
         <script src="js/main_copy.js"></script>

        HTML;
        $page->render();
    }

    public function verifyLogin()
    {
        $Email = '';
        $password = '';
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $Email = $_POST['email'];
            $password = $_POST['password'];
        }
        $url = 'localhost:4000/user/';
        $method = 'login';
        $queryString = http_build_query([
    'email' => $Email,
    'password' => $password,
  ]);

        $this->login($url, $method, $queryString);
    }

    private function login($url, $method, $queryString)
    {
        $user_found = false;
        $api = new Tool();
        // var_dump($queryString);
        // exit;
        $Users = $api->AccessAPI($url, $method, $queryString);
        if ($Users['message'] === 'success') {
            $user_found = true;
            $_SESSION['user_connected'] = true;
            $_SESSION['User_email'] = $Users['user']['email'];
            $_SESSION['User_Id'] = $Users['user']['_id'];
            $_SESSION['userName'] = $Users['user']['firstName'].' '.$Users['user']['lastName'];
            $user_found = true;
        }
        $_SESSION['userName'] = 'Harpreet';

        if (!$user_found) {
            $this->error['m'] = 'Invalid Creadentials';
            $this->displayLoginPage();
        } else {
            header('Location: index.php?op=0');
        }
    }

    public function registerUser()
    {
        $page = new WebPage();
        $page->title = 'SignUp';
        $page->Content = <<<HTML
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container" style="width:660px">
                <div class="signup-content">
                    <form action='index.php?op=54' method="POST" id="signup-form" class="signup-form">
                    <h2 class="form-title">Create account</h2>
                    <div ><p style='color:red'>{$this->error['m']}</p></div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="firstName" id="name" placeholder="FirstName" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="lastName" id="lastName" placeholder="LastName" required/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="Rpassword" id="Rpassword" placeholder="Repeat your password" required/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div></form>
                    <p class="loginhere">
                        Have already an account ? <a href="index.php?op=51" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    HTML;
        $page->render();
    }

    public function verifyRegisterUser()
    {
        $email_t = false;
        $register = new Tool();
        if (!isset($_GET['state'])) {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $Email = $_POST['email'];
                $password = $_POST['password'];
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
            }
        }
        $url = 'localhost:4000/user/';
        $method = 'signup';
        $queryString = http_build_query([
    'email' => $Email,
    'password' => $password,
    'firstName' => $firstName,
    'lastName' => $lastName,
  ]);

        if (strlen($_POST['password']) != 8) {
            $this->error['m'] = 'Password must be 8 character<br>';
        }
        if ($_POST['password'] !== $_POST['Rpassword']) {
            $this->error['m'] = 'Both Passwords are not identicals<br>';
        }
        if (strlen($_POST['firstName']) < 4) {
            $this->error['m'] = 'Name is not acceptable<br>';
        }
        if ($this->error['m'] != '') {
            $this->registerUser();
        } else {
            $message = $register->AccessAPI($url, $method, $queryString);
            if ($message['message'] === 'success') {
                $_SESSION['userName'] = $firstName.$lastName;
                $queryStringL = http_build_query([
                    'email' => $Email,
                    'password' => $password,
                  ]);
                $this->login($url, $method, $queryStringL);
                header('Location: index.php?op=0');
            } elseif ($message['message'] === 'User Already Exists') {
                $this->error['m'] = 'Email is already taken,choose another';
                $this->registerUser();
            }
        }
    }

    public function profile()
    {
        $page = new WebPage();
        $page->title = 'Profile';
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

    public function ForgetPassword()
    {
        $page = new WebPage();
        $page->title = 'Forget Password';
        $page->Content = <<<HTML
        <div class="container" style="width:660px">
           <div class="signup-content">
                <form action='index.php?op=57' method="POST" id="signup-form" class="signup-form">
                     <h2 class="form-title">Find Your Account</h2>
                         <div ><p style='color:red'>{$this->error['m']}</p></div>
                        <div class="form-group">
                               <input type="text" class="form-input" name="email" id="name" placeholder="Enter Email" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Search"/>
                        </div>
                    <a href='index.php?op=51'><div>Return To Login</div></a>
                </form>
                </div>
            </div> 
        </div>      
        HTML;
        $page->render();
    }

    public function VerifyForgetPassword()
    {
        $page = new WebPage();
        $page->title = 'Forget Password';
        $Email = $_POST['email'];
        $api = new Tool();
        if (isset($_POST['email'])) {
            $Email = $_POST['email'];
        }
        $url = 'localhost:4000/user/';
        $method = 'searchUser';
        $queryString = http_build_query([
    'email' => $Email,
  ]);
        $Users = $api->AccessAPI($url, $method, $queryString);
        if ($Users['message'] === 'UserExist') {
            $page->Content = <<<HTML
        <div class="container" style="width:660px">
           <div class="signup-content">
                <form action='index.php?op=58' method="POST" id="signup-form" class="signup-form">
                     <h2 class="form-title">Create New Password</h2>
                         <div ><p style='color:red'>{$this->error['m']}</p></div>
                         <div class="form-group">
                               <input type="hidden" class="form-input" name="email" id="name" placeholder="Enter email"  value={$Email}  required/>
                        </div>
                        <div class="form-group">
                               <input type="password" class="form-input" name="password" id="name" placeholder="Enter New Password" required/>
                        </div>
                        <div class="form-group">
                               <input type="password" class="form-input" name="Rpassword" id="name" placeholder="Repeat Your Password" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Submit"/>
                        </div>
                </form>
                </div>
            </div> 
        </div>      
        HTML;
        } else {
            $this->error['m'] = 'Invalid Email!Enter Correct Email';
            $this->ForgetPassword();
        }
        $page->render();
    }

    public function updatePass()
    {
        $email = '';
        $password = '';
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        $api = new Tool();
        $url = 'localhost:4000/user/';
        $method = 'update';
        $queryString = http_build_query([
    'email' => $email,
    'password' => $password,
  ]);
        $Users = $api->AccessAPI($url, $method, $queryString);
        // var_dump($Users);
        // exit;
        if ($Users['message'] === 'UserUpdate') {
            $urlL = 'localhost:4000/user/';
            $methodL = 'login';
            $queryStringL = http_build_query([
    'email' => $email,
    'password' => $password, ]);
            $this->login($urlL, $methodL, $queryStringL);
        }
    }

    public function logout()
    {
        $_SESSION['userName'] = '';
        header('Location: index.php?op=0');
    }
}
