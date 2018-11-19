<?php

require_once 'DBConnection.php';

class ServiceAuthentication
{

    public static function accountAuthenticationProvider(string $account_number): array
    {
        if ($account_number == '1111111110') return array('accNo' => '1111111110', 'accName' => 'Tom Jerry', 'accBalance' => '1000');
        if ($account_number == '2222222222') return array('accNo' => '2222222222', 'accName' => 'Larry Page', 'accBalance' => '99');
        if ($account_number == '3333333333') return array('accNo' => '3333333333', 'accName' => 'Bill Gates', 'accBalance' => '1234');
        if ($account_number == '4444444444') return array('accNo' => '4444444444', 'accName' => 'Linus Torvalds', 'accBalance' => '888');
        if ($account_number == '0123456789') return array('accNo' => '0123456789', 'accName' => 'Satoshi Nakamoto', 'accBalance' => '0');
        return array("message" => "This account number does not exist in the database");
    }
}
