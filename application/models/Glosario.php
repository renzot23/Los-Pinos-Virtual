<?php
class Application_Model_Glosario extends Zend_Db_Table_Abstract{
    protected $iGlosIdGlosario;
    protected $iGlos_iCursIdCursos;
    protected $vGlosTermino;
    protected $tGlosDefinicion;
    protected $cGlosEstado;
    
    public function getGlosariobyIdGlosario($idglosario){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM glosario
                                WHERE iGlosIdGlosario = ".$idglosario);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function getGlosarioCursobyIdCurso($idcurso){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT *
                                FROM glosario
                                WHERE iGlos_iCursIdCursos = ".$idcurso);
        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }
        else{
            return "0";   
        } 
    }
    
    public function registrarPreguntaEvaluacion($idcurso,$termino,$definicion){
         $dbAdapter = Zend_Db_Table::getDefaultAdapter();
         $dbAdapter->insert("glosario", array(
                'iGlos_iCursIdCursos'     =>  $idcurso,
                'vGlosTermino'     =>  $termino,
                'tGlosDefinicion' =>  $definicion,
                'cGlosEstado' => "A"
            ));
    }

    
}
?>
