<?php

require './config/config.php';
require './config/connection.php';
require './functions.php';

logout();
setMsg('Logged out successfully', 'success');
redirect('./login.php');
