<?php

session_start();
session_destroy();

include "head.php";

header("Location: " . get_site_url());
