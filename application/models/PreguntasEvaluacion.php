<?php
class Application_Model_PreguntasEvaluacion extends Zend_Db_Table_Abstract{
    protected $iPreEva_IdPreguntaEvaluacion;
    protected $iEva_IdEvaluacion;
    protected $tPreEvaPregunta;
    protected $cPreEvaTipoPregunta;
    protected $iPreEvaRpta1;
    protected $iPreEvaRpta2;
    protected $iPreEvaRpta3;
    protected $iPreEvaRpta4;
    protected $iPreEvaRptaCorrecta;
    protected $cPreEvaEstado;
    
    public function getPreguntaEvaluacionbyIdPreEvaluacion($idpreeva){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM preguntas_evaluacion
                                WHERE iPreEva_IdPreguntaEvaluacion = ".$idpreeva);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getPreguntasEvaluacionbyIdEvaluacion($idevaluacion){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM preguntas_evaluacion
                                WHERE iEva_IdEvaluacion = ".$idevaluacion);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function registrarPreguntaEvaluacion($idevaluacion,$pregunta,$tipopregunta,$rpta1,$rpta2,$rpta3,$rpta4,$rptacorrecta){
         $dbAdapter = Zend_Db_Table::getDefaultAdapter();
         $dbAdapter->insert("preguntas_evaluacion", array(
                'iEva_IdEvaluacion'     =>  $idevaluacion,
                'tPreEvaPregunta'     =>  $pregunta,
                'cPreEvaTipoPregunta' =>  $tipopregunta,
                'iPreEvaRpta1' =>  $rpta1,
                'iPreEvaRpta2' =>  $rpta2,
                'iPreEvaRpta3' =>  $rpta3,
                'iPreEvaRpta4' =>  $rpta4,
                'iPreEvaRptaCorrecta' =>  $rptacorrecta,
                'cPreEvaEstado' => "A"
            ));
    }

    
}
?>
