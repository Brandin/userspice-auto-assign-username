<?php

global $validation, $settings, $fname, $lname, $email;
$validation->check($_POST, [
  'fname' => [
        'display' => lang('GEN_FNAME'),
        'required' => true,
        'min' => 1,
        'max' => 60,
  ],
  'lname' => [
        'display' => lang('GEN_LNAME'),
        'required' => true,
        'min' => 1,
        'max' => 60,
  ],
  'email' => [
        'display' => lang('GEN_EMAIL'),
        'required' => true,
        'valid_email' => true,
        'unique' => 'users',
        'min' => 5,
        'max' => 100,
  ],

  'password' => [
        'display' => lang('GEN_PASS'),
        'required' => true,
        'min' => $settings->min_pw,
        'max' => $settings->max_pw,
  ],
  'confirm' => [
        'display' => lang('PW_CONF'),
        'required' => true,
        'matches' => 'password',
  ],
]);

$username = AutoAssignUsername_GenerateUsername($fname, $lname, $email);
