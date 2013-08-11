<?php


/*
 *	Tests
 * for Entity Reserva Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/ReservaFunctions.inc.php');

class ReservaFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = ReservaInsert(0, 'DesdeHora', 0, 'HastaHora', 0, 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = ReservaInsert(0, 'DesdeHora', 0, 'HastaHora', 0, 0);
        ReservaUpdate($id, 0, 'NewDh', 0, 'NewHh', 0, 0);
        $result = ReservaGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('NewDh', $result['DesdeHora']);
        $this->assertEqual('NewHh', $result['HastaHora']);
    }
    
    function testDelete() {
        $id = ReservaInsert(0, 'DesdeHora', 0, 'HastaHora', 0, 0);
        $result = ReservaGetById($id);
        $this->assertTrue($result);
        ReservaDelete($id);
        $result = ReservaGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = ReservaInsert(0, 'Desde', 0, 'Hasta', 0, 0);
        $result = ReservaGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Desde', $result['DesdeHora']);
        $this->assertEqual('Hasta', $result['HastaHora']);
    }

    function testGetByNonexistentId() {
        $id = ReservaInsert(0, 'DesdeHora', 0, 'HastaHora', 0, 0);
        $result = ReservaGetById(-1);
        $this->assertFalse($result);
    }
}

?>
