<?php


/*
 *	Tests
 * for Entity Unidad Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/UnidadFunctions.inc.php');

class UnidadFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = UnidadInsert('Nombre', 'Codigo', 'Piso', 'Numero', 0, 'Notas');
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = UnidadInsert('Nombre', 'Codigo', 'Piso', 'Numero', 0, 'Notas');
        UnidadUpdate($id, 'New Nombre', 'New Codigo', 'New Piso', 'New Numero', 0, 'New Notas');
        $result = UnidadGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
        $this->assertEqual('New Codigo', $result['Codigo']);
        $this->assertEqual('New Piso', $result['Piso']);
        $this->assertEqual('New Numero', $result['Numero']);
    }
    
    function testDelete() {
        $id = UnidadInsert('Nombre', 'Codigo', 'Piso', 'Numero', 0, 'Notas');
        $result = UnidadGetById($id);
        $this->assertTrue($result);
        UnidadDelete($id);
        $result = UnidadGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = UnidadInsert('Nombre', 'Codigo', 'Piso', 'Numero', 0, 'Notas');
        $result = UnidadGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
        $this->assertEqual('Codigo', $result['Codigo']);
        $this->assertEqual('Piso', $result['Piso']);
        $this->assertEqual('Numero', $result['Numero']);
    }

    function testGetByNonexistentId() {
        $id = UnidadInsert('Nombre', 'Codigo', 'Piso', 'Numero', 0, 'Notas');
        $result = UnidadGetById(-1);
        $this->assertFalse($result);
    }
}

?>
