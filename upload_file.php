<!--
    File Name   : upload_file.php
    Description : Upload any file/image to a folder and show all the images of that folder 
    Author      : Maniruzzaman Akash
-->

<?php
if (isset($_POST['submit_file'])) {

    $name = $_POST['name'];     //Get User Name
    $directory = "upload/";     //Get directory name
    $file_name = $directory . basename($_FILES["upload_file"]["name"]);
    $file_size = $_FILES["upload_file"]["size"] / 1000;     //Convert file size from byte to kb
    $file_type = pathinfo($file_name, PATHINFO_EXTENSION);  //Get file extension
    $check_file_exist = file_exists($file_name);            //Check file exists or not
    echo 'Hello '. $name . '<strong><br/>File Specification is :</strong>'
    . '<br>File name :' . $file_name . '<br>File Size : ' . $file_size . 'KB<br>File Type : ' . $file_type . '<hr>';

    if ($check_file_exist) {
        echo 'Sorry!! File is already existed in the <span class="mark">' . $directory . '</span> directory';
    } else if ($file_size > 2000) {
        echo 'File is greater than 2MB!! Please select a file of less than 2MB';
    } else if ($file_type != 'jpg' && $file_type != 'png' && $file_type != 'jpeg' && $file_type != 'gif') {
        echo 'File Type is : ' . $file_type . ' Sorry!! Only upload a jpg, png, jpeg or gif format image file';
    } else {
        move_uploaded_file($_FILES["upload_file"]["tmp_name"], $file_name);
        echo 'File has uploaded successfully in <span class="mark">' . $directory . '</span> directory';
    }
}
?>
<html>
    <head>
        <title>File Upload in PHP with proper validation:</title>
        <style>
            body {
                background: #263238;
                min-height: 100%;
                color: #FFF;
                font-size: 16px;
                padding: 10px;
                font-family: inherit;
            }
            .container{
                padding-right: 15px;
                padding-left: 15px;
                margin-right: 10%;
                margin-left: 10%;
                margin-top: 5%;

            }
            input{
                font-weight: 300;
                outline: none;
                box-shadow: none;
                height: 40px;
                background: transparent;
                border-radius: 0px;
                padding:10px;
                color: #FFF;
            }
            fieldset {
                padding: 5%;
            }
            input[type="submit"] {
                background: #00897B;
                border-radius: 10px;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background: #AD1457;
            }
            input[type="text"] {
                width: 50%;
                border: 1px solid #00897b;
            }
            input:active,input:hover, input:focus {
                border: 1px solid #43A047;
            }
            legend {
                font-size: 20px;
                color: #43dccf;
                font-weight: bold;
            }
            .mark{
                background: #F44336;
                padding: 5px;
                border-radius: 10px;
                border: 1px solid gray;
            }
            .show{
                
            }
            .images {
                background: #B2EBF2;
                padding: 20px;
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>File Upload System</legend>
                    <label>Enter Your Name :</label>
                    <input type="text" required="required" name="name" placeholder="Enter name" /><br/>
                    <label>Choose a file to upload :</label>
                    <input type="file" required="required"  name="upload_file" /><br/>
                    <input type="submit" name="submit_file" value="Upload File" /><br/>
                </fieldset>

            </form>
            <div class="show">
                <h2>Show all the images of Upload directory :</h2>
                <div class="images">

                    <?php
                    $dirname = "upload/";
                    
                    //To show everything of a directory
                    $images = glob($dirname . "*");
                    
                    //$images = glob($dirname . "*.jpg");   //to get only jpg image
                    if (count(glob("$dirname/*")) != 0) {   //Check if the directory has any file or not
                        foreach ($images as $image) {
                            echo '<img style="width:200px; height:120px" src="' . $image . '" /> ';
                        }
                    }else{
                        echo "Sorry!! There is no images to show..";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
