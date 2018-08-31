vivicms
后台地址：
/ybet_viviadmin/index.php
帐号：
admin
密码：
admin


nginx 手册

http://www.nginx.cn/doc/

server{
include D:/all/php/vivicms/php/ng_rewrite.conf;
}












if ( !-e $request_filename ) {
  rewrite ^(/admin.*)$  $1 last;
  rewrite ^(/.*/public_admin.*)$  $1 last;
  rewrite ^(.*\.js)$   js.php?/$1 last;
  rewrite ^(.*\.css)$  css.php?/$1 last;
  rewrite ^(.*\.jpg.*)$  img.php?/$1 last;
   #  rewrite ^(/.*\.[gif|jpg|png|jpeg].*)$  img.php?/$1 last;
  #  rewrite ^(.*)\.(ttf|woff)(.*)$  font.php?/$1 last;
    #   rewrite ^(.*)\.(html|htm)(.*)$  html.php?/$1 last;
    break;
}
