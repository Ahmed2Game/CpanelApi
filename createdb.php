<?php
require_once "Cpanel.php";
$username = 'admin';
$password = 'demo123';
$api = new CPANEL(['url' => 'https://server.demo.com:2083', 'username' => $username, 'password' => $password]);

$createDB = $api->makeRequest('MysqlFE', 'createdb', ['db' => $username . '_db']);

if ($createDB->cpanelresult->event->result == 1) {
    $AddUserToDb = $api->makeRequest('MysqlFE', 'setdbuserprivileges', ['privileges' => 'ALL PRIVILEGES', 'db' => $username . '_db', 'dbuser' => $username . '_user']);
    if ($AddUserToDb->cpanelresult->event->result == 1) {
        $flash_message = array('success', "تم اضافة السيرفر بنجاح");
    } else {
        $flash_message = array('error', $AddUserToDb->cpanelresult->event->reason);
    }
} else {
    $flash_message = array('error', $createDB->cpanelresult->event->reason);
}
?>