<?php
include "functions.inc";
include "../connect.php";

if(!isset($_SESSION)) {
    session_start();
}
$do = '';
$do = $_GET['do'];
if ($do=="login") {//log in php handler
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $inPassword = sha1($pass); //inPassword -> this var to incyrpte password
        //check if user is exist
        $stmt = $con->prepare('SELECT * FROM `users` WHERE username=? AND password=? LIMIT 1');
        $stmt->execute(array($user, $inPassword));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {//keep user personal data is sessions to use it later
            $_SESSION['username'] = $user; // Register session name
            $_SESSION['userid'] = $row['id'];  // Register session ID
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['groupid'] = $row['groupid'];
            $_SESSION['email'] = $row['mail'];
            $_SESSION['image'] = $row['image'];
            echo json_encode(array("exist"=>true,"username"=>$user));
        } else {
            echo json_encode(array("exist"=>false));
        }
    }
}
if ($do=="register") {//register handler
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $inPassword = sha1($pass); //inPassword -> this var to incyrpte password
        //check if user is exist
        $check1 = checkItem('username', 'users', $user);//check if username exist
        $check2 = checkItem('mail', 'users', $email);//check if password exist

        if($check1==1 && $check2==1){//username and email exist
            echo json_encode(array("username"=>true,"mail"=>true));
        }elseif ($check1==0 && $check2==1){//username exist
            echo json_encode(array("username"=>false,"mail"=>true));
        }elseif ($check1==1 && $check2==0){//email exist
            echo json_encode(array("username"=>true,"mail"=>false));
        }else{//not exist create account
            $stmt = $con->prepare('INSERT INTO users (username,password,mail,fullname,groupid,date)VALUES(?,?,?,?,-1,now())');
            $stmt->execute(array($user, $inPassword, $email, $fullname));
            $_SESSION['username'] = $user; // Register ssesion name
            $_SESSION['fullname'] = $fullname;
            $_SESSION['groupid'] = 0;
            $_SESSION['email'] = $email;

            header('refresh:3;url=home.php');
            echo json_encode(array("username"=>false,"mail"=>false,"welcom_user"=>$user));
        }
    }
}
elseif ($do == 'view_offers'){//return offers form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $number=$_POST['number'];//number of offer rows per page (now static 6 only, can be dynamic
        // by adding this optional for user from html page and passing it to jq which pass to php)
        $stmt=returnAll("offers");
        $rows = $stmt->fetchAll();
        $count=$stmt->rowCount();
        $_SESSION['first_echo']="";//only one echo could be used in ajax call (write additional echos here and concatinate it in one final echo)
        $_SESSION['second_echo']="";
        $_SESSION['third_echo']="";
        $_SESSION['fourth_echo']="";
        $_SESSION['fifth_echo']="";
        $end=$count;
        $_SESSION['first_echo']="<div class='profile-content'>
                    <div class='container'>
                        <h1 class='text-center'><i class='far fa-building'></i> New offers</h1><br><br>
                        ";
        for ($i=$number;$i>=0;$i--){
            $_SESSION['fifth_echo']="<div class='row'>";
            for($j=4;$j>=1;$j--){//only 4 offers per row
                if($end>0){
                    $_SESSION['second_echo']=$_SESSION['second_echo']."<div class='col-md-3 col-sm-6'>
                                <div class='product-grid9'>
                                    <div class='product-image9'>
                                        <a href='#'>
                                            <img class='pic-1' src='".$rows[$end-1]['image']."'>
                                        </a>
                                        <a href='#' class='fa fa-search product-full-view'></a>
                                    </div>
                                    <div class='product-content'>
                                        <h3 class='title'><a href='#'></a>".$rows[$end-1]['title']."</h3>
                                        <div class='price'>Price : ".$rows[$end-1]['price']." $</div>
                                        <a class='add-to-cart' href=''>".$rows[$end-1]['country'].",".$rows[$end-1]['state']."</a>
                                    </div>
                                </div>
                            </div>";
                    $end--;
                }else{
                    break;
                }
            }
            $_SESSION['third_echo']="</div>";
            $_SESSION['fourth_echo']="</div>
                </div>";
            if($end==0){
                break;
            }
        }
        echo $_SESSION['first_echo'].$_SESSION['fifth_echo'].$_SESSION['second_echo'].$_SESSION['third_echo'].$_SESSION['fourth_echo'];
    }
}
elseif($do=="post_offer_form") {//return add offer form in echo
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo return_file_contains("./header.inc")."<br><br><br>
               <div class='container col-md-12'>
                    <h1 class='text-center'><i class='far fa-building fa-2x'></i> Post New Offer</h1><br><br>
                    <div class='row'>
                      <div class='col-md-5 new-main-image'>
                        <h3>Offer Main Image</h3>
                        <br>
                        <img src='../../images/main_image_placeholder.jpg' />
                        <br><br>
                        <input type='file' name='file' class='new-offer-image' id='new-offer-image1' accept='.jpg,.jpeg,.png'>
                      </div>
                      <div class='col-md-7 new-more-image'>
                        <h3><span>Add More Images</span></h3>
                        <br><br><br>
                        <div class='more-images' id='accordion-alt3'>
                          <div class='new-image-no2'>
                            <input type='file' name='file' class='new-offer-image' id='new-offer-image2' accept='.jpg,.jpeg,.png'>
                          </div>
                          <div class='new-image-no3'>
                            <input type='file' name='file' class='new-offer-image' id='new-offer-image3' accept='.jpg,.jpeg,.png'>
                          </div>
                          <div class='new-image-no4'>
                            <input type='file' name='file' class='new-offer-image' id='new-offer-image4' accept='.jpg,.jpeg,.png'>
                          </div>
                          <div class='new-image-no5'>
                            <input type='file' name='file' class='new-offer-image' id='new-offer-image6' accept='.jpg,.jpeg,.png'>
                          </div>
                          <div class='new-image-no6'>
                            <input type='file' name='file' class='new-offer-image' id='new-offer-image6' accept='.jpg,.jpeg,.png'>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br><br>
                    <div class='row'>
                        <form role='form' class='col-md-11 go-right' id='post-offer-form'>
                            <h2 class='text-center' >Offer description</h2>
                            <div class='form-group'>
                                <label for='title'>Offer Title</label>
                                <input name='title' type='text' class='form-control' required>
                            </div>
                            <div class='form-group'>
                                <label>Offer Country</label>
                                <select class='form-control'>
                                  <option value='usa'>USA</option>
                                  <option value='egypt'>Egypt</option>
                                  <option value='canada'>Canada</option>
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='price'>Offer City</label>
                                <input name='price' type='text' class='form-control' required>
                            </div>
                            <div class='form-group'>
                                <label for='price'>Offer Price</label>
                                <input name='price' type='number' class='form-control' required>
                            </div>
                            <div class='form-group'>
                                <label>Offer Description</label>
                                <textarea name='body' rows='10' class='form-control' required></textarea>
                            </div>
                            <div class='form-group'>
                                <button type='submit' class='btn btn-primary'>Post Offer</button>
                            </div>
                        </form>
	                </div>
               </div>
                ".return_file_contains("./footer.inc");
    }
}
elseif($do=="see_offer"){
//    <div class='container post-new-offer'>
//            <div class='container post-images'>
//                <div id='slider' class='flexslider main-slider'>
//                  <ul class='slides'>
//                    <li>
//                      <img src='../../images/main_image_placeholder.jpg' />
//                    </li>
//                    <li>
//                      <img src='../../images/add_image.jpg' />
//                    </li>
//                  </ul>
//                </div>
//                <div id='carousel' class='flexslider secondary-slider'>
//                  <ul class='slides'>
//                    <li>
//                      <img src='../../images/main_image_placeholder.jpg' />
//                    </li>
//                    <li>
//                      <img src='../../images/add_image.jpg' />
//                    </li>
//                  </ul>
//                </div>
//            </div>
//        </div>
}
elseif($do=="edit_image"){//decode base64 string into image,rename it and save it in images folder
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $image_format = $_POST['format'];

    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/images/'.$title.$image_format, base64_decode($image));

    $stmt = $con->prepare('UPDATE users SET image=? WHERE username=?');
    $stmt->execute(array('../images/'.$title.$image_format,$title));
    $count = $stmt->rowCount();

    echo '../images/'.$title.$image_format;

}

}
?>

