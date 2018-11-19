<?php

require_once '../serviceauthentication/serviceauthentication.php';
//require_once '../serviceauthentication/stub_serviceauthentication.php';

function connect_database()
{
    $con = mysqli_connect("sql128.main-hosting.eu",
        "u334971496_cutqa", "cutqa1234", "u334971496_cutqa");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    mysqli_set_charset($con, "utf8");
    return $con;
}

function get_account($account_number)
{
    try {
        $sa = ServiceAuthentication::accountAuthenticationProvider($account_number);
        return $sa;
    } catch (Exception $e) {
        return array("message" => "This account number does not exist in the database");
    }
}

function get_record_by_account_number($account_number)
{
    global $con;
    $query = "SELECT `no` as `accNo`, `name` as `accName`, `balance` as `accBalance` FROM `ACCOUNT` WHERE `no` = '" . $account_number . "';";
    $result = mysqli_query($con, $query);
    return mysqli_fetch_assoc($result);
}

function is_number($i)
{
    $number_array = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    if (in_array($i, $number_array)) {
        return true;
    } else {
        return false;
    }
}

function amount_info($amount)
{
    for ($i = 0; $i < strlen($amount); $i++) {
        if (!is_number($amount[$i])) {
            return array("is_valid" => false, "message" => 'Amount is not a number');
        }
    }

    // amount is a number
    if (intval($amount) > 100000) {
        return array("is_valid" => false, "message" => 'Amount must not more than 100,000');
    } else {
        return array("is_valid" => true, "message" => 'Amount is valid');
    }
}

function account_number_info($account_number)
{
    for ($i = 0; $i < strlen($account_number); $i++) {
        if (!is_number($account_number[$i])) {
            return array("is_valid" => false, "message" => 'Account number is not a number');
        }
    }

    if (strlen($account_number) != 10) {
        return array("is_valid" => false, "message" => 'Account number is not 10 digit');
    }

    if (sizeof(get_account($account_number)) == 0) {
        return array("is_valid" => false, "message" => 'Account number does not exist in database');
    }

    return array("is_valid" => true, "message" => 'Amount is valid');
}

function deposit($account_number, $amount)
{
    global $con;
    $balance = get_record_by_account_number($account_number)['accBalance'];
    $new_balance = $balance + $amount;
    $query = "UPDATE `ACCOUNT` SET `balance` = '" . $new_balance . "' WHERE `no` = '" . $account_number . "';";
    mysqli_query($con, $query);
    return get_record_by_account_number($account_number);
}

function initial()
{
    global $con;
    $con = connect_database();
    $account_number = $_POST['account_number'];
    $amount = $_POST['amount'];

    $amount_info = amount_info($amount);
    $account_number_info = account_number_info($account_number);

    if (!$amount_info['is_valid']) {
        return $amount_info;
    } else {
        if (!$account_number_info['is_valid']) {
            return $account_number_info;
        } else {
            return deposit($account_number, intval($amount));
        }
    }
}

$result = initial();
echo json_encode($result, true);
