<?php


/*
 *	Tests
 * for Entity UsuarioUnidad Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/UsuarioUnidadFunctions.inc.php');

class UsuarioUnidadFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = UsuarioUnidadInsert(0, 0, 0);
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = UsuarioUnidadInsert(0, 0, 0);
        UsuarioUnidadUpdate($id, 0, 0, 0);
        $result = UsuarioUnidadGetById($id);        
        $this->assertNotNull($result);
    }
    
    function testDelete() {
        $id = UsuarioUnidadInsert(0, 0, 0);
        $result = UsuarioUnidadGetById($id);
        $this->assertTrue($result);
        UsuarioUnidadDelete($id);
        $result = UsuarioUnidadGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = UsuarioUnidadInsert(0, 0, 0);
        $result = UsuarioUnidadGetById($id);
        $this->assertNotNull($result);
    }

    function testGetByNonexistentId() {
        $id = UsuarioUnidadInsert(0, 0, 0);
        $result = UsuarioUnidadGetById(-1);
        $this->assertFalse($result);
    }
}

?>
