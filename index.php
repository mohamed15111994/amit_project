<?php include "include/header.inc"?>
<?php include "include/functions.inc"?>
<?php include "connect.php"?>
<!--overlay and header start-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $stmt = $con->prepare('INSERT INTO messages (name,subject,email,message,date)VALUES(?,?,?,?,now())');
    $stmt->execute(array($username, $subject, $email, $message));
    $count = $stmt->rowCount();
}
?>
<header class="in-top">
    <?php include "include/navbar.inc" ?>
    <div class="over-lay" id="about">
        <div class="slider text-center text-capitalize">
            <h1 class="underline-orange wow shake">Future Builders</h1>
            <p>Our site work as link between sellers and buyers of buildings and apartments, we also provide news about modern architecture </p>
            <input type="button" value="read more" class="read-more text-capitalize">
            <div class="about-info text-left">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="block-heading-two">
                                <h2><span>About Our Company</span></h2>
                            </div>
                            <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero.</p>
                            <br>
                            <p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div class="col-md-4">
                            <div class="block-heading-two">
                                <h3><span>Our Advantages</span></h3>
                            </div>
                            <div class="panel-group" id="accordion-alt3">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseOne-alt3"> <i class="fa fa-angle-right"></i> Quisque cursus metus vitae pharetra auctor</a> </h4>
                                    </div>
                                    <div id="collapseOne-alt3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseTwo-alt3"> <i class="fa fa-angle-right"></i> Duis autem vel eum iriure dolor in hendrerit</a> </h4>
                                    </div>
                                    <div id="collapseTwo-alt3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseThree-alt3"> <i class="fa fa-angle-right"></i> Quisque cursus metus vitae pharetra auctor </a> </h4>
                                    </div>
                                    <div id="collapseThree-alt3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseFour-alt3"> <i class="fa fa-angle-right"></i> Duis autem vel eum iriure dolor in hendrerit</a>  </h4>
                                    </div>
                                    <div id="collapseFour-alt3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--overlay end-->

<!--news section start-->
<div class="news text-center" id="news">
    <h1 class="underline-white">What Is New In Architecture World</h1>
    <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <?php
            $stmt=returnAll("news");
            $rows = $stmt->fetchAll();
            $count=$stmt->rowCount();
            $num=1;
            echo "<div id='slider' class='flexslider'>
                        <ul class='slides'>";
                            for ($i=$count-1;$i>=0;$i--){
                                            echo "<li>
                                                <div class='image-container'>
                                                      <img class='news-image' src='".$rows[$i]['image']."'>
                                                </div>
                                                      <div class='flex-caption'>
                                                           <h4><a href='#'>".$rows[$i]['title']."</a></h4>
                                                           <p>".$rows[$i]['body']."</p>          
                                                      </div>
                                            </li>";                  
                                if($num==15){
                                    break;
                                }
                                $num++;
                            }
                            echo "    </ul>
                </div>";
            echo "<div id='carousel' class='flexslider'>
                    <ul class='slides'>";
                        $num=1;
                        for ($i=$count-1;$i>=0;$i--){
                                echo "<li>
                                            <img class='news-image' src='".$rows[$i]['image']."'>
                                            <h4>".$rows[$i]['title']."</h4>
                                      </li>";
                            if($num==15){
                                break;
                            }
                            $num++;
                        }
            echo    "</ul> 
                  </div>";
            ?>
        </div><!-- End Carousel -->
        <button class="get-started">View Archive</button>
    </div>
</div>
<!--    news section end -->

<!--Our services Start-->
<div class="our-service" id="services">
    <div class="container">
        <h2 class="text-center text-capitalize heading underline-orange">At your service</h2>
        <div class="row">
            <div class="col-lg col-md-6 col-sm-12 element">
                <div class="article text-center">
                    <i class="fa fa-users fa-2x icon"></i>
                    <h4>Community</h4>
                    <p>Get advises from other users, share your knowledge </p>
                </div>
            </div>
            <div class="col-lg col-md-6 col-sm-12 element">
                <div class="article text-center">
                    <i class="fa fa-search fa-2x icon"></i>
                    <h4>Search</h4>
                    <p>User our advanced search, find what suites you best </p>
                </div>
            </div>
            <div class="col-lg col-md-6 col-sm-12 element">
                <div class="article text-center">
                    <i class="fa fa-building fa-2x icon"></i>
                    <h4>Locations</h4>
                    <p>Want to start project, find a good location here </p>
                </div>
            </div>
            <div class="col-lg col-md-6 col-sm-12 element">
                <div class="article text-center">
                    <i class="fas fa-bell fa-2x icon"></i>
                    <h4>Notifications</h4>
                    <p>Can't find what you want, leave description and we will inform you</p>
                </div>
            </div>
        </div>
        <div class="testimonial-solid">
            <h2 class="underline-orange">Client Testimonials</h2>
            <div class="flexslider">
                <ul class="slides">
                    <li class="item active">
                        <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                        <p><strong>- John Doe -</strong></p>
                    </li>
                    <li class="item">
                        <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                        <p><strong>- Jane Doe -</strong></p>
                    </li>
                    <li class="item">
                        <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                        <p><strong>- John Smith -</strong></p>
                    </li>
                    <li class="item">
                        <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                        <p><strong>- Linda Smith -</strong></p>
                    </li>
                </ul>
            </div>
            <h2 class="text-center text-capitalize heading underline-orange">You can trust us</h2>
            <div class="row text-center awards">
                <div class="col-sm-3 col-xs-6"> <i class="fas fa-smile fa-5x"></i>
                    <h4>120+ Happy Clients</h4>
                </div>
                <div class="col-sm-3 col-xs-6"> <i class="fas fa-check-square fa-5x" aria-hidden="true"></i>
                    <h4>600+ Projects Completed</h4>
                </div>
                <div class="col-sm-3 col-xs-6"> <i class="fa fa-trophy fa-5x"></i>
                    <h4>25 Awards Won</h4>
                </div>
                <div class="col-sm-3 col-xs-6"> <i class="fas fa-map-marker-alt fa-5x"></i>
                    <h4>3 Offices</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Our services end-->


<!--<div class="contact-us" id="contact">-->
<!--    <div class="container">-->
<!--        <div class="text-capitalize text-center section4">-->
<!--            <h2 class="text-center text-capitalize heading underline-alt">Let's Get In Touch</h2>-->
<!--            <p>You can contact us from information below or feel free to send us a message</p>-->
<!--            <div class="contact">-->
<!--                <div class="container">-->
<!--                    <div class="contact_bottom">-->
<!--                        <form method="post" action="--><?php //$_SERVER['PHP_SELF']?><!--">-->
<!--                            <div class="contact-to">-->
<!--                                <input type="text" class="text" placeholder="Name" name="username" required>-->
<!--                                <input type="text" class="text" placeholder="Subject" name="subject" style="margin-left: 10px" required>-->
<!--                                <input type="text" class="text" placeholder="Mail" name="email" style="margin-left: 10px" required>-->
<!--                            </div>-->
<!--                            <div class="text2">-->
<!--                                <textarea class="form-control" rows="5" id="comment" name="message" placeholder="Message" required></textarea>-->
<!--                            </div>-->
<!--                            <input type="submit" value="   Send   " class="send-message text-capitalize">-->
<!--                        </form>-->
<!--                    </div>-->
<!--                    <div class="row contact_top">-->
<!--                        <div class="col-md-4 contact_details">-->
<!--                            <h5><i class="fa fa-paper-plane fa-2x icon"></i>Mailing address:</h5>-->
<!--                            <div class="contact_address">321 Awesome Street, New York, NY 17022</div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4 contact_details">-->
<!--                            <h5><i class="fa fa-phone fa-2x icon"></i>Call us:</h5>-->
<!--                            <div class="contact_address"> +1 800 123 1234<br>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4 contact_details">-->
<!--                            <h5><i class="fa fa-mail-bulk fa-2x icon"></i>Email us:</h5>-->
<!--                            <div class="contact_mail"> info@companyname.com</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="footer">-->
<!--                <div class="footer_bottom">-->
<!--                    <div class="follow-us"> <a class="fab fa-facebook-f icon" href="#"><a class="fab fa-twitter icon" href="#"></a> <a class="fab fa-linkedin-in icon" href="#"></a> <a class="fab fa-google-plus-g icon" href="#"></a> </div>-->
<!--                    <div class="copy">-->
<!--                        <p>Copyright &copy; 2019 Company AMIT. Design by <a href="#" rel="nofollow">Mohamed Mostafa</a></p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<footer>
    <div class="footer-area contact-us" id="contact">
        <div class="container">
            <div class="our-aim text-center">
                <div class="single-footer-widget tp_widgets">
                    <h2 class="text-capitalize heading underline-alt">Let's Get In Touch</h2>
                    <p class="text-center">You can contact us from information below or feel free to send us a message 
                        <input type="button" value="show form" class="send-message text-capitalize" id="send-message"></p>
                </div>
            </div>
            <div class="row section_gap contact-form">
                <div class="col-sm-2">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title">Quick Links</h4>
                        <ul class="list">
                            <li><i class="fas fa-home"></i><a href="#"> Home</a></li>
                            <li><i class="far fa-question-circle"></i><a href="#"> About</a></li>
                            <li><i class="fas fa-directions"></i><a href="#"> Causes</a></li>
                            <li><i class="far fa-calendar-check"></i><a href="#"> Event</a></li>
                            <li><i class="far fa-newspaper"></i><a href="#"> News</a></li>
                        </ul>
                    </div>
                </div>
                <div class="container col-sm-10">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title large_title">Our Mission</h4>
                        <p>
                            So seed seed green that winged cattle in. Gathering thing made fly you're no
                            divided deep moved us lan Gathering thing us land years living.
                        </p>
                        <p>
                            So seed seed green that winged cattle in. Gathering thing made fly you're no divided deep moved
                        </p>
                    </div>
                    <div class="single-footer-widget instafeed" id="instafeed">
                        <h6 class="footer_title text-center">Send A Message</h6>
                        <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                            <div class="contact-to">
                                <input type="text" class="text" placeholder="Name" name="username" required>
                                <input type="text" class="text" placeholder="Subject" name="subject" style="margin-left: 10px" required>
                                <input type="text" class="text" placeholder="Mail" name="email" style="margin-left: 10px" required>
                            </div>
                            <div class="text2">
                                <textarea class="form-control" rows="5" id="comment" name="message" placeholder="Message" required></textarea>
                            </div>
                            <input type="submit" value="   Send   " class="send-message text-capitalize">
                        </form>
                    </div>
                </div>
                <div class="container">
                    <div class="row contact_top">
                        <div class="col-md-4 contact_details">
                            <h5><i class="fa fa-paper-plane fa-2x icon"></i>Mailing address:</h5>
                            <div class="contact_address">321 Awesome Street, New York, NY 17022</div>
                        </div>
                        <div class="col-md-4 contact_details">
                            <h5><i class="fa fa-phone fa-2x icon"></i>Call us:</h5>
                            <div class="contact_address"> +1 800 123 1234<br>
                            </div>
                        </div>
                        <div class="col-md-4 contact_details">
                            <h5><i class="fa fa-mail-bulk fa-2x icon"></i>Email us:</h5>
                            <div class="contact_mail"> info@companyname.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer text-center">
            <div class="footer_bottom">
                <div class="follow-us"> <a class="fab fa-facebook-f icon" href="#"><a class="fab fa-twitter icon" href="#"></a> <a class="fab fa-linkedin-in icon" href="#"></a> <a class="fab fa-google-plus-g icon" href="#"></a> </div>
                <div class="copy">
                    <p>Copyright &copy; 2019 Company AMIT. Design by <a href="#" rel="nofollow">Mohamed Mostafa</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php include "include/footer.inc"?>
