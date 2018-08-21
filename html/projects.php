<html>
    <head>
        <title>Projects</title>
        <link rel="stylesheet" type="text/css" href="../Stylesheets/style_projects.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    </head>
    <body>
        <div class="background" id="background-projects"></div>
        <div class="background" id="background-cv"></div>
        <div class="background" id="background-profile"></div>
        <!--This is the header of the page.-->
        <div class="header">
            <button id="projects-button">Projects</button>
            <button id="cv-button">CV</button>
            <button id="profile-button" class="most-right">About me</button>
        </div>
        <!-- Content page, here we will have "projects", "cv" and "about me". These will be wrapped in different <div> tags so that we can fade them in and out. -->

        <div class="content" id="projects">
            <div class="projects">
                <div class="grid-container">
                <!--This is the menu of the page.-->
                <div class="menu">
                    <h6>Projects</h6>
                    <?php
                        include 'database/connection.php';
                        $username = $_GET['username'];
                        $query_post = "SELECT postID, title, description, image FROM Post WHERE username = '".$username."';";
                        $result1 = $conn -> query($query_post);

                        while($row = $result1 -> fetch_assoc()){
                            ?>
                                <a href="#<?php echo $row['postID']; ?>">
                                    <?php
                                        echo $row['title'];
                                    ?>
                                </a>
                            <?php
                        }
                    ?>
                </div>
                <!--This is the main window of content on the page.-->
                <div class="main" >
                    <?php
                        $result2 = $conn -> query($query_post);

                        while($row = $result2 -> fetch_assoc()){
                            ?>
                                <div id="<?php echo $row['postID']?>" class="project-grid">
                                    <div class="image" style="background: url('<?php echo $row['image']?>'); width:100%; height:100%; background-size: cover;">
                                    </div>
                                    <div class="description">
                                        <h1><?php echo $row['title']?></h1>
                                        <?php echo $row['description']?>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>
                </div>
            </div>
        </div>
        <div class="content" id="cv">
            <div class="cv-grid">
                <div class="work-experience">
                    <?php
                        #fill with content from database.
                        $query_cv = "SELECT content FROM CV WHERE username = '".$username."';";
                        $result_cv = $conn -> query($query_cv);
                        #return the title and the content (description of the post).
                        #echo $query;
                        while($row = $result_cv -> fetch_assoc()){
                            echo $row['content'];
                        }
                    ?>
                    <!--<h5>EDUCATION</h5>
                    <h6>Aug 2012 - June 2014</h6>
                    <p>Gymnasium; Nature Science, Kristofferskolan</p>
                    <h6>Aug 2016 - </h6>
                    <p>University: Civilengineer in Computersience, Royal Insitute of Technology (KTH)</p>
                    <h5>WORK EXPERIENCE</h5>
                    <h6>Summers 2007 - 2009</h6>
                    <p>Mälarö Golfclub: Driving Range worker</p>
                    <h6>Summer 2010</h6>
                    <p>Ekerö county: Designed and constructed a concrete road blocker with the shape of and color of an apple. This work was supervised by Peter Ekroth.</p>
                    <h6>Dec 2014 - July 2015</h6>
                    <p>Calliptus: Supermarket product promoter</p>
                    <h6>Feb 2014 - Aug 2015</h6>
                    <p>Ekgården Retirement Home: Care assistant to the elderly</p>
                    <h6>Feb 2016 - Oct 2016</h6>
                    <p>Ångbåten Preschool: Preschool assistant teacher</p>
                    <h6>May 2015 - </h6>
                    <p>Best boyfriend ever. Very good recommendations. Learned to do nice dances. </p> -->
                </div>
            </div>
        </div>
        <div class="content" id="profile">
            <div class="profile-grid">
                <div class="long-description">
                    <h6>About me</h6>
                    <p>My name is Adam Torkkeli-Johansson and I am currently a student at the royal technical institution (KTH) in Stockholm, Sweden. I am studying to become a civilengineer specilizing in Computer Science, hence I do a lot of coding. My passion for computers has been with me for a long time, ever since i got my first computer in the early 2000s (back when the monitors where super thick). Before I started attending the university I did not have any prior experience in coding, all I knew was that I was interested in computers. From knowing litteraly nothing about coding or writing software to now, two years at university later, I have made a lot of progress and have experience in many different programming languages such as Java, Go, C#, Prolog, SQL, XML and more. I find that learning and understanding these languages is much easier when I apply them to my own projects, and that is where this webpage comes in. Aswell as it is a project to help me learn how to wirte code in html, css, php and javascript, it is also designed to be my own personal portfolio where future employers can come to check out some of my previous work and projects... that was the initial though at least. Its now been about two months since I started woring on this website and a lot of things has happened, such as:
                    * The UI for the admin page and visitor page is really comming togethor.
                    * The communication with the database is now writte and organized into different files.
                    * Styling for the entire project is evolving with css transitions and animations. 
                    This project is and has been really fun to work on and I hope to get this website of the ground before next term of University starts! :) We will see about that last part... but I am really enjoying working on this!</p>
                </div>
                <div class="short-description">
                    <h6>Likes</h6>
                    <p>Motocross, The Battlefield Franchise, How I Met Your Mother, Working Out, Programming</p>
                    <h6>Dislikes</h6>
                    <p>That feeling when you think you´ve forgotten something</p>
                </div>
                <div class="profile-pic" style="background: url('../src/images/profile_pic.jpg'); width:100%; height:100%; background-size: cover;">
                </div>
            </div>
        </div>

        <!--This is the footer of the page.-->
        <!--
        <div class="footer">
            <p>Carl Adam Torkkeli-Johansson<br><br>
                Copyright adamskicool corp.<br><br>
                Mobile: +46 76 064 94 29<br><br>
                Email: adamtorkkeli@gmail.com</p>
        </div>
        -->
        
        <!-- HERE ARE THE SCRIPTS!!!  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- Smooth slide-->
        <script>
            /*
            $(function() {
              $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                  var target = $(this.hash);
                  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                  if (target.length) {
                    $('html,body').animate({
                      scrollTop: target.offset().top
                    }, 1000);
                    return false;
                  }
                }
              });
            });
            */
            
            /*
            will fade in the content of b1
            */
            function fadeInFadeOut(b1) {
                //background opacities.
                var background_projects = document.getElementById("background-projects");
                var background_cv = document.getElementById("background-cv");
                var background_profile = document.getElementById("background-profile");
                
                
                var b1_content = document.getElementById(b1);
                var projects = document.getElementById("projects");
                var profile = document.getElementById("profile");
                var cv = document.getElementById("cv");
                b1_content.style.display = "block";
                if(b1 === "cv") {
                    projects.style.display = "none"; 
                    profile.style.display = "none";
                    background_projects.style.opacity = "0";
                    background_cv.style.opacity = "0.8";
                    background_profile.style.opacity = "0";
                }
                if(b1 === "projects") {
                    cv.style.display = "none"; 
                    profile.style.display = "none";
                    background_projects.style.opacity = "0.8";
                    background_cv.style.opacity = "0";
                    background_profile.style.opacity = "0";
                }
                if(b1 === "profile") {
                    projects.style.display = "none"; 
                    cv.style.display = "none";
                    background_projects.style.opacity = "0";
                    background_cv.style.opacity = "0";
                    background_profile.style.opacity = "0.8";
                }
            }
            
            /*
            document.getElementById("cv-button").onclick = function() {
                fadeInFadeOut("cv");
            }
            document.getElementById("projects-button").onclick = function() {
                fadeInFadeOut("projects");
            }
            document.getElementById("profile-button").onclick = function() {
                fadeInFadeOut("profile");
            }
            */
            
            
            $( "#projects-button" ).click(function() {
                $( "#projects" ).toggle("slide", { direction: "left" }, 300);
                $( "#cv" ).toggle("slide",  { direction: "right" }, 300);
            });
            $( "#cv-button" ).click(function() {
                
            });
        </script>
    </body>
</html>