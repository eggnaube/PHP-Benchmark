PHP Benchmark Script
====================
The PHP Benchmark Script consists of the following three parts:

* User Interface (for normal users): This is an easy UI for the `PHP_Benchmark` class.
* `PHP_Benchmark` class (for PHP developers): This is the class the UI is based on and with it you can benchmark your PHP webserver with the 7 tests you saw in the UI.
* `Function_Benchmark` class (for more advanced PHP developers): This is a class to compare one or more functions in the matter of performance.

## User Interface (UI)
This is the visible part of the PHP Benchmark Script. With it you can easily use the PHP Benchmark class knowing whatsoever about programming PHP.

### Usage
To use the UI, simply copy all files to your server and access the index of your PHP Benchmark Script directory.
Simply click on 'Start' and all tests will be automatically executed 5 times. 

Click on 'Clear table' to remove the results from the table.

### Coming features

* Export of the results

### More

* [Known issues](https://github.com/Philipp15b/PHP-Benchmark/issues/labels/UI "Known issues")

## PHP Benchmark class
This is the core of the PHP Benchmark Script. It contains the tests and some functions to do them. 

To use this class, create an instance of the `PHP_Benchmark` class and you can use the following methods:

* `doTests()`: do all 7 tests and return their results in an array.
* `test1()`: String operations test
* `test2()`: Encryption and hashes test
* `test3()`: Date functions and calculations test
* `test4()`: Image manipulation via GD test
* `test5()`: Array functions test
* `test6()`: Filesystem operations test
* `test7()`: Object handling test

All the tests (except `doTests()`) will return a float that is the time the test needed.

### Coming features

* More options in the functions

### More

* [Known issues](https://github.com/Philipp15b/PHP-Benchmark/issues/labels/PHP_Benchmark%20class "Known issues")

## Function Benchmark class
This class allows you to compare one or more functions in the matter of performance.
Because there is no documentation yet, you are still forced to look at the source code.

### Coming features

nothing planned.

### More

* [Known issues](https://github.com/Philipp15b/PHP-Benchmark/issues/labels/Function_Benchmark%20class "Known issues")

## License
<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a>

<span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"><a href="https://github.com/Philipp15b/PHP-Benchmark">PHP Benchmark</a></span> by <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Philipp Schroer</span> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.
