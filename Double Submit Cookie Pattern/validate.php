<!-- IT15018960 - D.U. Liyanage -->
<!-- CSRF Protection with Double Submit Cookie Pattern -->

<!-- handles the POST request from home page to check whether CSRF exists -->

<?php
    if(isset($_POST['csrf_token']))
    {
     	//check whether the recieved token value is equal to the CSRF cookie value
        if($_POST['csrf_token'] == $_COOKIE['csrf_cookie'])
        {
            header("location: home.php?msg=success"); //request successful
        }
        else 
        {	
            header("location: home.php?msg=failed"); //request failed
        }
    }
    else 
    {
    	header("location: home.php?msg=invalid"); //invalid request
    }    
?>

