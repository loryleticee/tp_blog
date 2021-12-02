<?php
$domaine = "http://localhost:8888";
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

$error = [
    "message" => "",
    "exist" => false
];

$aACCEPTED_FORM_DATA = [
    "application/json",
    "",
];