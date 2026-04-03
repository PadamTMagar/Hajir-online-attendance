<?php
echo "<pre>";

// Test: run via batch file approach
$bat = 'C:\\xampp\\htdocs\\Hajir\\algorithm\\run_encoding.bat';

// First just test if cmd works
$cmd_test = shell_exec('cmd /c echo "cmd works" 2>&1');
echo "CMD test: " . $cmd_test . "\n";

// Test whoami - see which user Apache runs as
$whoami = shell_exec('cmd /c whoami 2>&1');
echo "Apache runs as: " . $whoami . "\n";

// Test accessing the conda path directly
$access_test = shell_exec('cmd /c dir "C:\\Users\\acer\\anaconda3\\envs\\facereco" 2>&1');
echo "Conda path access:\n" . $access_test . "\n";

echo "</pre>";
?>