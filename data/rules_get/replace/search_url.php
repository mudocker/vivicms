<?php
$caiji_config['search_url'] and  $GLOBALS['html'] = preg_replace('~<form([^>]+)action\s*=\s*(["|\']?)' . $caiji_config['search_url'] . '~i', '<form$1action=$2' . WEB_ROOT . '/search.php', $GLOBALS['html']);
