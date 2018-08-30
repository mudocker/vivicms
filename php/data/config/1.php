<?php
return array (
  'name' => '极思维',
  'from_url' => 'http://www.topthink.com',
  'other_url' => 'www.topthink.com,http://box.topthink.com',
  'charset' => 'utf-8',
  'replacerules' => '//hm.baidu.com/hm.js?7356fff7035ad4a8d3760a0e1427b2eb******',
  'siftrules' => '{vivi replace=\'\'}<ul class="imglink">(.*)</ul>{/vivi}
{vivi replace=\'\'}<ul class="textlink">(.*)</ul>{/vivi}
{vivi replace=\'\'}<script[^\\r\\n]*conac\\.cn(.*?)<\\/script>{/vivi}
{vivi replace=\'\'}<script[^\\r\\n]*cnzz(.*?)<\\/script>{/vivi}
{vivi replace=\'\'}<script[^\\r\\n]*51\\.la(.*?)<\\/script>{/vivi}
{vivi replace=\'\'}<script[^\\r\\n]*51yes(.*?)<\\/script>{/vivi}',
  'replace' => '0',
  'rewrite' => '1',
  'licence' => '1.logo图片在static/mm/logo.gif，没有就新建，大小不要超过 188*60，否则变形',
  'siftags' => 
  array (
    0 => 'iframe',
    1 => 'outjs',
  ),
  'time' => 1535636626,
  'search_url' => '',
  'search_charset' => 'utf-8',
  'from_title' => '极思维',
  'big52gbk' => '0',
  'other_imgurl' => '',
  'resdomain' => 'http://www.topthink.com/',
  'jsdomain' => 'www.topthink.com',
  'cssdomain' => 'www.topthink.com',
  'fontdomain' => 'http://www.topthink.com/Public/static/bootstrap/',
  'htmldomain' => 'http://www.topthink.com',
  'imgdomain' => 'http://box.topthink.com',
  'hidejserror' => '1',
  'body_start' => '',
  'body_end' => '',
  'css' => 'http://www.topthink.com/',
  'cookie' => '',
  'user_agent' => 'Baiduspider/2.0+(+http://www.baidu.com/search/spider.htm)',
  'referer' => 'http://www.baidu.com/search/spider.htm',
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
  'use_curl' => '1',
);
?>