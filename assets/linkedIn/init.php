<?php

//session_start();

//require "vendor/autoload.php";
require "LinkedIn.php";

use myPHPnotes\LinkedIn;

$app_id = "77231hj9at7ab1";
$app_secret = "4OFvfNUNUJ7gVpvr";
$app_callback = "https://app.decision168.com/callback";
//$app_callback = "http://localhost/decision168/callback";
$app_scopes = "r_emailaddress r_liteprofile";

$ssl = false; // ALWAYS TRUE FOR PRODUCTION USE

$linkedin = new LinkedIn($app_id, $app_secret, $app_callback, $app_scopes, $ssl);

// r_emailaddress / r_primarycontact  == email address
// r_liteprofile == id , firstname , lastname , profilePic
//r_basicprofile 

// w_member_social == Post, comment and like posts on behalf of an authenticated member.


/*  rw_company_admin ==
rw_company_admin permission will be split up into the following set of permissions: Refer Marketing Permissions Migration for further details.

rw_organization_admin - Manage member’s organizations' pages and retrieve reporting data
r_organization_social - Retrieve member’s organizations' posts, including any comments, likes and other engagement data
w_organization_social - Post, comment and like posts on behalf of member’s organization's  
*/