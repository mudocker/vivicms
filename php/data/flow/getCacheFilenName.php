<?php
empty($_SERVER['QUERY_STRING'])                                                                                         and getCacheFromIndex($cachefile,$cachetime,$v_config,$from_url);
!empty($_SERVER['QUERY_STRING'])                                                                                        and getCacheAbout($cacheid,$cachefile,$cachetime,$v_config,$server_url);



