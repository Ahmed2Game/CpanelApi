<?php
require_once "Cpanel.php";
$username = 'admin';
$password = 'demo123';
 $api = new CPANEL(['url' => 'https://server.demo.com:2083', 'username' => $username, 'password' => $password]);
                        
    $Creatdb = $api->makeRequest('MysqlFE', 'createdb', ['db' => $username.'_db']);
                        
                        if($Creatdb->cpanelresult->event->result == 1)
                        {
                            $AddUserTodb = $api->makeRequest('MysqlFE', 'setdbuserprivileges', ['privileges' => 'ALL PRIVILEGES','db' => $username.'_db','dbuser' => $username.'_user']);
                            if ($AddUserTodb->cpanelresult->event->result == 1)
                            {
                                $flash_message = array('success', "تم اضافة السيرفر بنجاح");
                            }
                            else
                            {
                                $flash_message = array('error', $AddUserTodb->cpanelresult->event->reason);
                            }
                        }
                        else
                        {
                            $flash_message = array('error', $Creatdb->cpanelresult->event->reason);
                        }
?>
