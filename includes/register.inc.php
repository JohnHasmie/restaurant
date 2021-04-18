<?php  
$user = new Auth();

// Check status login user 
if ($user->isLoggedIn()) {
    header("location: ../pages/dashboard.php"); //redirect to index 
}

$firstname = isset($_GET['firstname']) ? $_GET['firstname'] : '';
$lastname = isset($_GET['lastname']) ? $_GET['lastname'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';

//Check data send
if(isset($_POST['register'])){ 
  // Registration new user
  if($user->register($_POST)){
    $success = true; 
  }else{
    $error = $user->getLastError(); 
  } 

} 

?> 