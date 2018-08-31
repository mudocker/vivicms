<?php
require_once('autoload.php');
require_once("data.php");
header("Content-Type:text/html; charset=utf-8");
$v_config = require_once(VV_DATA."/config.php");
require_once("checkAdmin.php");
$id = isset($_GET['id'])?(int)$_GET['id']:'';
$ac = isset($_GET['ac'])?$_GET['ac']:'';
require_once(VV_CAIJI_CONFIG."del.php");
require_once(VV_CAIJI_CONFIG."yulan.php");
require_once(VV_CAIJI_CONFIG."savecollectid.php");
require_once(VV_CAIJI_CONFIG."status.php");
require_once(VV_CAIJI_CONFIG."save.php");
require_once(VV_CAIJI_CONFIG."saveimport.php");
require_once (VV_ADMIN.'/tmp_header.php');
echo ADMIN_HEAD;
?>
<body>
<div class="right">
    <?php include "welcome.php"; ?>
     <?php   require_once VV_CAIJI.'right_main.php'; ?>
</div>




<?php include "footer.php"; ?>

</body>
</htm>