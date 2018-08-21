<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Projects</title>
        <link rel="stylesheet" type="text/css" href="../Stylesheets/style_edit_projects.css">
        <script src="../CKEditor4/ckeditor/ckeditor.js"></script>
    </head>
    <body id="body">
        <!--This is the header of the page.-->
        <div class="header">
            <a href="projects.php?username=<?php echo $_POST['username']; ?>">View Projects</a>
            <a class="most-right" href="www.google.se">Settings</a>
        </div>
        <div class="content" id="content">
            <div class="project-grid">
                <!--This is the menu of the page.-->
                <div class="menu">
                    <h6>Filter projects</h6>
                    <input id="filter_text" type="text" placeholder="Type 'Stranger Things'"><br>
                    <select>
                    <option value="title">title</option>
                    <option value="content">content</option>
                    </select>
                </div>
                <!--This is the main window of content on the page.-->
                <div class="edit-options">
                    <input id="check-all" type="checkbox">
                    <input id="new-post" type="button">
                    <input id="delete" type="button">
                    <input id="refresh-post" type="button">
                </div>
                <div class="edit-cv">
                    <h6>Edit Resumé</h6>
                    <div id="resume-icon"></div>
                    <input type="button" value="Edit CV" id="edit-cv-button"/>
                    
                </div>
                <div class="edit-profile">
                    <h6>Edit Profile</h6>
                    <div id="profile-icon"></div>
                    <input type="button" value="Edit profile"/>
                </div>
                <div id="main" class="main">
                </div>
            </div>
        </div>
        <div id="overlay-fade">
            <div id="overlay">
                <div class="new-post-grid">
                    <input class="exit-new-post" id="exit-new-post" type="submit" value="Exit">
                    <input class="title-new-post" type="text" id="title-new-post">
                    <div class="content-new-post">
                        <textarea id="new-post-editor">
                        </textarea>
                    </div>
                    <div class="images-new-post">
                        <h6>Insert images:</h6>
                        <input type="file" name="files[]" multiple="false">
                    </div>
                    <input class="upload-new-post" id="upload-new-post" type="submit" value="Upload">
                </div>
            </div>
        </div>
        <div id="overlay-fade-edit">
            <div id="overlay-edit">
                <div class="edit-post-grid">
                    <input class="exit-edit-post" id="exit-edit-post" type="submit" value="Exit">
                    <input class="title-edit-post" type="text" id="title-edit-post">
                    <div class="content-edit-post">
                        <textarea id="edit-post-editor">
                        </textarea>
                    </div>
                    <input class="upload-edit-post" id="upload-new-changes" type="submit" value="Upload changes">
                </div>
            </div>
        </div>
        <div id="overlay-fade-cv">
            <div id="overlay-cv">
                <div class="edit-cv-grid">
                    <input class="exit-edit-cv" id="exit-edit-cv" type="submit" value="">
                    <div class="content-edit-cv">
                        <textarea id="cv-editor">
                        </textarea>
                    </div>
                    <input class="upload-edit-cv" id="upload-edit-cv" type="submit" value="Upload CV">
                </div>
            </div>
        </div>
        
        
        
        <!--  HERE COMES THE SCRIPTS!!! -->
        <!--If a username is not specified... send back to homepage-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
            updatePosts();
            /**
            This sections is here to initialize all the editors in this page.
            **/
            var username = '<?php echo $_POST['username']; ?>';
            if(!username) {
                window.location = "login.html";
            }
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace( 'cv-editor' );
            CKEDITOR.instances['cv-editor'].config.height = " 430px";
            CKEDITOR.instances['cv-editor'].config.removePlugins = 'resize';
            CKEDITOR.replace( 'edit-post-editor' );
            CKEDITOR.instances['edit-post-editor'].config.height = "200px";
            CKEDITOR.instances['edit-post-editor'].config.removePlugins = 'resize';
            CKEDITOR.replace( 'new-post-editor' );
            CKEDITOR.instances['new-post-editor'].config.height = "200px";
            CKEDITOR.instances['new-post-editor'].config.removePlugins = 'resize';
            /**
            This script updates the <div class="main"> as the user 
            enters text into the search field to filter the projects.
            Don´t fiddle with the hierarchy of the <div class="main">
            as that will affect this script
            **/
            function updatePosts() {
                //get the filter string.
                    var filter_string = document.getElementById('filter_text').value;
                    //get the posts from the current user.
                    <?php
                        include 'database/connection.php';
                        mysqli_refresh($conn, MYSQLI_REFRESH_TABLE);
                        $query_post = "SELECT * FROM Post WHERE username = '".$_POST['username']."';";    
                        $result2 = $conn -> query($query_post);
                    ?>
                    //clear the inner content from class="main"
                    document.getElementById('main').innerHTML = "";
                    <?php while($row = $result2 -> fetch_assoc()){ ?>
                        var postID = '<?php echo $row[postID]; ?>';
                        var title = '<?php echo $row[title]; ?>';
                        var date = '<?php echo $row[date]; ?>';
                        //regenerate the content if it passes the filter.
                        if(title.toLowerCase().includes(filter_string.toLowerCase())) {
                            document.getElementById('main').innerHTML += '<div id="'+title+'" class="post-grid"><div class="description"><h5>'+title+'</h5><p>'+date+'</p></div><div class="edit-button"><input class="edit-post" type="button" name="'+postID+'"></div><div class="check-box"><input class="boxx" type="checkbox" name="'+postID+'"></div></div>'; 
                        }
                    <?php }?>
                enableEditButtons();
            }
            //when the user inputs something into the filter text area, the filtering begins.
            document.getElementById('filter_text').oninput = function() {
                updatePosts();
            };
            /**
            When you press the select-all-button, all the checkboxes with class = "boxx"
            will be selected.
            NOTE TO SELF: classname "boxx" is no good.
            **/
            document.getElementById('check-all').onchange = function() {
                //retrieve all check-boxes.
                var boxes = document.getElementsByClassName('boxx');
                var i;
                //depending on the status of the check-all-box, either check or uncheck
                //all of the check-boxes.
                if (document.getElementById('check-all').checked == true) {
                    for(i = 0; i < boxes.length; i++) {
                        boxes[i].checked = true;
                    }
                } else {
                    for(i = 0; i < boxes.length; i++) {
                        boxes[i].checked = false;
                    }
                }
            }
            /**
            When you click the delete-button, all the posts that have their respective
            check-boxes checked... will be deleted from the database.
            NOTE TO SELF: maybe include a warning upon deletion.
            **/
            document.getElementById("delete").onclick = function() {
                //retrieve all check-boxes.
                var check_boxes = document.getElementsByClassName("boxx");
                //go through all the check-boxes.
                var i;
                for(i = 0; i < check_boxes.length; i++) {
                    var check_box = check_boxes[i];
                    if(check_box.checked == true) {
                        //create different XMLHttpRequest depenting on webbrowser.
                        var xhr;
                        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                            xhr = new XMLHttpRequest();
                        } else if (window.ActiveXObject) { // IE 8 and older
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        //create the data, which is the posts ID number that can be
                        //found on the checkboxes Attribute "name".
                        var data = "postID=" + check_box.getAttribute("name");
                        //link to correct php script.
                        xhr.open("POST", "database/delete_post.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        //send the data to the php script.
                        xhr.send(data); 
                    }
                }
            }
            /**
            When pressing the refresh button, simply refresh the posts.
            **/
            document.getElementById("refresh-post").onclick = function() {
                updatePosts();
            }
            /**
            When you click the upload button, all the data from the new post "form" is collected
            and send to be stored in the database.
            **/
            document.getElementById("upload-new-post").onclick = function() {
                //ladda upp bilden som är selected.
                const url = 'database/upload_images.php';
                const form = document.querySelector('form');

                const files = document.querySelector('[type=file]').files;
                const formData = new FormData();
                formData.append('username', username);
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];

                    formData.append('files[]', file);
                }

                fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    console.log(response);
                });
                //nu har vi skickat bilden till servern.
                
                var title = document.getElementById("title-new-post").value;
                var content = encodeURIComponent(CKEDITOR.instances['new-post-editor'].getData());
                var img_name = files[0].name;
                //create different XMLHttpRequest depenting on webbrowser.
                var xhr;
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                //create the data, which is the posts ID number that can be
                //found on the checkboxes Attribute "name".
                var data = "username=" + username + "&title=" + title + "&content=" + content + "&img_name=" + img_name;
                //link to correct php script.
                xhr.open("POST", "database/new-post.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                //send the data to the php script.
                xhr.send(data);
                fadeOutNewPost();
            }
            /*
             window.addEventListener('load', function() {
              document.querySelector('input[type="file"]').addEventListener('change', function() {
                  if (this.files && this.files[0]) {
                      var img = document.querySelector('img');  // $('img')[0]
                      var image_url = URL.createObjectURL(this.files[0]); // set src to file url
                      img.src = image_url;
                      alert(image_url);
                      img.onload = imageIsLoaded; // optional onload event listener
                  }
              });
            });
            */
            /**
            Functions for the overlay when creating new post.
            **/
            document.getElementById("new-post").onclick = function() {
                fadeInNewPost();
            }
            document.getElementById("exit-new-post").onclick = function() {
                fadeOutNewPost();
            }
            /**
            Function for when pressing the edit button on a certain post as well as closing the edit-post editor.
            **/
            function enableEditButtons() {
                var edit_post_buttons = document.getElementsByClassName("edit-post");
                var i;
                for(i = 0; i < edit_post_buttons.length; i++)
                {
                    var post = edit_post_buttons[i];
                    post.onclick = function() {
                        var post_ID = this.getAttribute("name");
                        fadeInEditPost(post_ID);
                    }
                }   
            }
            enableEditButtons();
            document.getElementById("exit-edit-post").onclick = function() {
                fadeOutEditPost();
            }
            document.getElementById("edit-cv-button").onclick = function() {
                fadeInEditCV(username);
            }
            document.getElementById("exit-edit-cv").onclick = function() {
                fadeOutEditCV();
            }
            document.getElementById("upload-edit-cv").onclick = function() {
                alert(CKEDITOR.instances['cv-editor'].getData());
                updateCV(username, encodeURIComponent(CKEDITOR.instances['cv-editor'].getData()));
                fadeOutEditCV();
            }
            /**
            Return the title and content of a post with the specified post ID number (post_ID)
            **/
            function getPostWithID(post_ID) {
                var xhr;
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                //create the data, which is the posts ID number that can be
                //found on the checkboxes Attribute "name".
                var data = "postID=" + post_ID;
                //link to correct php script.
                xhr.open("POST", "database/get-post-with-ID.php", false);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                //send the data to the php script.
                xhr.send(data);
                //wait to fetch post details... currently not working.
               // Typical action to be performed when the document is ready:
               var respons = JSON.parse(xhr.responseText);
               return respons;
            }
            
            function getCVWithUser(username) {
                var xhr;
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                //create the data, which is the posts ID number that can be
                //found on the checkboxes Attribute "name".
                var data = "username=" + username;
                //link to correct php script.
                xhr.open("POST", "database/get-cv-with-username.php", false);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                //send the data to the php script.
                xhr.send(data);
                //wait to fetch post details... currently not working.
               // Typical action to be performed when the document is ready:
               var respons = xhr.responseText;
               alert(respons);
               return respons;
            }
            
            /*
            Update the users resume with what is in the CV editor window.
            SOMETHING IS WRONG, NOT ALL CONTENT IS UPLOADED!
            */
            function updateCV(username, content) {
                var xhr;
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                //create the data, which is the posts ID number that can be
                //found on the checkboxes Attribute "name".
                var data = "username=" + username + "&content=" + content;
                //link to correct php script.
                xhr.open("POST", "database/update-cv-with-username.php", false);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                //send the data to the php script.
                xhr.send(data);
            }
            
            document.getElementById("upload-new-changes").onclick = function() {
                var attributes = document.getElementById("upload-new-changes").attributes;
                var post_ID = attributes["name"];
                var title = document.getElementById("title-edit-post").value;
                var content = encodeURIComponent(CKEDITOR.instances['edit-post-editor'].getData());
                var xhr;
                if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                    xhr = new XMLHttpRequest();
                } else if (window.ActiveXObject) { // IE 8 and older
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                //create the data, which is the posts ID number that can be
                //found on the checkboxes Attribute "name".
                var data = "postID=" + post_ID +"&content=" + content + "&title=" + title;
                alert(data);
                //link to correct php script.
                xhr.open("POST", "database/update-post-with-ID.php", false);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                //send the data to the php script.
                xhr.send(data);
                fadeOutEditPost();
            }
        </script>
        
        
        
        
        
        <!-- This script is for handling the different fade in/out for the different forms.-->
        <script>
        /**
        Functions for fading in/out the new-post overlay.
        **/
        function fadeInNewPost() {
            var new_post = document.getElementById("overlay");
            var fade_in = document.getElementById("overlay-fade");
            var old_content = document.getElementById("content");
            new_post.style.display = 'block';
            fade_in.style.opacity = '1'; 
            old_content.style.filter = "blur(3px)";
        }
        function fadeOutNewPost() {
            var new_post = document.getElementById("overlay");
            var fade_out = document.getElementById("overlay-fade");
            var old_content = document.getElementById("content");
            fade_out.style.opacity = '0';
            old_content.style.filter = "blur(0px)";
            /*
            Wait unit transitions are done, then set display type to none so that we cant press anything and accidentaly create a new post.
            */
            $(fade_out).one("transitionend",
            function(event) {
            // Do something when the transition ends
                new_post.style.display = 'none';    
            });
        }
        /**
        Functions for fading in/out the edit post overlay.
        **/
        function fadeInEditPost(post_ID) {
            var postContent = getPostWithID(post_ID);
            CKEDITOR.instances['edit-post-editor'].setData(postContent.description);
            document.getElementById("title-edit-post").value = postContent.title;
            var attributes = document.getElementById("upload-new-changes").attributes;
            attributes["name"] = post_ID;

            var edit_post = document.getElementById("overlay-edit");
            var fade_in = document.getElementById("overlay-fade-edit");
            var old_content = document.getElementById("content");
            edit_post.style.display = 'block';
            fade_in.style.opacity = '1'; 
            old_content.style.filter = "blur(3px)";
        }
        function fadeOutEditPost() {
            var edit_post = document.getElementById("overlay-edit");
            var fade_out = document.getElementById("overlay-fade-edit");
            var old_content = document.getElementById("content");
            fade_out.style.opacity = '0';
            old_content.style.filter = "blur(0px)";
            /*
            Wait unit transitions are done, then set display type to none so that we cant press anything and accidentaly create a new post.
            */
            $(fade_out).one("transitionend",
            function(event) {
            // Do something when the transition ends
                edit_post.style.display = 'none';   
            });
        }
        /**
        Functions for fading in/out the edit CV form.
        **/
        function fadeInEditCV(username) {
            var cvContent = getCVWithUser(username);
            CKEDITOR.instances['cv-editor'].setData(cvContent);
            var edit_cv = document.getElementById("overlay-cv");
            var fade_in = document.getElementById("overlay-fade-cv");
            var old_content = document.getElementById("content");
            edit_cv.style.display = 'block';
            fade_in.style.opacity = '1'; 
            old_content.style.filter = "blur(3px)";
        }
        function fadeOutEditCV() {
            var edit_cv = document.getElementById("overlay-cv");
            var fade_out = document.getElementById("overlay-fade-cv");
            var old_content = document.getElementById("content");
            fade_out.style.opacity = '0';
            old_content.style.filter = "blur(0px)";
            /*
            Wait unit transitions are done, then set display type to none so that we cant press anything and accidentaly create a new post.
            */
            $(fade_out).one("transitionend",
            function(event) {
            // Do something when the transition ends
                edit_cv.style.display = 'none';   
            });
        }  

        function imageIsLoaded(e) { alert(e); }
        </script>
    </body>    
</html>