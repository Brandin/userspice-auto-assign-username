<?php

function AutoAssignUsername_GenerateUsername($fname, $lname, $email)
{
    $db = DB::getInstance();
    $settings = $db->query('SELECT * FROM settings')->first();
    $preusername = $fname[0];
    $preusername .= $lname;
    $preusername = strtolower(clean($preusername));
    $preQ = $db->query('SELECT username FROM users WHERE username = ?', [$preusername]);
    if (!$db->error()) {
        $preQCount = $preQ->count();
    } else {
        return false;
    }
    if ($preQCount == 0) {
        return $preusername;
    }
    $preusername = $fname;
    $preusername .= $lname[0];
    $preusername = strtolower(clean($preusername));
    $preQ = $db->query('SELECT username FROM users WHERE username = ?', [$preusername]);
    if (!$db->error()) {
        $preQCount = $preQ->count();
    } else {
        return false;
    }
    if ($preQCount == 0) {
        return $preusername;
    }

    return $email;
}
