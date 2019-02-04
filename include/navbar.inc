<?php if(!isset($_SESSION))
{
    session_start();
};?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-transparent my-nav">
    <a class="navbar-brand" href="http://localhost/amit_project">AMIT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link item-about" href="#" data-scroll="about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link item-news" href="#" data-scroll="news">News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link item-services" href="#" data-scroll="services">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link item-contact" href="#" data-scroll="contact">Contact</a>
            </li>
            <?php
            if(empty($_SESSION['fullname'])) {
                echo "<li class='nav-item'>
                            <a class='nav-link ' href='#' id='login-button'>Login</a>
                      </li>";
            }else{
                echo "<li class='nav-item dropdown show' id='user-options'>
                            <a class='nav-link dropdown-toggle' href='#' ole='button' id='user-options' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            ".$_SESSION['fullname']."</a>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
                if ($_SESSION['groupid']==1){
                    echo "<a class='dropdown-item' href='admin/index.php'>Dashboard</a>";
                }
                echo "<a class='dropdown-item' href='home.php'>Your Board</a>
                      <a class='dropdown-item' href='logout.php'>logout</a>
                       </div>
                     </li>";
            }
            ?>
        </ul>
    </div>
    <div class="login-dialog">
        <div class="login-form" id="login-form">
            <div class="container login">
                <form method="post"">
                    <div class="form-group">
                        <div class='wow shake alert alert-danger incorrect' style="display: none;">Username or password is not correct</div>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-success welcome' style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" id="login-username" aria-describedby="emailHelp" name="user" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-danger username-missing' style="display: none;">Username field is empty</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="login-password" name="pass" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-danger password-missing' style="display: none;">Password field is empty</div>
                    </div>
                    <button type="button" class="btn btn-primary login-btn">Login</button>
                    <a href="#" class="show-register">Don't have account ? Register here</a>
                </form>
            </div>
            <div class="container register-data">
                <h1 class="text-center"><i class="fa fa-user">Create Account</i></h1>
                <form method="post" id="register-form">
                    <div class="form-group">

                        <div class="form-group">
                            <div class='wow shake alert alert-success create-welcome' style="display: none;"></div>
                        </div>

                        <label for="exampleInputEmail1">username</label>
                        <input type="text" class="form-control" id="create-username"
                               aria-describedby="emailHelp" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-danger create-username-missing' style="display: none;">Username field is empty</div>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-danger create-username-exist' style="display: none;">This username already exist</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="create-email"
                               aria-describedby="emailHelp" placeholder="Email" name="email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-danger create-email-missing' style="display: none;">Email field is empty</div>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-danger create-email-exist' style="display: none;">This mail already exist</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" id="create-password"
                               aria-describedby="emailHelp" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-danger create-password-missing' style="display: none;">Password field is empty</div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fullname</label>
                        <input type="text" class="form-control" id="create-fullname"
                               aria-describedby="emailHelp" placeholder="Fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <div class='wow shake alert alert-danger create-fullname-missing' style="display: none;">FullName field is empty</div>
                    </div>
                    <button type="button" class="btn btn-primary create-account">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</nav>
<!--End navbar-->