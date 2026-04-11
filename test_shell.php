<?php
set_time_limit(300); // 5 minutes
ini_set('max_execution_time', 300);
$bat_test = shell_exec('cmd /c ""C:\\xampp\\htdocs\\Hajir\\algorithm\\run_encoding.bat" "19"" 2>&1');
echo "Batch test output:\n" . $bat_test . "\n";
?>