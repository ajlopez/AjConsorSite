<?php


/*
 *	Tests
 * for Entity Consorcio Functions
 *
 */

$Page->Prefix = '../';

include_once($Page->Prefix . 'simpletest/autorun.php');
include_once($Page->Prefix . 'includes/ConsorcioFunctions.inc.php');
include_once($Page->Prefix . 'includes/UnidadFunctions.inc.php');
include_once($Page->Prefix . 'includes/DocumentoConsorcioFunctions.inc.php');
include_once($Page->Prefix . 'includes/ConsorcioFunctionsEx.inc.php');

class ConsorcioFunctionsTests extends UnitTestCase {
    function setup() {
        DbConnect();
        DbTransactionBegin();
    }
    
    function tearDown() {
        DbTransactionRollback();
        DbDisconnect();
    }
    
    function testDeleteWithUnidades() {
        $id = ConsorcioInsert('Nombre', 'Codigo', 'Domicilio', 'Ciudad', 'Provincia', 'Pais', 'Notas');
        $result = ConsorcioGetById($id);
        $this->assertTrue($result);
        
        $iduni = UnidadInsert('Nombre', 'Codigo', 'Piso', 'Numero', $id, 'Notas');
        $resultuni = UnidadGetById($id);
        $this->assertTrue($resultuni);
        
        ConsorcioDeleteEx($id);
        $result = ConsorcioGetById($id);
        $this->assertFalse($result);
        $resultuni = UnidadGetById($iduni);
        $this->assertFalse($resultuni);
    }
    
    function testDeleteWithDocumentos() {
        $id = ConsorcioInsert('Nombre', 'Codigo', 'Domicilio', 'Ciudad', 'Provincia', 'Pais', 'Notas');
        $result = ConsorcioGetById($id);
        $this->assertTrue($result);
        
        copy('./test.txt', '../files/012345.txt');        
        copy('./test.txt', '../files/012346.txt');

        $iddoc = DocumentoConsorcioInsert('Nombre', 'Descripcion', 'test.txt', '012345', $id, 'Notas');
        $resultdoc = DocumentoConsorcioGetById($iddoc);
        $this->assertNotNull($resultdoc);

        $iddoc2 = DocumentoConsorcioInsert('Nombre', 'Descripcion', 'test.txt', '012346', $id, 'Notas');
        $resultdoc2 = DocumentoConsorcioGetById($iddoc2);
        $this->assertNotNull($resultdoc2);
        
        $iduni = UnidadInsert('Nombre', 'Codigo', 'Piso', 'Numero', $id, 'Notas');
        $resultuni = UnidadGetById($id);
        $this->assertTrue($resultuni);
        
        ConsorcioDeleteEx($id);
        $result = ConsorcioGetById($id);
        $this->assertFalse($result);
        
        $resultuni = UnidadGetById($iduni);
        $this->assertFalse($resultuni);
        
        $resultdoc = DocumentoConsorcioGetById($iddoc);
        $this->assertFalse($resultdoc);
        
        $resultdoc2 = DocumentoConsorcioGetById($iddoc2);
        $this->assertFalse($resultdoc2);
        
        $this->assertFalse(file_exists('../files/012345.txt'));
        $this->assertFalse(file_exists('../files/012346.txt'));
    }
}

?>
