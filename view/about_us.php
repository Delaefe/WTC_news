<?php
include '../view/navbar.php';
?>

<main>
    
    <script>
        
        $(document).ready(function(){
            
            $("img").show(500).fadeIn(500);
            
        });
    
    </script>

    <div class="container">
        <div class="row-fluid">
            <div class="span12 admin-header">
                <h1>ABOUT US </h1>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12 about_us" >
                <span class="about_us-image"><img src="../images/logo.png"></span>
                <h2>What is WTC News?</h2>
                <h4>WTC News is a website where you can find many kind of news. <br>
                    We have space for General, Economy, Science & Technology, Culture and Sports! <br><br>
                    In our website, the contents are made by our users, so every registered user is free to send his/her articles. Besides that, 
                    they can rate other articles using the 'like' button. <br> 
                    This allows the users to sort the articles by most popular or most viewed. <br><br>

                    Also, we provide to our users the opportunity to express their opinion by commenting in every article. But be careful! Because
                    other users can vote your comment, and our adminds are watching you...
                </h4>

                <hr>

                <h2>Who made it?</h2>
                <div style="height: 400px;">
                    <span class="about_us-avatar">

                        <img src="../images/aboutus.JPG" alt="photo" >

                    </span>
                    <h3>Dimas de la Fuente</h3>
                    <h4 id="about_us-bio">I am an Erasmus student who comes from the University of Extremadura, Spain. I have been studying since September in the 
                        Dundalk Institute of Technology (Ireland). <br>
                        I'm 21 years old and this is my third year of my Computer Engineering degree, which I will finish next year when I come back to my home
                        university. <br><br>

                        I've made this website for the 'Web Programming' module as a final project, and it has been made using HTML, 
                        CSS, PHP, JavaScript, jQuery and some AJAX.<br>
                        I have acquired this knowledge during the course, alongside the Meteor Programming marathon in the University of Lens (France), and my own
                        research.
                        <br><br>

                        You can find me on: <br>
                        <div id="social" style="display: inline-block">
                            <a href="https://www.facebook.com/dimas.delafuente"><span class="fa fa-facebook"></span></a>
                            <a  href="https://twitter.com/DDelaefe"><span class="fa fa-twitter"></span></a>
                            <a  href="https://instagram.com/dimasdimenosdialgo"><span class="fa fa-instagram"></span></a>
                            <a  href="#"><span class="fa fa-envelope"></span></a>
                        </div>
                    </h4>
                </div>
            </div>
        </div>
    </div>

</main>

<?php
include '../view/footer.php';
?>