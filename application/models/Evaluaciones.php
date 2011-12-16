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
    
    public function registrarEvaluacion($idcurunidad,$descripcion,$puntmin,$tiempo,$iEvaFechaExamen){
         $dbAdapter = Zend_Db_Table::getDefaultAdapter();
         $dbAdapter->insert("evaluaciones", array(
                'iEva_IdCursosUnidades'     =>  $idcurunidad,
                'iEvaDescripcion'     =>  $descripcion,
                'iEvaPuntMin' =>  $puntmin,
                'iEvaTiempo' =>  $tiempo,
                'iEvaFechaCreacion' =>  time(),
                'iEvaFechaExamen' =>  $iEvaFechaExamen,
                'iEvaEstado' => "A"
            ));
    }

    public function getEvaluacionesPendientes($idcurso){
        $fechaactual = time();
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM evaluaciones eval
                                INNER JOIN cursos_unidades curuni ON curuni.IdCursosUnidades = eval.iEva_IdCursosUnidades
                                INNER JOIN cursos cur ON cur.iCursIdCursos = curuni.Cursos_iCursIdCursos
                                WHERE cur.iCursIdCursos=".$idcurso." AND iEvaFechaExamen <".$fechaactual);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getPreguntasxEvaluacion($ideval){
        $fechaactual = time();
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM preguntas_evaluacion
                                WHERE iEva_IdEvaluacion=".$ideval." AND cPreEvaEstado ='A'");
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
}
?>