<?php
namespace md\data\rules;
class getImgDomain{

    /**
     * getImgDomain constructor.
     */
    public function __construct()
    {
        $caiji_config=&$GLOBALS['caiji_config'];

        $caiji_config['resdomain'] = $caiji_config['resdomain']?$caiji_config['resdomain']:$caiji_config['other_imgurl'];
    }
}


