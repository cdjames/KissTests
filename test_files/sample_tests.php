<?php
use function \KissTests\Assertions\assert_equal;
use function \KissTests\Assertions\assert_unequal;
use function \KissTests\Assertions\assert_exception;
use function \KissTests\Assertions\turn_on_assertions;
use \KissTests\TestSuite;
use \KissTests\en_mode;

require_once(dirname(__DIR__, 1)."/kiss_tests.php");

function test_1() : bool {
    return assert_equal(1, 1);
}

function test_2( ):bool {
    return assert_unequal(true, false);
}

function  test_3( )  :  bool { // failure case
    return false;
}

function  test_4( )  :  bool { // failure case using assertion helpers
    try {
        return assert_equal(1, 0);
    } catch (\Throwable $e) {
        // expect error
        return true;
    }
}

function test_5() : bool { // test for an exception
    function throws_exception() {
        throw new Exception("Example Exception");      
    }
    return assert_exception(["throws_exception"], e_msg: "Example Exception");
}

function test_6() : bool { // failure case: tested for wrong exception
    function throws_exception2() {
        throw new Exception("Example Exception");      
    }
    try {
        return assert_exception(["throws_exception2"], e_msg: "Different Exception");
    } catch (\Throwable $e) {
        // expect error
        return true;
    }
}

function test_7() : bool { // failure case: empty array passed for function
    try {
        return assert_exception([], e_msg: "Different Exception");
    } catch (\Throwable $e) {
        // expect error
        return true;
    }
}

function test_8() : bool { // test for an exception; same as test_5 except uses a string
    function throws_exception3() {
        throw new Exception("Example Exception");      
    }
    return assert_exception("throws_exception3", e_msg: "Example Exception");
}
function testes_1() : bool { // this is not picked up by default
    return true;
}

/*** run test suite from current directory 
 * TIP: put this code into its own file if using more than one
 * test file. Change __DIR__ if storing test files in different 
 * directory
 * 
 * TIP 2: remove 'sample' parameter in production; then files 
 * starting with 'tests' will be parsed by default. Of course
 * you can change this to whatever you want
 * ***/
// turn_on_assertions(); // optional depending on your setup

$ts = new TestSuite($mode=en_mode::VRBS, 'sample');
$assembled = $ts->assemble_suite_from_directory(__DIR__);

if($assembled) {
    $ts->run_suite();
    $ts->print_current_results();
}
?>