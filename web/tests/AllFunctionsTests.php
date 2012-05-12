<?php

/*
 *	All Entity Functions Tests
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');

include_once('./ConsorcioFunctionsTests.php');
include_once('./UnidadFunctionsTests.php');
include_once('./UserFunctionsTests.php');
include_once('./DocumentoConsorcioFunctionsTests.php');

class AllFunctionsTests extends TestSuite {
    function __construct() {
        parent::__construct();
        $this->add(new ConsorcioFunctionsTests());
        $this->add(new UnidadFunctionsTests());
        $this->add(new UserFunctionsTests());
        $this->add(new DocumentoConsorcioFunctionsTests());
    }
}
?>
