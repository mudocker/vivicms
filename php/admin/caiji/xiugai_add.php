<?php if($ac == 'xiugai'){
        $file = VV_CONFIG .DS . $id . '.php';
        !is_file($file) and ShowMsg("采集配置文件不存在", '-1', 3000);
        $caiji_config = require_once($file);
        $caiji_config['siftrules'] and                                                                                $caiji_config['siftrules'] = implode("\r\n", explode('[cutline]', $caiji_config['siftrules']));

        $caiji_config['siftrules_before'] and                                                                         $caiji_config['siftrules_before'] = implode("\r\n", explode('[cutline]', $caiji_config['siftrules_before']));

        empty($caiji_config['siftags']) and                                                                           $caiji_config['siftags'] = array('123');
        $caiji_config['resdomain'] = $caiji_config['resdomain']?$caiji_config['resdomain']:$caiji_config['other_imgurl'];
    }else{
        $caiji_config = array('name' => '', 'replace' => '', 'charset' => 'gb2312', 'from_url' => '', 'resdomain' => '', 'siftags' => array(), 'siftrules' => '', 'replacerules' => '', 'rewrite' => '', 'licence' => '', 'from_title' => '', 'search_url' => '',);
        $arr = glob( VV_CONFIG.DS. '*.php');
        $id = 1;
        if($arr){
            $arr = array_map('basename', $arr);
            $arr = array_map('intval', $arr);
            $id = max($arr) + 1;
        }
    } ?>


    <div id="dialog"></div>
    <form action="?ac=save&id=<?php echo $id ?>" method="post" id="form">
        <table width="98%"
               border="0"
               cellpadding="4"
               cellspacing="1"
               class="tableoutline">
            <?php
                require_once VV_XIUGAI_ADD.'config0.php';
                require_once VV_XIUGAI_ADD.'config1.php';
                require_once VV_XIUGAI_ADD.'config2.php';
                require_once VV_XIUGAI_ADD.'config3.php';
                require_once VV_XIUGAI_ADD.'config4.php';
                require_once VV_XIUGAI_ADD.'config_gaiji.php';
                require_once VV_XIUGAI_ADD.'config6.php';
                require_once VV_XIUGAI_ADD.'config7.php';
                require_once VV_XIUGAI_ADD.'config_button.php';
            ?>

        </table>
    </form>
<script>
    $(function() {
        $("#replace_before_on").click(function(){$(".replace_before_body").show();});
        $("#replace_before_off").click(function(){$(".replace_before_body").hide();});
    });
</script>
<script type="text/javascript">
    function tab(no,n){
        for(var i=1;i<=n;i++){
            $('#tab'+i).removeClass('cur');
            $('#config'+i).hide();
        }
        $('#config'+no).fadeIn();
        $('#tab'+no).addClass('cur');
    }
</script>

<style type="text/css">
    #quick td {border-bottom: 1px solid #eee;}
    li.cur { background: #eefffd;}
</style>
