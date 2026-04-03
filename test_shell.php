<?php
echo "<pre>";

$python = 'C:\\Users\\acer\\anaconda3\\envs\\facereco\\python.exe';
$script = 'C:\\xampp\\htdocs\\Hajir\\algorithm\\generate_encoding.py';

// Test 1: check python version in facereco env
$ver = shell_exec('"' . $python . '" --version 2>&1');
echo "Facereco Python version: " . $ver . "\n";

// Test 2: check if face_recognition is installed in that env
$imp = shell_exec('"' . $python . '" -c "import face_recognition; print(\'face_recognition OK\')" 2>&1');
echo "face_recognition import: " . $imp . "\n";

// Test 3: check if mysql connector is installed
$db = shell_exec('"' . $python . '" -c "import mysql.connector; print(\'mysql OK\')" 2>&1');
echo "mysql.connector import: " . $db . "\n";

// Test 4: check if db_config is found
$dbc = shell_exec('"' . $python . '" -c "import sys; sys.path.insert(0,\'C:\\\\xampp\\\\htdocs\\\\Hajir\\\\algorithm\'); import db_config; print(\'db_config OK\')" 2>&1');
echo "db_config import: " . $dbc . "\n";

// Test 5: run actual script with user_id 19
$run = shell_exec('"' . $python . '" "' . $script . '" "19" 2>&1');
echo "Script output:\n" . $run . "\n";

echo "</pre>";
?>