<?php
// Specify the path to the Python executable and the script
$python = "C:\\Path\\To\\Python\\python.exe";
$script = "C:\\Path\\To\\Your\\Script\\script.py";

// Prepare the command with arguments
$command = escapeshellcmd("$python $script");

// Execute the command and capture the output
$output = shell_exec($command . ' 2>&1');

// Display the output
echo $output;
?>
