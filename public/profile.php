<?php 
require_once "../includes/middleware.php"; 
$user = checkAccess('user'); // Everyone allowed
?>
<div class="container"><h2>My Profile</h2><p>Welcome User <?php echo $user['email']; ?></p></div>