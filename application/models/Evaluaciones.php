<?php
class Application_Model_Evaluaciones extends Zend_Db_Table_Abstract{
    protected $iEvaIdEvaluacion;
    protected $iEva_IdCursosUnidades;
    protected $iEvaDescripcion;
    protected $iEvaPuntMin;
    protected $iEvaFechaCreacion;
    protected $iEvaFechaExamen;
    protected $iEvaEstado;
    
    public function getEvaluacionbyIdEvaluacion($idevaluacion){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM evaluaciones
                                WHERE iEvaIdEvaluacion = ".$idevaluacion);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getEvaluacionesbyIdCursosUnidad($idcurunidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM evaluaciones
                                WHERE iEva_IdCursosUnidades = ".$idcurunidad);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function registrarEvaluacion($idcurunidad,$descripcion,$puntmin,$iEvaFechaExamen){
         $dbAdapter = Zend_Db_Table::getDefaultAdapter();
         $dbAdapter->insert("evaluaciones", array(
                'iEva_IdCursosUnidades'     =>  $idcurunidad,
                'iEvaDescripcion'     =>  $descripcion,
                'iEvaPuntMin' =>  $puntmin,
                'iEvaFechaCreacion' =>  time(),
                'iEvaFechaExamen' =>  $iEvaFechaExamen,
                'iEvaEstado' => "A"
            ));
    }
}
?>