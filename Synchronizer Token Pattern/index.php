<!-- IT15018960 - D.U. Liyanage -->
<!-- CSRF Protection with Synchronizer Token Pattern -->

<!-- login page -->

<?php
  //if the user is already logged in show the home page
  if(isset($_COOKIE['session_cookie'])) 
  {
      header("location: home.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <title>Login</title>
  </head>
  <body>
    <h2 style="text-align: center;">IT15018960 - D.U. Liyanage<br>CSRF Protection with Synchronizer Token Pattern</h2>
      <!-- login form -->  
      <form class="modal-content" method="POST">
        <div class="imgcontainer">      
          <img src="./img/img_avatar.png" alt="Avatar" class="avatar">
        </div>
        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required>
          <label for="pass"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="pass" required>      
          <div style="text-align: center;">
            <button style="width:100px; background-color: #4CAF50; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer;" type="submit" id="submit" name="submit">Login</button>
          </div>
          <div style="text-align: center;">
            <br>
             <label><b>Username: </b>uthpala <b>| Password: </b>123</label> 
          </div> 
         
        </div>    
      </form>

  </body>
</html>

<!-- handles the login validation, session and cookie creation -->
<?php
  //validate hard coded user credentials
  if(isset($_POST['uname'],$_POST['pass']))
  {
   
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    if($uname == 'uthpala' && $pass == '123')
    {
      //start session
      ob_start();
      session_start();
      $cookie_name = "session_cookie";
      session_regenerate_id();
      $cookie_value = session_id();
      //set cookie parameters
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
      //generate CSRF token
      $_SESSION['csrf_token'] = sha1(base64_encode(openssl_random_pseudo_bytes(32)));
      
      $csrf_token = $_SESSION['csrf_token']."," ;
      $session_id = $cookie_value;
      //write token and session id to a file
      $token_file = fopen("token_info.txt", "w") or die("Error opening file");
      fwrite($token_file, $csrf_token);
      fwrite($token_file, $session_id);
      fclose($token_file);

      //redirect to home page
      header("location: home.php");
    }
    else
    {
      echo "<script type='text/javascript'>alert('incorrect username or password')</script>";
    }
  }

?>
