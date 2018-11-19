<?php

require_once 'DBConnection.php';

class ServiceAuthentication
{

    public static function accountAuthenticationProvider(string $account_number): array
    {
        if ($account_number == '1111111111') return array('accNo' => '1111111111', 'accName' => 'Dennis Ritchie', 'Balance' => '1000000');
        if ($account_number == '2222222222') return array('accNo' => '2222222222', 'accName' => 'Larry Page', 'Balance' => '99');
        if ($account_number == '3333333333') return array('accNo' => '3333333333', 'accName' => 'Bill Gates', 'Balance' => '1234');
        if ($account_number == '4444444444') return array('accNo' => '4444444444', 'accName' => 'Linus Torvalds', 'Balance' => '888');
        if ($account_number == '0123456789') return array('accNo' => '0123456789', 'accName' => 'Satoshi Nakamoto', 'Balance' => '0');
        return array("message" => "This account number does not exist in the database");
    }
}
