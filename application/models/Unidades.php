<?php
class Application_Model_Unidades extends Zend_Db_Table_Abstract{ 
    public function existeUnidades(){
        $periodoacademico = new Application_Model_PeriodoAcademico();
        $idperiodoactual = $periodoacademico->getPeriodoActualId();
        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("SELECT *
                                FROM unidades
                                WHERE IdPeriodoAcademico = ".$idperiodoactual);

        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }else{
            return "0";   
        }
    }
    
    public function getUltimaUnidadActualRegistrada(){
        $periodoacademico = new Application_Model_PeriodoAcademico();
        $idperiodoactual = $periodoacademico->getPeriodoActualId();
        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("
                                SELECT MAX(IdUnidad) As id
                                FROM unidades
                                WHERE IdPeriodoAcademico = ".$idperiodoactual);

        $result = $stmt->fetchAll();

        if($result[0]['id']==NULL){
            return "0";
        }else{
            return $result;
        }
    }

    public function getUnidad($idunidad){
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $stmt=$dbAdapter->query("SELECT *
                                FROM unidades
                                WHERE IdUnidad = ".$idunidad);

        $result = $stmt->fetchAll();

        if(sizeof($result)>0){
            return $result;
        }else{
            return "0";   
        }
    }

    public function registrarUnidad($descripcion,$fechainicio,$fechafin){
        $periodoacademico = new Application_Model_PeriodoAcademico();
        $idperiodoactual=$periodoacademico->getPeriodoActualId();
        
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $dbAdapter->insert("unidades", array(
                'vUniDescripcion'     =>  $descripcion,
                'dFechaInicio'     =>  $fechainicio,
                'dFechaFin'     =>  $fechafin,
                'IdPeriodoAcademico'     =>  $idperiodoactual,
               ));
    }
}