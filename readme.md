# KissTests ('Keep It Simple, Stupid' Tests)
A super simple testing "framework" for PHP

## Use case
You want to run some unit tests without installing a bunch of frameworks. Keep it simple!

## Prerequisites
If using [assertion helper functions](#assert), make sure assertions are turned on in your php.ini:

    zend.assertions = 1

## Recommended setup (submodule)
- create a `tests` folder next to your `src` folder
- create a `submodules` folder next to your `src` folder
- go to submodules folder
- grab KissTests from github using `git submodule add https://github.com/cdjames/KissTests`
- create x number of `test/test_*.php` files containing your tests
    - be sure to include your source file(s)!
- add the following to one of the test files or a separate file:

```
<?php
use function \KissTests\Assertions\assert_equal;
use function \KissTests\Assertions\assert_unequal;
use function \KissTests\Assertions\assert_exception;
use function \KissTests\Assertions\turn_on_assertions;
use \KissTests\TestSuite;
use \KissTests\en_mode;


// your tests


turn_on_assertions(); // may be optional depending on your setup

$ts = new TestSuite($mode=en_mode::VRBS);
$ts_assembled = $ts->assemble_suite_from_directory(__DIR__);

if($ts_assembled) {
    $ts->run_suite();
    $ts->print_current_results();
}
?>
```
- run the tests: `php path/to/above/code.php`

## Test format
See [`sample_test.php`](test_files/sample_test.php) for a good example. Basically your test functions just need to return a boolean, but you can use the included assertion functions for convenience and added documentation.

## <a name='assert'>Assertion functions</a>
I recommend using these for more information.

### `assert_equal`
A wrapper around `assert($left === $right)` with an automatic failure message

### `assert_unequal`
A wrapper around `assert($left !== $right)` with an automatic failure message

### `assert_exception`
Lets you test if your code throws an Exception. You need to pass the file location (or empty string if function in the same file), the fully qualified function name, and any arguments (or an empty array). Pass an Exception message in the final argument if you want to test for a particular Exception, otherwise any thrown Exception will cause the test to pass.