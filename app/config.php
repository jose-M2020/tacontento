<?php 
 
// Product Details  
// Minimum amount is $0.50 US  
$productName = "Codex Demo Product";  
$productID = "DP12345";  
$productPrice = 55; 
$currency = "MXN"; 
  
/* 
 * Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
define('STRIPE_API_KEY', 'sk_test_51H5A8aCM5KXQbk1bumE7T4AslLN28vEamXOyztwiNh8FV7t4Um1vYF7c93iEceRbEhYZDIXIjBN7vhpbQy9vvw5p00tzXZBNvm'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51H5A8aCM5KXQbk1b2uC2gpoeyOSxzZEJovELpsSi2VsPodogwtwhIFQMNnWJlQ3gDwijegRd4LnuniIt3rakCT2k00wfuqcpNE'); 
define('STRIPE_SUCCESS_URL', 'http://localhost/tacontento/index.php?page=payment-success.php'); //Payment success URL 
define('STRIPE_CANCEL_URL', 'http://localhost/tacontento/index.php?page=payment-cancel.php'); //Payment cancel URL 

// Database configuration    
define('DB_HOST', 'MySQL_Database_Host');   
define('DB_USERNAME', 'MySQL_Database_Username'); 
define('DB_PASSWORD', 'MySQL_Database_Password');   
define('DB_NAME', 'MySQL_Database_Name'); 
 
?>