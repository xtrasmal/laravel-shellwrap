ShellWrap
==================

What is it?
------------------

It's a beautiful way to use powerful Linux/Unix tools in PHP. Easily and logically pipe commands together,
capture errors as PHP Exceptions and use a simple yet powerful syntax. Works with any command line tool automagically.

Features 
------------------

* Flexible and sexy syntax.
* Exceptions are thrown if the executable returns an error.
* Paths to binaries are automatically resolved.
* All arguments are properly escaped.

Examples
------------------

```php
<?php 

// List all files in current dir
echo ShellWrap::ls();

// Checkout a branch in git
ShellWrap::git('checkout', 'master');

// You can also pipe the output of one command, into another
// This downloads example.com through cURL, follows location, then pipes through grep to 
// filter for 'html'
echo ShellWrap::grep('html', sh::curl('http://example.com', array(
	'location' => true
)));

// Touch a file to create it
ShellWrap::touch('file.html');

// Remove file
ShellWrap::rm('file.html');

// Remove file again (this fails, and throws an exception because the file doesn't exist)

try {
	ShellWrap::rm('file.html');
} catch (Exception $e) {
	echo 'Caught failing sh::rm() call';
}


// This throws an exception, as 'invalidoption' is not a valid argument
try {
	echo ShellWrap::ls(array('invalidoption' => true));
} catch (Exception $e) {
	echo 'Caught failing sh::ls() call';
}

// Commands can be written multiple ways
ShellWrap::git('reset', array('hard' => true), 'HEAD');
ShellWrap::git('reset', '--hard', 'HEAD');
ShellWrap::git(array('reset', '--hard', 'HEAD'));

// Arguments passed in are automatically escaped, this expands to
// date --date '2012-10-10 10:00:00'
echo ShellWrap::date(array(
	'date' => '2012-10-10 10:00:00'
));

// If arg keys are one letter, is assumes one dash prefixing it
// date -d '2012-10-10 10:00:00'
echo ShellWrap::date(array(
	'd' => '2012-10-10 10:00:00'
));


?>
```

Install
------------------
```php
	php artisan bundle:install shellwrap
```
Open bundles.php
``php
   'shellwrap'    => array(
        auto        => true
    )
```

Acknowledgements
--------------------
Inspired by the Python project [sh by Andrew Moffat](http://pypi.python.org/pypi/sh)
Original source Shellwrap[MrRio/shellwrap](https://github.com/MrRio/shellwrap)