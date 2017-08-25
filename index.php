<?php



$connection=ssh2_connect('172.16.110.84',22);
$user = 'playcrab';
$pass = 'play!@#crab';
ssh2_auth_password($connection,$user,$pass);
$cmd="cd ~/log/error;ls";
$stream = ssh2_exec($connection, $cmd);  
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($stream,true);  
stream_set_blocking($errorStream, true);
$stdout = stream_get_contents($stream);
$stderr = stream_get_contents($errorStream);
$dateDir = explode("\n", $stdout);
$dateDir = array_filter($dateDir, 'is_numeric');
sort($dateDir);
$dir = end($dateDir);
$cmd = "cd {$dir};ls";
$stream = ssh2_exec($connection, $cmd);  
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($stream,true);  
stream_set_blocking($errorStream, true);
$stdout = stream_get_contents($stream);
$stderr = stream_get_contents($errorStream);

echo "stdout: " . $stdout;
echo "stderr: " . $stderr;
// Close the streams        
fclose($errorStream);
fclose($stream);