<?php
    return array(
        'task/([0-9]+)' => 'task/list/$1',
        'task' => 'task/list',
        'admin/login' => 'admin/login',
        'admin/logout' => 'admin/logout',
        'admin/update' => 'admin/update',
        'admin/delete' => 'admin/delete',
        'admin/setstatus/([0-9]+)/([0-9]+)' => 'admin/setstatus/$1/$2',
        'admin' => 'admin/list',
        '' => 'task/index',
    );
?>
