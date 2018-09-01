<?php
 class template{
    public $template_dir = '';
    public $cache_dir = '';
    public $compile_dir = '';
    public $cache_lifetime = 3600;
    public $caching = false;
    public $force_compile = false;
    public $compile_check = false;
    public $_foreach = array();
    public $_current_file = '';
    public $_expires = 0;
    public $_nowtime = null;
    public $_temp_key = array();
    public $_temp_val = array();
    public $plugins_dir = '';
    public function __construct(){
        $this -> _nowtime = time();
        $this -> template_file = array();
        $this -> _var = array();
        $this -> left_delimiter = '{';
        $this -> right_delimiter = '}';
    }
    public function assign($tpl_var, $value = ''){
        if(is_array($tpl_var)){
            foreach($tpl_var AS $key => $val){
                if($key != ''){
                    $this -> _var[$key] = $val;
                }
            }
        }else{
            if($tpl_var != ''){
                $this -> _var[$tpl_var] = $value;
            }
        }
    }
    public function display($filename, $cache_id = ''){
        $out = $this -> fetch($filename, $cache_id);
        echo $out;
    }
    public function fetch($filename, $cache_id = ''){
        $this -> template_dir = rtrim($this -> template_dir, '/');
        if(strncmp($filename, 'str:', 4) == 0){
            $out = $this -> _eval($this -> fetch_str(substr($filename, 4)));
        }else{
            if(!is_file($filename)){
                $filename = $this -> template_dir . '/' . $filename;
            }
            if(!is_file($filename)){
                return false;
            }
            if($cache_id && $this -> caching){
                $out = $this -> template_out;
            }else{
                if(!in_array($filename, $this -> template_file)){
                    $this -> template_file[] = $filename;
                }
                $out = $this -> make_compiled($filename);
                if($cache_id){
                    $cachename = basename($filename, strrchr($filename, '.')) . '_' . $cache_id;
                    $data = serialize(array('template' => $this -> template_file, 'expires' => $this -> _nowtime + $this -> cache_lifetime, 'maketime' => $this -> _nowtime));
                    $hash_dir = rtrim($this -> cache_dir, '/');
                    if($this -> write($hash_dir . '/' . $cachename . '.php', '<?php exit;?>' . $data . $out) === false){
                        trigger_error('can\'t write:' . $hash_dir . '/' . $cachename . '.php');
                    }
                    $this -> template_file = array();
                }
            }
        }
        return $out;
    }
    public function make_compiled($filename){
        $this -> compile_dir = rtrim($this -> compile_dir, '/');
        $name = $this -> compile_dir . '/' . md5($filename) . '_' . basename($filename) . '.php';
        if($this -> _expires){
            $expires = $this -> _expires - $this -> cache_lifetime;
        }else{
            $filestat = @stat($name);
            $expires = $filestat['mtime'];
        }
        $filestat = @stat($filename);
        $file_change = false;
        if($this -> compile_check){
            $md5_val = md5_file($filename);
            $md5data_file = $this -> compile_dir . '/md5.php';
            $md5_key = md5($filename) . '/' . basename($filename);
            if(!is_file($md5data_file)){
                $file_change = true;
                $this -> write($md5data_file, serialize(array($md5_key => $md5_val)));
            }else{
                $md5_arr = unserialize(file_get_contents($md5data_file));
                if(!isset($md5_arr[$md5_key]) || $md5_arr[$md5_key] != $md5_val){
                    $md5_arr[$md5_key] = $md5_val;
                    $file_change = true;
                    $this -> write($md5data_file, serialize($md5_arr));
                }
            }
        }
        if(!$file_change && $filestat['mtime'] <= $expires && !$this -> force_compile){
            if(file_exists($name)){
                $source = $this -> _require($name);
                if($source == ''){
                    $expires = 0;
                }
            }else{
                $source = '';
                $expires = 0;
            }
        }
        if($file_change || $this -> force_compile || $filestat['mtime'] > $expires){
            $this -> _current_file = $filename;
            $source = $this -> fetch_str(file_get_contents($filename));
            $source = '<?php /* by www.vxiaotou.com */ ?>' . $source;
            if($this -> write($name, $source) === false){
                trigger_error('can\'t write:' . $name);
            }
            $source = $this -> _eval($source);
        }
        return $source;
    }
    public function fetch_str($source){
        $source = $this -> prefilter_preCompile($source);
        return preg_replace_callback("/" . $this -> left_delimiter . "(\S[^\}\{\n]*)" . $this -> right_delimiter . "/", array($this, 'select'), $source);
    }
    public function is_cached($filename, $cache_id = ''){
        $cachename = basename($filename, strrchr($filename, '.'));
        if($this -> caching == true && $this -> direct_output == false){
            $hash_dir = rtrim($this -> cache_dir, '/');
            if($data = @file_get_contents($hash_dir . '/' . $cachename . '.php')){
                $data = substr($data, 13);
                $pos = strpos($data, '<');
                $paradata = substr($data, 0, $pos);
                $para = @unserialize($paradata);
                if($para === false || $this -> _nowtime > $para['expires']){
                    $this -> caching = false;
                    return false;
                }
                $this -> _expires = $para['expires'];
                $this -> template_out = substr($data, $pos);
                foreach($para['template'] AS $val){
                    $stat = @stat($val);
                    if($para['maketime'] < $stat['mtime']){
                        $this -> caching = false;
                        return false;
                    }
                }
            }else{
                $this -> caching = false;
                return false;
            }
            return true;
        }else{
            return false;
        }
    }
    public function select($tag){
        is_array($tag) && $tag = $tag[1];
        $tag = stripslashes(trim($tag));
        if(empty($tag)){
            return '';
        }else if($tag{0} == '*' && substr($tag, -1) == '*'){
            return '';
        }else if(preg_match('~^(\$[a-zA-Z_\x7f-\xff][\w\x7f-\xff]*)([\+-/\*]+)(\$[a-zA-Z_\x7f-\xff][\w\x7f-\xff]*)$~', $tag, $match)){
            $arr = preg_split('~([\+-/\*]+)~', $tag, -1, PREG_SPLIT_DELIM_CAPTURE);
            $str = '';
            foreach($arr as $k => $vo){
                if($k % 2 == 0){
                    $str .= $this -> get_val(substr($vo, 1));
                    continue;
                }
                $str .= $vo;
            }
            return '<?php echo (' . $str . '); ?>';
        }else if($tag{0} == '$'){
            return '<?php echo ' . $this -> get_val(substr($tag, 1)) . '; ?>';
        }else if($tag{0} == '/'){
            switch(substr($tag, 1)){
            case 'if': return '<?php endif; ?>';
                break;
            case 'foreach': if($this -> _foreachmark == 'foreachelse'){
                    $output = '<?php endif; unset($_from); ?>';
                }else{
                    array_pop($this -> _patchstack);
                    $output = '<?php endforeach; endif; unset($_from); ?>';
                }
                $output .= "<?php \$this->pop_vars(); ?>";
                return $output;
                break;
            case 'literal': return '';
                break;
            case 'php': return ' ?>';
                break;
            default: $plugfile = $this -> plugins_dir . 'block.' . substr($tag, 1) . '.php';
                if(is_file($plugfile)){
                    return '<?php }} ?>';
                }
                return $tag;
                break;
            }
        }else if(preg_match('~^(\w+)\(.*\)$~', $tag, $match)){
            if(function_exists($match[1])){
                return '<?php echo ' . $tag . '; ?>';
            }
        }else if(substr($tag, -1) == '/'){
            $tag_sel = @array_shift(explode(' ', $tag));
            $plugfile = $this -> plugins_dir . 'function.' . $tag_sel . '.php';
            if(is_file($plugfile)){
                $tagfunc = 'tag_function_' . $tag_sel;
                $arr = explode(' ', substr($tag, 0, -1));
                array_shift($arr);
                $param = $this -> get_params(implode(' ', $arr), 0);
                return '<?php echo $this->' . $tagfunc . '(' . var_export($param, true) . '); ?>';
            }
        }else{
            $tagarr = explode(' ', $tag);
            $tag_sel = array_shift($tagarr);
            switch($tag_sel){
            case 'if': return $this -> _compile_if_tag(substr($tag, 3));
                break;
            case 'else': return '<?php else: ?>';
                break;
            case 'elseif': return $this -> _compile_if_tag(substr($tag, 7), true);
                break;
            case 'foreachelse': $this -> _foreachmark = 'foreachelse';
                return '<?php endforeach; else: ?>';
                break;
            case 'foreach': $this -> _foreachmark = 'foreach';
                if(!isset($this -> _patchstack)){
                    $this -> _patchstack = array();
                }
                return $this -> _compile_foreach_start(substr($tag, 8));
                break;
            case 'assign': $t = $this -> get_params(substr($tag, 7), 0);
                if($t['value']{
                        0} == '$'){
                    if(strpos($t['value'], '+') !== false){
                        preg_match('/\+(\d)+\'\]/', $t['value'], $a);
                        $v1 = empty($a[1]) ? 0 : $a[1];
                        $t['value'] = preg_replace('/\+(\d)+/', '', $t['value']);
                        $tmp = '$this->assign(\'' . $t['var'] . '\',' . $t['value'] . ' + ' . $v1 . ');';
                    }else{
                        $tmp = '$this->assign(\'' . $t['var'] . '\',' . $t['value'] . ');';
                    }
                }else{
                    $tmp = '$this->assign(\'' . $t['var'] . '\',\'' . addcslashes($t['value'], "'") . '\');';
                }
                return '<?php ' . $tmp . ' ?>';
                break;
            case 'math': $t = $this -> get_math_para(substr($tag, 8));
                return'<?php echo ' . $t . '; ?>';
                break;
            case 'include': $t = $this -> get_params(substr($tag, 8), 0);
                return '<?php echo $this->fetch(' . "'$t[file]'" . '); ?>';
                break;
            case 'literal': return '';
                break;
            case 'php': return '<?php ';
                break;
            default: $plugfile = $this -> plugins_dir . 'block.' . $tag_sel . '.php';
                if(is_file($plugfile)){
                    $tagfunc = 'tag_block_' . $tag_sel;
                    $arr = explode(' ', $tag);
                    array_shift($arr);
                    $param = $this -> get_params(implode(' ', $arr), 0);
                    $as = isset($param['as'])?$param['as']:'vo';
                    return '<?php $this->_tags_data=$this->' . $tagfunc . '(' . var_export($param, true) . ');if($this->_tags_data){ foreach($this->_tags_data as $this->_var["k"]=>$this->_var["' . $as . '"]){ ?>';
                }
                return $this -> left_delimiter . $tag . $this -> right_delimiter;
                break;
            }
        }
        return $this -> left_delimiter . $tag . $this -> right_delimiter;
    }
    public function get_val($val){
        if(strrpos($val, '[') !== false){
            if(!function_exists('temp_func_362')){
                function temp_func_362($arg){
                    return '.' . str_replace('$', "\$", $arg[1]);
                }
            }
            $val = preg_replace_callback("/\[([^\[\]]*)\]/is", 'temp_func_362', $val);
        }
        if(strrpos($val, '|') !== false){
            $moddb = explode('|', $val);
            $val = array_shift($moddb);
        }
        if(empty($val)){
            return '';
        }
        if(strpos($val, '.$') !== false){
            $all = explode('.$', $val);
            foreach($all AS $key => $val){
                $all[$key] = $key == 0 ? $this -> make_var($val) : '[' . $this -> make_var($val) . ']';
            }
            $p = implode('', $all);
        }else{
            $p = $this -> make_var($val);
        }
        if(!empty($moddb)){
            foreach($moddb as $key => $mod){
                $s = explode(':', $mod);
                $s[1] = implode('', array_slice($s, 1));
                switch($s[0]){
                case 'default': if($s[1]{
                            0} == '$'){
                        $v = $this -> get_val(substr($s[1], 1));
                    }else if(preg_match('~^"[^\$]+\$[a-z,A-Z][\w]+\W*[^\"]*"$~', $s[1])){
                        preg_match_all('~(\$[a-z,A-Z][\w]+)~', $s[1], $match);
                        array_shift($match);
                        $match = array_shift($match);
                        if(!function_exists('temp_func_399')){
                            function temp_func_399($a, $b){
                                return (strLen($a) < strLen($b));
                            }
                        }
                        usort($match, 'temp_func_399');
                        foreach($match as $k => $vo){
                            $s[1] = str_replace($vo, '{' . $this -> get_val(substr($vo, 1)) . '}', $s[1]);
                        }
                        $v = $s[1];
                    }else{
                        $v = $s[1];
                    }
                    $p = 'empty(' . $p . ') ? ' . $v . ' : ' . $p;
                    break;
                default: if(function_exists($s[0])){
                        if(count($s) > 2){
                            $args = array_slice($s, 1);
                            if(strpos($mod, '###') !== false){
                                $args = str_replace('###', $p, $args);
                                $p = $s[0] . '(' . implode(',', $args) . ')';
                            }else{
                                $p = $s[0] . '(' . $p . ',' . implode(',', $args) . ')';
                            }
                        }else{
                            $p = $s[0] . '(' . $p . ')';
                        }
                    }
                    break;
                }
            }
        }
        return $p;
    }
    public function make_var($val){
        if(strrpos($val, '.') === false){
            if(isset($this -> _var[$val]) && isset($this -> _patchstack[$val])){
                $val = $this -> _patchstack[$val];
            }
            $val = trim($val, '"');
            $val = trim($val, '\'');
            $p = '$this->_var[\'' . $val . '\']';
            preg_match('~^[a-zA-Z_\x7f-\xff][\w\x7f-\xff]*~', $val, $match);
            $temp = str_replace($match[0], '', $val);
            if($temp){
                $p = '($this->_var[\'' . $match[0] . '\']' . $temp . ')';
            }
        }else{
            $t = explode('.', $val);
            $_var_name = array_shift($t);
            if(isset($this -> _var[$_var_name]) && isset($this -> _patchstack[$_var_name])){
                $_var_name = $this -> _patchstack[$_var_name];
            }
            $_var_name = trim($_var_name, '"');
            $_var_name = trim($_var_name, '\'');
            $p = '$this->_var[\'' . $_var_name . '\']';
            foreach($t AS $val){
                $val = trim($val, '"');
                $val = trim($val, '\'');
                $p .= '[\'' . $val . '\']';
            }
        }
        return $p;
    }
    public function & getTemplateVars($name = null){
        if(empty($name)){
            return $this -> _var;
        }elseif(!empty($this -> _var[$name])){
            return $this -> _var[$name];
        }else{
            $_tmp = null;
            return $_tmp;
        }
    }
    public function get_params($val, $type = 1){
        $pa = $this -> parse_params($val);
        foreach ($pa as $value){
            if (strrpos($value, '=')){
                list($a, $b) = explode('=', str_replace(array(' ', '"', "'", '&quot;'), '', $value));
                if ($b{0} == '$'){
                    if ($type){
                        eval('$para[\'' . $a . '\']=' . $this -> get_val(substr($b, 1)) . ';');
                    }else{
                        $para[$a] = $this -> get_val(substr($b, 1));
                    }
                }else{
                    $para[$a] = $b;
                }
            }
        }
        return $para;
    }
    public function _compile_if_tag($tag_args, $elseif = false){
        preg_match_all('/\-?\d+[\.\d]+|\'[^\'|\s]*\'|"[^"|\s]*"|[\$\w\.]+|!==|===|==|!=|<>|<<|>>|<=|>=|&&|\|\||\(|\)|,|\!|\^|=|&|<|>|~|\||\%|\+|\-|\/|\*|\@|\S/', $tag_args, $match);
        $tokens = $match[0];
        $token_count = array_count_values($tokens);
        if(!empty($token_count['(']) && $token_count['('] != $token_count[')']){
            $this -> _syntax_error('unbalanced parenthesis in if statement', E_USER_ERROR, __FILE__, __LINE__);
        }
        for($i = 0, $count = count($tokens); $i < $count; $i++){
            $token = & $tokens[$i];
            switch(strtolower($token)){
            case 'and': $token = '&&';
                break;
            case 'or': $token = '||';
                break;
            default: if($token[0] == '$'){
                    $token = $this -> get_val(substr($token, 1));
                }
                break;
            }
        }
        if($count == 6 && $tokens[2][0] != '$'){
        }
        $str = $count == 6 ?($tokens[0] . $tokens[1] . $tokens[2] . $tokens[3] . ' ' . $tokens[4] . ' ' . $tokens[5]) : implode(' ', $tokens);
        if($elseif){
            return '<?php elseif(' . $str . '): ?>';
        }else{
            return '<?php if(' . $str . '): ?>';
        }
    }
    public function _compile_foreach_start($tag_args){
        if(stripos($tag_args, ' as ') !== false){
            $tag_args = trim($tag_args);
            $tag_args = str_ireplace(' as ', ' as ', $tag_args);
            $arr = explode(' as ', $tag_args);
            $attrs = $this -> get_params('from=' . $arr[0], 0);
            if(strpos($arr[1], '=>') !== false){
                list($k, $vo) = explode('=>', $arr[1]);
                $attrs['item'] = substr(trim($vo), 1);
                $attrs['key'] = substr(trim($k), 1);
            }else{
                $attrs['item'] = substr(trim($arr[1]), 1);
            }
        }else{
            $attrs = $this -> get_params($tag_args, 0);
        }
        $arg_list = array();
        $from = $attrs['from'];
        if(isset($this -> _var[$attrs['item']]) && !isset($this -> _patchstack[$attrs['item']])){
            $this -> _patchstack[$attrs['item']] = $attrs['item'] . '_' . str_replace(array(' ', '.'), '_', microtime());
            $attrs['item'] = $this -> _patchstack[$attrs['item']];
        }else{
            $this -> _patchstack[$attrs['item']] = $attrs['item'];
        }
        $item = $this -> get_val($attrs['item']);
        if(!empty($attrs['key'])){
            $key = $attrs['key'];
            $key_part = $this -> get_val($key) . ' => ';
        }else{
            $key = null;
            $key_part = '';
        }
        if(!empty($attrs['name'])){
            $name = $attrs['name'];
        }else{
            $name = null;
        }
        $output = '<?php ';
        $output .= "\$_from=$from; if(!is_array(\$_from) && !is_object(\$_from)){ settype(\$_from, 'array'); }; \$this->push_vars('$attrs[key]', '$attrs[item]');";
        if(!empty($name)){
            $foreach_props = "\$this->_foreach['$name']";
            $output .= "{$foreach_props}=array('total' => count(\$_from), 'iteration' => 0);\n";
            $output .= "if({$foreach_props}['total'] > 0):\n";
            $output .= "    foreach(\$_from AS $key_part$item):\n";
            $output .= "        {$foreach_props}['iteration']++;\n";
        }else{
            $output .= "if(count(\$_from)):\n";
            $output .= "    foreach(\$_from AS $key_part$item):\n";
        }
        return $output . '?>';
    }
    public function push_vars($key, $val){
        if(!empty($key)){
            array_push($this -> _temp_key, "\$this->_vars['$key']='" . $this -> _vars[$key] . "';");
        }
        if(!empty($val)){
            array_push($this -> _temp_val, "\$this->_vars['$val']='" . $this -> _vars[$val] . "';");
        }
    }
    public function pop_vars(){
        $key = array_pop($this -> _temp_key);
        $val = array_pop($this -> _temp_val);
        if(!empty($key)){
            eval($key);
        }
    }
    function prefilter_preCompile($source){
        $file_type = strtolower(strrchr($this -> _current_file, '.'));
        $pattern = array('/<!--[^>|\n]*?({.+?})[^<|{|\n]*?-->/', '/<!--[^\n]*?-->/',);
        $replace = array('\1', '',);
        return preg_replace($pattern, $replace, $source);
    }
    public function parse_params($str){
        while(strpos($str, '= ') != 0){
            $str = str_replace('= ', '=', $str);
        } while(strpos($str, ' =') != 0){
            $str = str_replace(' =', '=', $str);
        }
        return explode(' ', trim($str));
    }
    public function _eval($content){
        ob_start();
        eval('?' . '>' . trim($content));
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    public function _require($filename){
        ob_start();
        include $filename;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    public function make_array($arr){
        $out = '';
        foreach($arr AS $key => $val){
            if($val{0} == '$'){
                $out .= $out ? ",'$key'=>$val" : "array('$key'=>$val";
            }else{
                $out .= $out ? ",'$key'=>'$val'" : "array('$key'=>'$val'";
            }
        }
        return $out . ')';
    }
    function get_math_para($val){
        $pa = $this -> parse_params($val);
        foreach($pa AS $value){
            if(strrpos($value, '=')){
                list($a, $b) = explode('=', str_replace(array(' ', '"', "'", '"'), '', $value));
                if(strpos($b, '$') >= 0){
                    $pattern = "/\\$[_a-zA-z]+[a-zA-Z0-9_]*/";
                    preg_match($pattern, $b, $arr);
                    if($arr){
                        foreach($arr as $match){
                            $v = $this -> get_val(substr($match, 1));
                            $b = str_replace($match, $v, $b);
                        }
                    }
                }
            }
        }
        return $b;
    }
    private function write($file, $data, $method = "w"){
        $dir = dirname($file);
        if(!is_dir($dir)){
            mkdir($dir, 0777, true);
        }
        if(is_file($file) && !is_writable($file)){
            return false;
        }
        $result = false;
        if($fp = fopen($file, $method)){
            $startTime = microtime();
            do{
                $canWrite = flock($fp, LOCK_EX | LOCK_NB);
                if(!$canWrite){
                    usleep(round(rand(0, 100) * 1000));
                }
            }while((!$canWrite) && ((microtime() - $startTime) < 1000));
            if($canWrite){
                $result = fwrite($fp, $data);
            }
            fclose($fp);
        }
        return $result;
    }
    public function __call($method, $args){
        $fmethod = preg_replace('~^tag_~', '', $method);
        $fmethod = str_replace('_', '.', $fmethod);
        $plugfile = $this -> plugins_dir . $fmethod . '.php';
        if(is_file($plugfile)){
            include_once($plugfile);
            return $method($args);
        }
    }
}
?>