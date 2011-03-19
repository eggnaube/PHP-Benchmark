PHP Benchmark Script
====================
The PHP Benchmark Script consists of the following three parts:

* User Interface (for normal users): This is what you will see if you access the index.php file.
* PHP Benchmark class (for PHP developers): This is the class the UI is based on and with it you can benchmark your PHP webserver with the 7 tests you saw in the UI.
* Function Benchmark class (for advanced PHP developers): This will be (not ready yet) a class to compare one or more functions in the matter of performance.

It can measure the following things:

* String operations
* Encryption and hashes
* Date functions and calculations
* Image manipulation via GD
* Array functions
* Filesystem operations
* Object handling

and with the Function Benchmark class you will be soon able to compare function performance.

## User Interface (UI)
This is the visible part of the PHP Benchmark Script. With it you can easily use the PHP Benchmark class knowing whatsoever about programming PHP.

### Usage
To use the UI, simply copy all files in your download to your server and access the index of your PHP Benchmark Script directory.
Simply click on 'Start' and all tests will be automatically executed 5 times. 

Click on 'Clear table' to remove the results from the table.

### Known issues

* If you click on the 'Start' button many times after another, too many tests will be executed in a too low time frame. This will cause an error in test 6 (Filesystem).

### Coming features

* Average times at the bottom of the results table
* Settings via UI
* and more...

## PHP Benchmark class
This is the core of the PHP Benchmark Script. It contains the tests and some functions to do them. 
To use this class, construct an instance of the class `PHP_Benchmark` and you can use the following functions:

* doTests() -> do all 7 tests and return their results in an array.
* test1(), test2(), test3() and so on -> execute the tests separately. They will return the time needed as a float.

### Coming features

* More options in the functions

## User Interface (UI)
This is the visible part of the PHP Benchmark Script. With it you can easily use the PHP Benchmark class knowing whatsoever about programming PHP.

### Usage
To use the UI, simply copy all files in your download to your server and access the index of your PHP Benchmark Script directory.
Simply click on 'Start' and all tests will be automatically executed 5 times. 

Click on 'Clear table' to remove the results from the table.

### Known issues

* If you click on the 'Start' button many times after another, too many tests will be executed in a too low time frame. This will cause an error in test 6 (Filesystem).

### Coming features

* Average times at the bottom of the results table
* Settings via UI
* and more...

## PHP Benchmark class
This is the core of the PHP Benchmark Script. It contains the tests and some functions to do them. 
To use this class, construct an instance of the class `PHP_Benchmark` and you can use the following functions:

* doTests() -> do all 7 tests and return their results in an array.
* test1(), test2(), test3() and so on -> execute the tests separately. They will return the time needed as a float.

### Coming features

* More options in the functions

## Function Benchmark class
This class is (until now) empty, but there will be some functions soon.

## License
All parts of this are until now licensed under the GPL.
