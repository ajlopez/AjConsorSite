<?php


/*
 *	Tests
 * for Entity Consorcio Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/ConsorcioFunctions.inc.php');

class ConsorcioFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = ConsorcioInsert('Nombre', 'Codigo', 'Domicilio', 'Ciudad', 'Provincia', 'Pais', 'Notas');
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = ConsorcioInsert('Nombre', 'Codigo', 'Domicilio', 'Ciudad', 'Provincia', 'Pais', 'Notas');
        ConsorcioUpdate($id, 'New Nombre', 'New Codigo', 'New Domicilio', 'New Ciudad', 'New Provincia', 'New Pais', 'New Notas');
        $result = ConsorcioGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
        $this->assertEqual('New Codigo', $result['Codigo']);
        $this->assertEqual('New Domicilio', $result['Domicilio']);
        $this->assertEqual('New Ciudad', $result['Ciudad']);
        $this->assertEqual('New Provincia', $result['Provincia']);
        $this->assertEqual('New Pais', $result['Pais']);
    }
    
    function testDelete() {
        $id = ConsorcioInsert('Nombre', 'Codigo', 'Domicilio', 'Ciudad', 'Provincia', 'Pais', 'Notas');
        $result = ConsorcioGetById($id);
        $this->assertTrue($result);
        ConsorcioDelete($id);
        $result = ConsorcioGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = ConsorcioInsert('Nombre', 'Codigo', 'Domicilio', 'Ciudad', 'Provincia', 'Pais', 'Notas');
        $result = ConsorcioGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
        $this->assertEqual('Codigo', $result['Codigo']);
        $this->assertEqual('Domicilio', $result['Domicilio']);
        $this->assertEqual('Ciudad', $result['Ciudad']);
        $this->assertEqual('Provincia', $result['Provincia']);
        $this->assertEqual('Pais', $result['Pais']);
    }

    function testGetByNonexistentId() {
        $id = ConsorcioInsert('Nombre', 'Codigo', 'Domicilio', 'Ciudad', 'Provincia', 'Pais', 'Notas');
        $result = ConsorcioGetById(-1);
        $this->assertFalse($result);
    }
}

?>
