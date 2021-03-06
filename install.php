<?php

require_once 'init.php';
if (in_array($user->data()->id, $master_account)) {
    $db = DB::getInstance();
    include 'plugin_info.php';

    $check = $db->query('SELECT * FROM us_plugins WHERE plugin = ?', [$plugin_name])->count();
    if ($check > 0) {
        err($plugin_name.' has already been installed!');
    } else {
        $fields = [
            'plugin' => $plugin_name,
            'status' => 'installed',
        ];
        $db->insert('us_plugins', $fields);
        if (!$db->error()) {
            err($plugin_name.' installed');
            logger($user->data()->id, 'USPlugins', $plugin_name.' installed');
        } else {
            err($plugin_name.' was not installed');
            logger($user->data()->id, 'USPlugins', 'Failed to to install plugin, Error: '.$db->errorString());
        }
    }

    $hooks = [];
    $hooks['joinAttempt']['body'] = 'hooks/username_replace.php';
    $hooks['join.php']['bottom'] = 'hooks/username_field_removal.php';
    registerHooks($hooks, $plugin_name);
}
