#!/usr/bin/env php
<?php

$pdo = new PDO("mysql:host=mysql;", "root", "password");

$stmt = $pdo->query("CREATE DATABASE gds");
if ($stmt == false) {
    print_r($pdo->errorInfo());
    return;
}

$stmt->execute();
