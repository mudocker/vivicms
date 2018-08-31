<tbody id="config7" style="display:none">
             <!--    JS资源站-->
            <tr nowrap class="firstalt">
                <td width="260"><b>JS资源站</b></td>
                <td>
                    <input class="config7_input" type="text" name="con[jsdomain]"
                           value="<?php echo $caiji_config['jsdomain']; ?>"
                           onFocus="onFocus(this)" onBlur="onBlur(this)" >
                </td>
            </tr>
             <!--    css资源站-->
            <tr nowrap class="firstalt">
                 <td width="260"><b>css资源站</b></td>
                 <td>
                     <input class="config7_input" type="text" name="con[cssdomain]"
                            value="<?php echo $caiji_config['cssdomain']; ?>"
                            onFocus="onFocus(this)" onBlur="onBlur(this)" >
                 </td>
             </tr>
             <!--    font资源站-->
             <tr nowrap class="firstalt">
                 <td width="260"><b>字体资源站</b></td>
                 <td>
                     <input class="config7_input" type="text" name="con[fontdomain]"
                            value="<?php echo $caiji_config['fontdomain']; ?>"
                            onFocus="onFocus(this)" onBlur="onBlur(this)" >
                 </td>
             </tr>
             <!--    html资源站-->
             <tr nowrap class="firstalt">
                 <td width="260"><b>HTML资源站</b></td>
                 <td>
                     <input class="config7_input" type="text" name="con[htmldomain]"
                            value="<?php echo $caiji_config['htmldomain']; ?>"
                            onFocus="onFocus(this)" onBlur="onBlur(this)" >
                 </td>
             </tr>
             <!--    用CURL下载-->
             <tr nowrap class="firstalt">
                 <td width="260"><b>用CURL下载</b></td>
                 <td>
                     <input class="config7_input" type="text" name="con[use_curl]"
                            value="<?=($ac=='add'?1: $caiji_config['use_curl']) ?>"
                            onFocus="onFocus(this)" onBlur="onBlur(this)" >
                 </td>
             </tr>
</tbody>


<!--<script>
    new Vue({
        el: '.right',
        data: {
            lists:[
                { title:'JS资源站',     name:"con[jsdomain]",         value:<?php /*echo $caiji_config['jsdomain']; */?>,  width:260},
                { title:'css资源站',    name:"con[cssdomain]",        value:<?php /*echo $caiji_config['cssdomain']; */?>, width:260},
                { title:'字体资源站',   name:"con[fontdomain]",       value:<?php /*echo $caiji_config['fontdomain']; */?>,width:260},
                { title:'HTML资源站',   name:"con[htmldomain]",       value:<?php /*echo $caiji_config['htmldomain']; */?>,width:260},
                { title:'用CURL下载',   name:"con[use_curl]",         value:<?php /*echo $caiji_config['use_curl']; */?>,  width:260},
            ]
        }
    })
</script>-->