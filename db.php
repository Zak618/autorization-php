<?php

require "libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=test',
'root', 'root' );

session_start();