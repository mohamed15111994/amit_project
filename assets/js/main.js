$(document).ready(function(){
    var base64="";
    var image_format="";
    var number = 0;
    var id="";
    var images = new Array({"image1":{"data":[{"base64":"","format":""}]},
        "image2":{"data":[{"base64":"","format":""}]},
        "image3":{"data":[{"base64":"","format":""}]},
        "image4":{"data":[{"base64":"","format":""}]},
        "image5":{"data":[{"base64":"","format":""}]},
        "image6":{"data":[{"base64":"","format":""}]}});
    var url = window.location.href;//get url of current page

    //fex2slide plugin (news slider sync)
    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider'
    });

    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel"
    });

    //allow this functions im main page only
    if( (url == "http://localhost/amit_project/" )|| (url == "http://localhost/amit_project/#" )) {
        var distance = $('.in-top').offset().top;

        //news slider start
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 210,
            itemMargin: 5,
            asNavFor: '#slider'
        });

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
        $('.flexslider').flexslider({
            animation: "slide"
        });
        //news slider end

        //change navbar color from transparent to black
        $(window).scroll(function () {
            if ($(this).scrollTop() <= distance) {
                // console.log('is in top');
                $('.navbar').addClass('bg-transparent');
            } else {
                // console.log('is not in top');
                $('.navbar').removeClass('bg-transparent');
                $('.navbar').css({'background-color': 'black', 'opacity': '0.7'});
            }
        });
        //change navbar color end

        //Select to Element(on click)
        $('.nav-link').click(function () {
            if (($(this).attr('id') == "login-button") || ($(this).attr('id') == "user-options")) {
            } else {
                $(this).siblings().removeClass("active");
                $('html,body').animate({
                    scrollTop: $('#' + $(this).data('scroll')).offset().top
                }, 1000);
            }
        })
        //select to element end

        //navbar sync (set active to navbar element to currently scroll section in page )
        $(window).scroll(function () {
            if ($(this).scrollTop() <= distance) {
                $('.nav-link').removeClass('active');
            }
            else if (($(this).scrollTop() >= $('.underline-orange').offset().top) && ($(this).scrollTop() <= $('.news').offset().top)) {
                $('.nav-link').removeClass('active');
                $('.item-about').addClass('active');
            }
            else if (($(this).scrollTop() >= $('.news').offset().top) && ($(this).scrollTop() <= $('.our-service').offset().top)) {
                $('.nav-link').removeClass('active');
                $('.item-news').addClass('active');
            }
            else if (($(this).scrollTop() >= $('.our-service').offset().top) && ($(this).scrollTop() <= $('.contact-us').offset().top)) {
                $('.nav-link').removeClass('active');
                $('.item-services').addClass('active');
            }
            else if ($(this).scrollTop() >= $('.contact-us').offset().top) {
                $('.nav-link').removeClass('active');
                $('.item-contact').addClass('active');
            }
        });
        //navbar sync end

        //log in dialog start
        $('#login-button').click(function () {
            $("#login-form").dialog({
                maxWidth: 400,
                maxHeight: 400,
                width: 400,
                height: 400,
                modal: true,
                close: function (event, ui) {
                    $('.login').css("display", "block");
                    $('.register-data').css("display", "none");
                    $('.username-missing').css("display", "none");
                    $('.password-missing').css("display", "none");
                    $('.incorrect').css("display", "none");
                    clean_warning();

                    $('#login-username').val("");
                    $('#login-password').val("");

                    $('#create-username').val("");
                    $('#create-password').val("");
                    $('#create-fullname').val("");
                    $('#create-email').val("");
                }
            });
            $('.login-btn').click(function () {//log in using ajax
                var user = document.getElementById("login-username").value;
                var pass = document.getElementById("login-password").value;
                var data = $.param({user: user, pass: pass});
                console.log(user);
                console.log(pass);
                if (user == "") {
                    $('.username-missing').css("display", "block");
                }
                if (pass == "") {
                    $('.password-missing').css("display", "block");
                }
                if ((pass != "") && (user != "")) {//both password and user name fields not empty check if this user exist DB
                    $('.username-missing').css("display", "none");
                    $('.password-missing').css("display", "none");
                    $.ajax({
                        type: 'POST',
                        url: 'include/ajax_calls.php?do=login',
                        data: data,
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if (data.exist == true) {
                                $('.username-missing').css("display", "none");
                                $('.password-missing').css("display", "none");
                                $('.incorrect').css("display", "none");
                                $('.welcome').css("display", "block");
                                $('.welcome').html("Welcome " + data.username);
                                setTimeout(function () {
                                    window.location.href = ""; //will redirect to your blog page (like refresh)
                                }, 2000)
                            } else if (data.exist == false) {//user don't exist (wrong username or pass)
                                $('.incorrect').css("display", "block");
                            }
                        }, error: function (xml, error) {
                            console.log(error);
                        }
                    })
                }
            });

            //create account start
            $('.show-register').click(function () {
                $('.login').css("display", "none");
                $('.register-data').css("display", "block");
                $("#login-form").dialog({
                    maxWidth: 500,
                    maxHeight: 600,
                    width: 500,
                    height: 600,
                    close: function (event, ui) {//clear the custom dialog fields in close
                        $('.login').css("display", "block");
                        $('.register-data').css("display", "none");
                        $('.username-missing').css("display", "none");
                        $('.password-missing').css("display", "none");
                        $('.incorrect').css("display", "none");
                        clean_warning();

                        $('#login-username').val("");
                        $('#login-password').val("");

                        $('#create-username').val("");
                        $('#create-password').val("");
                        $('#create-fullname').val("");
                        $('#create-email').val("");
                    },
                    modal: true
                });
            })
            $('.create-account').click(function () {//create account custom dialog
                var create_user = document.getElementById("create-username").value;
                var create_email = document.getElementById("create-email").value;
                var create_password = document.getElementById("create-password").value;
                var create_fullname = document.getElementById("create-fullname").value;
                var create_data = $.param({//put data on array
                    user: create_user,
                    pass: create_password,
                    email: create_email,
                    fullname: create_fullname
                });
                console.log(create_data);

                if (create_user == "") {//check if any field is missing
                    $('.create-username-missing').css("display", "block");
                } else {
                    $('.create-username-missing').css("display", "none");
                }
                if (create_email == "") {
                    $('.create-email-missing').css("display", "block");
                } else {
                    $('.create-email-missing').css("display", "none");
                }
                if (create_password == "") {
                    $('.create-password-missing').css("display", "block");
                } else {
                    $('.create-password-missing').css("display", "none");
                }
                if (create_fullname == "") {
                    $('.create-fullname-missing').css("display", "block");
                } else {
                    $('.create-fullname-missing').css("display", "none");
                }
                if ((create_user != "") && (create_email != "") && (create_password != "") && (create_fullname != "")) {
                    $.ajax({//no fields is missing , start ajax
                        type: 'POST',
                        url: 'include/ajax_calls.php?do=register',
                        data: create_data,
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if ((data.username == false) && (data.mail == false)) {
                                clean_warning();

                                $('.create-welcome').css("display", "block");
                                $('.create-welcome').html("Welcome " + data.welcom_user);

                                setTimeout(function () {
                                    window.location.href = ""; //will redirect to your blog page (an ex: blog.html)
                                }, 2000)
                            } else if ((data.username == true) && (data.mail == true)) {
                                clean_warning();  //tell  if username or mail is already exist(php tell in the return data)
                                $('.create-email-exist').css("display", "block");
                                $('.create-username-exist').css("display", "block");
                            } else if ((data.username == false) && (data.mail == true)) {
                                clean_warning();
                                $('.create-email-exist').css("display", "block");
                            } else if ((data.username == true) && (data.mail == false)) {
                                clean_warning();
                                $('.create-username-exist').css("display", "block");
                            }
                        }, error: function (xml, error) {
                            console.log(error);
                        }
                    })
                }
            })
        });
        //log in dialog end


        //send message show form
        $('#send-message').click(function () {
            $("#instafeed").dialog({
                maxWidth: 900,
                maxHeight: 400,
                width: 900,
                height: 400,
                close: function (event, ui) {

                },
                modal: true
            });
        })

        //show more data in about section
        $('.read-more').click(function () {
            if ($('.read-more').attr("value") == "Less Info") {
                $(".about-info").hide(500);
                $('.read-more').attr("value", "Read More");
            } else {
                $(".about-info").show(500);
                $('.read-more').attr("value", "Less Info");
            }
        });
    }

    function clean_warning() {//function to clean login and create account fields (rather than retype the every time)
        $('.create-username-missing').css("display", "none");
        $('.create-email-missing').css("display", "none");
        $('.create-password-missing').css("display", "none");
        $('.create-fullname-missing').css("display", "none");
        $('.create-email-exist').css("display", "none");
        $('.create-username-exist').css("display", "none");
    }
    
    $('.sidebar-item').click(function () {//set sidebar to active in click
        $(this).addClass("active").siblings().removeClass("active")
    })

    $('.view-offers').click(function () {//ajax call to view all offers
        $.ajax({
            type:'POST',
            url:'http://localhost/amit_project/include/ajax_calls.php?do=view_offers',
            data:{number:6},
            success:function (data) {
                console.log(data);
                $('.user-space').html(data);
            },error: function(xml, error) {
                console.log(error);
            }
        })
    })
    $('.post-offer').click(function () {//load post offer form using ajax
        $.ajax({
            type:'POST',
            url:'http://localhost/amit_project/include/ajax_calls.php?do=post_offer_form',
            success:function (data) {
                $('.user-space').html(data);
            },error: function(xml, error) {
                console.log(error);
            }
        })
    });
    $('.show-sidebar').click(function () {//show and hide user sidebar
        if($(this).html()=="Show"){
            $('.profile-sidebar').show(500);
            $('.user-space').removeClass("col-md-12").addClass("col-md-9");
            $('.show-sidebar').html('Hide')
        }else{
            $('.profile-sidebar').hide(500);
            $('.user-space').removeClass("col-md-9").addClass("col-md-12");
            $('.show-sidebar').html('Show');
        }
    });

    $('.edit-information').click(function () {//load edit user information custom dialog
        $("#edit-profile").dialog({
            maxWidth: 500,
            maxHeight: 650,
            width: 500,
            height: 650,
            close: function (event, ui) {

            },
            modal: true
        });
    });

    $('.profile-userpic').click(function () {//load edit user picture custom dialog
        $('#edit-image').dialog({
            maxWidth: 500,
            maxHeight: 500,
            width: 500,
            height: 500,
            close: function (event, ui) {

            },
            modal: true
        });

        $('#image-file').change(function () {//get the format of chosen image(in edit user picture custom dialog)
            readFile(this,true);
            if(document.getElementById("image-file").value.indexOf(".jpg") != -1){
                image_format=".jpg";
            }else if(document.getElementById("image-file").value.indexOf(".jpeg") != -1){
                image_format=".jpeg";
            }else if(document.getElementById("image-file").value.indexOf(".png") != -1){
                image_format=".png";
            }
        })
    });

    $('#edit-image-form').on('submit',function (e) {
        if(base64==""){//no image base64 change (no image chosen)
            $('.edit-no-image').css("display", "block");
            e.preventDefault();
        }else {//edit user personal image using ajax
            $('.edit-no-image').css("display", "none");
            var user = $('.profile-usertitle-name').attr("id");
            user=user.replace('"',"");
            user=user.replace('"',"");
            var data = $.param({title: user, image: base64, format:image_format});
            // console.log(data);
            $.ajax({
                type:'POST',
                url:'http://localhost/amit_project/include/ajax_calls.php?do=edit_image',
                data:data,
                success:function (data) {
                    base64="";
                    image_format="";
                    window.location.href = "http://localhost/amit_project/home.php";
                },
                error:function (data) {
                    console.log(data);
                }
            });
        }
        e.preventDefault();
    });
    

    function readFile(input,profile) {//function to transform image to base64 string
        if (input.files && input.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                base64 = ""+e.target.result;
                base64=base64.replace('data:image/png;base64,','');
                base64=base64.replace('data:image/jpeg;base64,','');
                base64=base64.replace('data:image/jpg;base64,','');
                if(profile==true){//to change custom dialog image on change
                    $('#edit-chosen-image').attr('src', e.target.result);
                }else {
                    image_elements(id);
                }
            });
            FR.readAsDataURL( input.files[0] );
        }else {
            console.log("Something wrong");
        }
    }

    $('.new-offer-image').change(function () {
        id = $(this).attr("id");
        readFile(this,false);

    });


    function image_elements(id) {
        if(document.getElementById(id).value.indexOf(".jpg") != -1){
            image_format=".jpg";
        }else if(document.getElementById(id).value.indexOf(".jpeg") != -1){
            image_format=".jpeg";
        }else if(document.getElementById(id).value.indexOf(".png") != -1){
            image_format=".png";
        }

        if(id=="new-offer-image1"){
            images[0]={"image1":{"data":[{"base64":base64,"format":image_format}]}};
        }else if(id=="new-offer-image2"){
            images[1]={"image2":{"data":[{"base64":base64,"format":image_format}]}};
        }else if(id=="new-offer-image3"){
            images[2]={"image3":{"data":[{"base64":base64,"format":image_format}]}};
        }else if(id=="new-offer-image4"){
            images[3]={"image4":{"data":[{"base64":base64,"format":image_format}]}};
        }else if(id=="new-offer-image5"){
            images[4]={"image5":{"data":[{"base64":base64,"format":image_format}]}};
        }else if(id=="new-offer-image6"){
            images[5]={"image6":{"data":[{"base64":base64,"format":image_format}]}};
        }
        console.log(images);
    }

});
