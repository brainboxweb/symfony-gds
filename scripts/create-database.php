#!/usr/bin/env php
<?php
$pdo = new PDO("mysql:host=mysql;", "admin", "password");
$stmt = $pdo->query("CREATE DATABASE gds");
$stmt->execute();