<?php 
// List all files in current dir
echo ShellWrap::ls();

// Touch a file to create it
ShellWrap::touch('file.html');

// Remove file
ShellWrap::rm('file.html');

// Remove file again (this fails, and throws an exception because the file doesn't exist)

try {
	ShellWrap::rm('file.html');
} catch (Exception $e) {
	echo 'Caught failing ShellWrap::rm() call';
}

// Checkout a branch in git
ShellWrap::git('checkout', 'master');

// You can also pipe the output of one command, into another
// This downloads example.com through cURL, follows location, then pipes through grep to 
// filter for 'html'
echo ShellWrap::grep('html', ShellWrap::curl('http://example.com', array(
	'location' => true
)));

// This throws an exception, as 'invalidoption' is not a valid argument
try {
	echo ShellWrap::ls(array('invalidoption' => true));
} catch (Exception $e) {
	echo 'Caught failing ShellWrap::ls() call';
}

?>