<!-- IT15018960 - D.U. Liyanage -->
<!-- CSRF Protection with Synchronizer Token Pattern -->

<!-- allows sending a POST request from a form to be checked for CSRF existence -->

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <script src="./public/jquery-3.3.1.min.js"></script>
        <title>Send POST Request</title>
    </head>
    <body>

    <!-- form to send a POST request -->
    <form class="modal-content" style="margin: auto; width:500px;" action="validate.php" method="POST">
        <div class="container">
            <!--  CSRF token is hidden -->
            <input type='hidden' name='csrf_token' id='csrf_token' value=''>                                            
           
            <div style="text-align: center;">
                <label for="send"><b>Send a POST request: </b></label>
                <button style="width:100px; background-color: #4CAF50; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer;" type="submit" id="submit" name="submit">Send</button>
            </div> 					
        </div>    
    </form>

    <!-- show the status of the previously sent POST request -->
    <div style="text-align: center;">
        <?php 
            if(isset($_GET['msg']))
            {
                if($_GET['msg'] == 'success')
                {
                    echo '<h3 style="color:green;">Request Successful! CSRF Not Found!</h3><br />';
                }
                elseif($_GET['msg'] == 'failed')
                {                    
                    echo '<h3 style="color:red;">Request Invalid! CSRF Found!</h3><br />';
                }
                elseif($_GET['msg'] == 'invalid')
                {
                    echo '<h3 style="color:red;">Request Invalid! Something is wrong</h3><br />';                    
                }
            }
        ?>
    </div>

    <!-- logout -->
    <div style="text-align: center;">
        <a href="logout.php">
        <button style="width:100px; background-color: #FF0000; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer;" id="logout" name="logout" >Logout</button></a>
    </div> 

    <!-- send a AJAX request to endpoint to get the CSRF token -->
    <script type="text/javascript">    
        var request = "true";
        $.ajax({
            url:'sendToken.php',
            method:'POST',
            data:{request:"request"},
            dataType:'json',
            success:function(data)
            {
                //set the retrieved CSRF token as the value of hidden form field 'csrf_token'
                document.getElementById("csrf_token").value = data.token;
            }

        })

    </script>
</body>
</html>
