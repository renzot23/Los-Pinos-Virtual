<?php
class Application_Model_Docente extends Zend_Db_Table_Abstract{
    protected $iDocIdDocentes;
    protected $tDocEspecialidad;
    protected $Usuarios_iUsuIdUsuario; 
    
    public function registrarDocente($Usuarios_iUsuIdUsuario,$tDocEspecialidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->insert("docentes", array(
                'Usuarios_iUsuIdUsuario'     =>  $Usuarios_iUsuIdUsuario,
                'tDocEspecialidad'     =>  $tDocEspecialidad
                ));
        $id = $dbAdapter->lastInsertId();
        return $id;
    }

    
}
?>