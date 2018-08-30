<div class="right_main">
    <?php
    $ac == ''                                 and  require_once VV_CAIJI.'ac_null.php';
    $ac == 'export'                          and require_once VV_CAIJI.'export.php';
    $ac == 'import'                          and require_once VV_CAIJI.'import.php';
    ($ac == 'xiugai' || $ac == 'add')       and  require_once 'xiugai_add.php';
    ?>
 </div>