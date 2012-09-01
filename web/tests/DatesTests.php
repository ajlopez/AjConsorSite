<?php


/*
 *	Tests
 * for Dates functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'ajfwk/Dates.inc.php');

class DatesTests extends UnitTestCase {
    function setup() {
    }
    
    function tearDown() {
    }
    
    function testDayName() {
        $result = DateToWeekDayName('2012-09-01');
        $this->assertEqual('Saturday', $result);
    }
    
    function testMonday() {
        $result = DateToMonday('2012-09-01');
        $this->assertEqual('2012-08-27', $result);
    }
    
    function testSameMonday() {
        $result = DateToMonday('2012-09-03');
        $this->assertEqual('2012-09-03', $result);
    }
    
    function testAddOneDay() {
        $result = DateAddDays('2012-09-03', 1);
        $this->assertEqual('2012-09-04', $result);
    }
    
    function testAddTwoDays() {
        $result = DateAddDays('2012-09-03', 2);
        $this->assertEqual('2012-09-05', $result);
    }
    
    function testAddMinusTwoDays() {
        $result = DateAddDays('2012-09-03', -2);
        $this->assertEqual('2012-09-01', $result);
    }
    
    function testAddZeroDays() {
        $result = DateAddDays('2012-09-03', 0);
        $this->assertEqual('2012-09-03', $result);
    }
}

?>
