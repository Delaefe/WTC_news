<div class='container-fluid'>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <?php if ($_SESSION['login_user'] == NULL && $_SESSION['login_user'] == "") { ?>
            <div class="login-buttons">


                <input type="button" id="user-login-btn" class="btn btn-primary" value="Log in"></input>
                <input type="button" id="user-register-btn" class="btn btn-primary" value="Register"></input>


            </div>

            <div class="login-box">

                <form class="login-box-form" action="<?php echo $role; ?>" method="POST">

                    <input type="text" size="15" required pattern="[a-zA-Z0-9]{4,20}$" name="username" placeholder="Username">
                    <input type="password" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="password" placeholder="Password">

                    <input type="hidden" name="action" value="login">
                    <input type="submit" value="Go" class="btn btn-primary ">

                </form>

            </div>

            <div class="register-box">

                <form class="register-box-form" action="<?php echo $role; ?>" method="POST">

                    <input id="username-input" type="text" required pattern="[a-zA-Z0-9]{4,20}$" name="username" placeholder="Username"><i id="checkuser" class=""></i> <br>	
                    <input class="password-input" id="password1" type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required  name="password" placeholder="Password" title="('Must contain uppercase,lowercase,special char and number. [Min. 8 characters]')">
                    <input class="password-input" id="password2" type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required name="password2" placeholder="Repeat Password"><span id="password-checker"></span>
                    <input type="text" required pattern="[a-zA-Z\s]{1,30}$" name="name" placeholder="Name">
                    <input type="text" required pattern="[a-zA-Z\s]{1,30}$" name="lastname" placeholder="Last Name">

                    <input type="hidden" name="action" value="register">
                    <input id="submit-register" type="submit" value="Go" class="btn btn-primary ">

                </form>
            <?php } else { ?>
                <div class="welcome">
                    <h4>Welcome <?php echo $_SESSION['login_user']; ?>!</h4>
                </div>
            <?php } ?>


        </div>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="../images/<?php echo $header; ?>" alt="">

                <div class="carousel-caption">

                    <h1 class="header" id="wtc-header"> <?php echo $topic_name; ?> </h1>


                </div>
            </div>

        </div>
    </div>

    <script>

        $(document).ready(function () {

            $("#user-login-btn").click(function (e) {
                e.preventDefault();

                $(".login-box input[type=text], input[type=password]").val("");
                $(".register-box-form").css("display", "none");
                $(".login-box-form").css("display", "block");




                if ($(".register-box").hasClass("toggled")) {
                    $(".register-box").toggleClass("toggled", 1000);
                }
                $(".login-box").toggleClass("toggled", 1000);


            });
            $("#user-register-btn").click(function (e) {

                e.preventDefault();
                $(".register-box-form").css("display", "block");
                $(".login-box-form").css("display", "none");




                $(".register-box input[type=text], input[type=password]").val("");


                if ($(".login-box").hasClass("toggled")) {
                    $(".login-box").toggleClass("toggled", 1000);
                }
                $(".register-box").toggleClass("toggled", 1000);


            });


            $("#username-input").keyup(function () {
                
                var user = $(this).val();

                $.ajax({
                    url: "<?php echo $role;?>?action=check_username",
                    type: "get",
                    data : {'username': user},
                    success: function(data){
                        document.getElementById("checkuser").className = data;
                        
                        if (data.length < 18){
                             $("#submit-register").addClass("disabled");
                        }
                        else{
                             $("#submit-register").removeClass("disabled");

                        }
                        
                    }
                });


            });
            
            $(".password-input").keyup(function () {
                
                var password1 = $('#password1').val();
                var password2 = $('#password2').val();
                
                if (password1 != password2){
                    $("#submit-register").addClass("disabled");
                    $("#password-checker").removeClass("fa fa-thumbs-up")

                    $("#password-checker").addClass("fa fa-thumbs-down")

                }
                else{
                    $("#submit-register").removeClass("disabled");
                    $("#password-checker").removeClass("fa fa-thumbs-down");

                    $("#password-checker").addClass("fa fa-thumbs-up");


                }


            });
        });



    </script>


</div>

