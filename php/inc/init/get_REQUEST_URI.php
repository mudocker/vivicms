<?php
isset($_SERVER['HTTP_X_ORIGINAL_URL']) and  $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];

isset($_SERVER['HTTP_X_REWRITE_URL']) and  $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];