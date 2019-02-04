<?php
if(!isset($_SESSION))
{
    session_start();
}
include "include/header.inc";
include "connect.php";
include "include/functions.inc";

?>
<div class="user-container">
    <nav class="navbar navbar-expand-lg navbar-dark user-nav">
        <a class="navbar-brand" href="http://localhost/amit_project">AMIT</a>
        <button type="button" class="btn btn-secondary show-sidebar">Hide</button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link item-about" href="http://localhost/amit_project/" data-scroll="about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link item-news" href="http://localhost/amit_project/" data-scroll="news">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link item-services" href="http://localhost/amit_project/" data-scroll="services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link item-contact" href="http://localhost/amit_project/" data-scroll="contact">Contact</a>
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
    </nav>

    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic text-center" id="profile-userpic">
                        <img src='<?php if($_SESSION['image']=="none"){
                            echo "../images/user.png";
                        }else{
                            echo "../images/".$_SESSION['image'];
                        } ?>' class="img-responsive user-picture" alt="" id="user-picture">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name" id='"<?php echo $_SESSION['username'];?>"'>
                            <?php echo $_SESSION['username'];?>
                        </div>
                        <div class="profile-usertitle-job">
                            <?php echo $_SESSION['email'];?>
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm edit-sitting">Edit information <i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm edit-information">User sitting <i class="fas fa-cog"></i></button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <span class="input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    <div class="profile-usermenu">
                        <ul class="list">
                            <li class="active view-offers sidebar-item">
                                <a href="#">New offers
                                    <i class="fas fa-newspaper"></i>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" >Advanced search
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </li>
                            <li class="sidebar-item post-offer">
                                <a href="#" >New offer
                                    <i class="far fa-plus-square"></i>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#">New alerts
                                    <i class="far fa-bell"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9 user-space">
<!--                <div class="profile-content">-->
<!--                    <div class="container">-->
<!--                        <h1 class="text-center"> <i class="far fa-building"></i> New offers</h1><br><br>-->
<!--                        <div class="row">-->
<!--                        --><?php
//                        $stmt=returnAll("offers");
//                        $rows = $stmt->fetchAll();
//                        $count=$stmt->rowCount();
//                        $num=1;
//                        for ($i=$count-1;$i>=0;$i--){
//                        ?>
<!--                            <div class="col-md-3 col-sm-6">-->
<!--                                <div class="product-grid9">-->
<!--                                    <div class="product-image9">-->
<!--                                        <a href="#">-->
<!--                                            <img class="pic-1" src="--><?php //echo $rows[$i]['image'];?><!--">-->
<!--                                        </a>-->
<!--                                        <a href="#" class="fa fa-search product-full-view"></a>-->
<!--                                    </div>-->
<!--                                    <div class="product-content">-->
<!--                                        <h3 class="title"><a href="#">--><?php //echo $rows[$i]['title'];?><!--</a></h3>-->
<!--                                        <div class="price">Price : --><?php //echo $rows[$i]['price'];?><!-- $</div>-->
<!--                                        <a class="add-to-cart" href="">VIEW PRODUCTS</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        --><?php
//                        }
//                        ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
    </div>
    <div class="container edit-profile" id="edit-profile">
        <h1 class="text-center"><i class="fa fa-user">Edit Information</i></h1>
        <form method="post" id="edit-form">
            <div class="form-group">
                <div class="form-group">
                    <div class='wow shake alert alert-success edit-welcome' style="display: none;"></div>
                </div>

                <label for="exampleInputEmail1">username</label>
                <input type="text" class="form-control" id="edit-username"
                       aria-describedby="emailHelp" placeholder="Username" name="username"  value="<?php echo $_SESSION['username'] ?>" required>
            </div>
            <div class="form-group">
                <div class='wow shake alert alert-danger edit-username-missing' style="display: none;">Username field is empty</div>
            </div>
            <div class="form-group">
                <div class='wow shake alert alert-danger edit-username-exist' style="display: none;">This username already exist</div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="edit-email"
                       aria-describedby="emailHelp" placeholder="Email" name="email" value="<?php echo $_SESSION['email'] ?>" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.
                </small>
            </div>
            <div class="form-group">
                <div class='wow shake alert alert-danger edit-email-missing' style="display: none;">Email field is empty</div>
            </div>
            <div class="form-group">
                <div class='wow shake alert alert-danger edit-email-exist' style="display: none;">This mail already exist</div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" id="edit-password"
                       aria-describedby="emailHelp" placeholder="Password" name="password"  required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Old password</label>
                <input type="password" class="form-control" id="confirm-password"
                       placeholder="Enter old password to apply changes" name="password"  required>
            </div>
            <div class="form-group">
                <div class='wow shake alert alert-danger edit-password-missing' style="display: none;">Password field is empty</div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Fullname</label>
                <input type="text" class="form-control" id="edit-fullname"
                       aria-describedby="emailHelp" placeholder="Fullname" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" required>
            </div>
            <div class="form-group">
                <div class='wow shake alert alert-danger edit-fullname-missing' style="display: none;">FullName field is empty</div>
            </div>
            <button type="button" class="btn btn-primary edit-account">Edit Information</button>
        </form>
    </div>
    <div class="edit-image" id="edit-image">
        <h1 class="text-center"><i class="fa fa-user"> Change Image</i></h1>
        <form method="post" id="edit-image-form" action="" class="text-center">
                <div class="form-group">
                    <div class='wow shake alert alert-danger edit-no-image' style="display: none;">No Image Selected</div>
                </div>
                <div class="form-group">
                    <img src='<?php if($_SESSION['image']=="none"){
                        echo "../images/user.png";
                    }else{
                        echo "../images/".$_SESSION['image'];
                    } ?>' class="img-responsive" alt="" id="edit-chosen-image">
                </div>
                <div class="form-group">
                    <input type="file" name="file" class="choose-image" id="image-file" accept=".jpg,.jpeg,.png">
                    <small id="emailHelp" class="form-text text-muted">Allowed type jpg,jpeg,png</small>
                    <small id="into-base64" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
        </form>
    </div>
</div>
<?php
include "include/footer.inc";
?>