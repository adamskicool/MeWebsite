<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>A Simple Page with CKEditor</title>
        <!-- Make sure the path to CKEditor is correct. -->
        <script src="../CKEditor4/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <textarea name="editor1" id="editor1" rows="10" cols="80">
            This is my textarea to be replaced with CKEditor.
        </textarea>
        <button id="button">Press Me!</button>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace( 'editor1' );
            
            document.getElementById("button").onclick = function() {
                var data = CKEDITOR.instances['editor1'].getData();
                alert(data);
            }
        </script>

    </body>
</html>