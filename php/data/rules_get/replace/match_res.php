<?php
$allhref = $allcss = $alljs = $allimg = $newhref = $newcss = $newjs = $newimg = array();
run_time(true);
$allhref = getallhref($GLOBALS['html']);
$allimg = getallimg($GLOBALS['html']);
$alljs = getalljs($GLOBALS['html']);
$allcss = getallcss($GLOBALS['html']);
$allhref = array_diff($allhref, $allcss, $alljs, $allimg);
$GLOBALS['debug'][] = '获取所有资源链接用时：' . run_time() . 's';
$GLOBALS['debug'][] = '超链接总数：' . count($allhref);
$GLOBALS['debug'][] = '图片链接总数：' . count($allimg);
$GLOBALS['debug'][] = 'css链接总数：' . count($allcss);
$GLOBALS['debug'][] = 'js链接总数：' . count($alljs);
$caiji_config['siftags'] = $caiji_config['siftags']?$caiji_config['siftags']:array();
run_time(true);