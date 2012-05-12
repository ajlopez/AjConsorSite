<?php


/*
 *	Tests
 * for Entity DocumentoConsorcio Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/DocumentoConsorcioFunctions.inc.php');

class DocumentoConsorcioFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testInsert() {
        $result = DocumentoConsorcioInsert('Nombre', 'Descripcion', 'NombreArchivo', 'Uuid', 0, 'Notas');
        $this->assertNotNull($result);
        $this->assertTrue($result > 0);
    }
    
    function testUpdate() {
        $id = DocumentoConsorcioInsert('Nombre', 'Descripcion', 'NombreArchivo', 'Uuid', 0, 'Notas');
        DocumentoConsorcioUpdate($id, 'New Nombre', 'New Descripcion', 'New NombreArchivo', 'New Uuid', 0, 'New Notas');
        $result = DocumentoConsorcioGetById($id);        
        $this->assertNotNull($result);
        $this->assertEqual('New Nombre', $result['Nombre']);
        $this->assertEqual('New NombreArchivo', $result['NombreArchivo']);
        $this->assertEqual('New Uuid', $result['Uuid']);
    }
    
    function testDelete() {
        $id = DocumentoConsorcioInsert('Nombre', 'Descripcion', 'NombreArchivo', 'Uuid', 0, 'Notas');
        $result = DocumentoConsorcioGetById($id);
        $this->assertTrue($result);
        DocumentoConsorcioDelete($id);
        $result = DocumentoConsorcioGetById($id);
        $this->assertFalse($result);
    }

    function testGetById() {
        $id = DocumentoConsorcioInsert('Nombre', 'Descripcion', 'NombreArchivo', 'Uuid', 0, 'Notas');
        $result = DocumentoConsorcioGetById($id);
        $this->assertNotNull($result);
        $this->assertEqual('Nombre', $result['Nombre']);
        $this->assertEqual('NombreArchivo', $result['NombreArchivo']);
        $this->assertEqual('Uuid', $result['Uuid']);
    }

    function testGetByNonexistentId() {
        $id = DocumentoConsorcioInsert('Nombre', 'Descripcion', 'NombreArchivo', 'Uuid', 0, 'Notas');
        $result = DocumentoConsorcioGetById(-1);
        $this->assertFalse($result);
    }
}

?>
