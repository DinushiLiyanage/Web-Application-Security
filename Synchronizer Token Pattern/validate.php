<!-- IT15018960 - D.U. Liyanage -->
<!-- CSRF Protection with Synchronizer Token Pattern -->

<!-- handles the POST request from home page to check whether CSRF exists -->

<?php
    if(isset($_COOKIE['session_cookie']))
    {
        $token_file = fopen("token_info.txt", "r") or die("Unable to open file!");
        list($csrf_token, $session_id) = explode(",",chop(fgets($token_file)),2); 
        fclose($token_file);

     	//check whether the recieved token value is equal to the stored token value
        if($_POST['csrf_token'] == $csrf_token)
        {
            //check whether the corresponding session id is equal to the stored session id
            if($_COOKIE['session_cookie'] == $session_id)
            {
    			header("location: home.php?msg=success"); //request successful
            }
            else 
            {
    			header("location: home.php?msg=failedSESSION"); //request failed
            }
        }
        else 
        {		
           header("location: home.php?msg=failedCSRF"); //request failed
        }
    }
    else 
    {
    	header("location: home.php?msg=invalid"); //invalid request
    }

?>