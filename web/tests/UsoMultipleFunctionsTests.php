<?php


/*
 *	Tests
 * for Entity UsoMultiple Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/UsoMultipleFunctions.inc.php');

class UsoMultipleFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = UsoMultipleInsert('Nombre', 'Codigo', 0, 'Notas');
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = UsoMultipleInsert('Nombre', 'Codigo', 0, 'Notas');
        UsoMultipleUpdate($id, 'New Nombre', 'New Codigo', 0, 'New Notas');
        $result = UsoMultipleGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
        $this->assertEqual('New Codigo', $result['Codigo']);
    }
    
    function testDelete() {
        $id = UsoMultipleInsert('Nombre', 'Codigo', 0, 'Notas');
        $result = UsoMultipleGetById($id);
        $this->assertTrue($result);
        UsoMultipleDelete($id);
        $result = UsoMultipleGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = UsoMultipleInsert('Nombre', 'Codigo', 0, 'Notas');
        $result = UsoMultipleGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
        $this->assertEqual('Codigo', $result['Codigo']);
    }

    function testGetByNonexistentId() {
        $id = UsoMultipleInsert('Nombre', 'Codigo', 0, 'Notas');
        $result = UsoMultipleGetById(-1);
        $this->assertFalse($result);
    }
}

?>
