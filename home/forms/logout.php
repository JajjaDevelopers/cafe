<?php
session_start();
session_unset();
session_destroy();

include "redirect.php";//takes back user to the home page
?>