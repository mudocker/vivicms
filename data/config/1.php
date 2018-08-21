<?php
return array (
  'name' => 'topthink - 极思维',
  'from_url' => 'http://www.topthink.com',
  'other_url' => 'topthink.com',
  'charset' => 'utf-8',
  'replacerules' => '//hm.baidu.com/hm.js?7356fff7035ad4a8d3760a0e1427b2eb******',
  'siftrules' => '{vivi replace=\'\'}<ul class="imglink">(.*)</ul>{/vivi}[cutline]{vivi replace=\'\'}<ul class="textlink">(.*)</ul>{/vivi}[cutline]{vivi replace=\'\'}<script[^\\r\\n]*conac\\.cn(.*?)<\\/script>{/vivi}[cutline]{vivi replace=\'\'}<script[^\\r\\n]*cnzz(.*?)<\\/script>{/vivi}[cutline]{vivi replace=\'\'}<script[^\\r\\n]*51\\.la(.*?)<\\/script>{/vivi}[cutline]{vivi replace=\'\'}<script[^\\r\\n]*51yes(.*?)<\\/script>{/vivi}',
  'replace' => '0',
  'rewrite' => '1',
  'licence' => '1.logo图片在static/mm/logo.gif，没有就新建，大小不要超过 188*60，否则变形',
  'siftags' => 
  array (
    0 => 'iframe',
    1 => 'outjs',
  ),
  'time' => 1477300556,
  'search_url' => 'search/',
  'search_charset' => 'utf-8',
  'from_title' => '',
  'big52gbk' => '0',
  'other_imgurl' => '',
  'resdomain' => 'http://www.topthink.com/',
  'hidejserror' => '1',
  'body_start' => '',
  'body_end' => '',
  'css' => 'http://www.topthink.com/',
  'cookie' => '',
  'user_agent' => '',
  'referer' => '',
  'ip' => '202.106.169.228:8080',
  'ip_type' => '1',
  'replace_before_on' => '0',
  'replacerules_before' => '',
  'siftrules_before' => '',
  'tplfile' => '',
  'zdy' => 
  array (
    0 => 
    array (
      'type' => '0',
      'body' => '',
      'regx' => '',
      'start' => '',
      'end' => '',
    ),
  ),
  'img_delay_name' => 'data-original',
  'no_siteapp' => '0',
  'plus' => '',
);
?>