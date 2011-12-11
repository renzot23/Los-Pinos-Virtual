<?php
class Application_Model_Leccion extends Zend_Db_Table_Abstract{
    protected $iLeccIdLeccion;
    protected $iLecc_IdCursosUnidades;
    protected $vLeccNombre;
    protected $tLeccMetaDatos;
    protected $iLeccIdLeccionPadre;
    protected $iLeccFechaModificado;
    protected $iLeccFechaExpiracion;
    protected $cLeccEstado;
    
    public function getLeccionbyIdLeccion($idleccion){
         $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM lecciones
                                WHERE iLeccIdLeccion = ".$idleccion);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getLeccionesbyIdCursosUnidad($idcurunidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM lecciones
                                WHERE iLecc_IdCursosUnidades = ".$idcurunidad);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }

    public function registrarLeccion($idcurunidad,$nombreleccion,$datosleccion,$idleccpadre,$iLeccFechaExpiracion){
         $dbAdapter = Zend_Db_Table::getDefaultAdapter();
         $dbAdapter->insert("lecciones", array(
                'iLecc_IdCursosUnidades'     =>  $idcurunidad,
                'vLeccNombre'     =>  $nombreleccion,
                'tLeccMetaDatos'     =>  $datosleccion,
                'iLeccIdLeccionPadre' =>  $idleccpadre,
                'iLeccFechaCreacion' =>  time(),
                'iLeccFechaModificado' =>  time(),
                'iLeccFechaExpiracion' =>  $iLeccFechaExpiracion,
                'cLeccEstado' =>  "A"
            ));
    }
}
?>