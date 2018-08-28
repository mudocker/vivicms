<?php

use md\data\downOther;
use md\data\flow\SaveCache;
use md\data\ReadCacheNoTimeout;
use md\data\rules\ac_yulan;
use md\data\rules\echo_html;
use md\data\rules\urlext\downFont;
use md\data\rules\urlext\downHtml;
use md\data\rules\urlext\downCss;
use md\data\rules\urlext\downloadImage;
use md\data\rules\urlext\downloadJS;
use md\data\rules\urlext\downSwf;
use md\data\SiteAbortReadCache;
use md\getConfig;

require_once(VV_DATA . '/rules/config.php');
require_once(DRULES . 'func.php');
new getConfig();
new downloadImage();                                                                                              //������
new downCss();
new downHtml();
new downloadJS();
new downSwf();
new downFont();
new downOther();

                                                                                                                       //����
new SiteAbortReadCache();                                                                                                //վ�쳣 ��
new ReadCacheNoTimeout();                                                                                              // ����ʱ ��


getHtml($caiji);                                                                                                        //�� �󻺴�

require_once (DREPLACE.'main_new.php');
plus_run('end');
new SaveCache();
new ac_yulan();
new echo_html();

?>