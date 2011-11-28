<?php
class Application_Model_Apoderado extends Zend_Db_Table_Abstract{ 
    protected $iApodIdApoderado;
    protected $Usuarios_iUsuIdUsuario;
    
    public function registrarApoderado($Usuarios_iUsuIdUsuario){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->insert("apoderados", array(
                'Usuarios_iUsuIdUsuario'     =>  $Usuarios_iUsuIdUsuario));
        $id = $dbAdapter->lastInsertId();
        return $id;
    }
}
?>