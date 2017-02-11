<?php
 

global $current_user; 
get_currentuserinfo();
 
 
?>

<?php echo __( 'Hello', 'login-form' ); ?>, <?php print $current_user->user_login  ?>