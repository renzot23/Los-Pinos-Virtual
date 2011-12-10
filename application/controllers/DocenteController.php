<?php
class DocenteController extends Zend_Controller_Action{
    public function init(){  
        $this->verificarInactividad();
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->setExpirationSeconds(60*5,'actividad');
        /* Initialize action controller here */
        
    } 
    
    public function verificarInactividad(){
        $usuario= new Application_Model_Usuario();
        if ($usuario->getInactivo()){
            $usuario->logout();
            return $this->_redirect('/');
        }
    }
    
    public function principalAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Pagina Principal';
    }
    
    public function logoutAction(){
        $usuario= new Application_Model_Usuario();
        $usuario->logout();
        return $this->_redirect('/');
    }

    public function cursosAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';        
    }
    
    public function detallecursoAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';  
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso = $idcurso;
    }
    
    public function descripcioncursoAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';   
        
        $idcurso = $this->_request->idcurso;
        $opt = $this->_request->opt;
        
        $this->view->idcurso = $idcurso;
        $this->view->opt = $opt;
    }

    public function agregardetallecursoAction(){
        $detcurso = new Application_Model_DetalleCurso();
        
        $idcurso = $this->_request->idcurso;
        $opt = $this->_request->opt;
        
        $postArray = &$_POST;
        //$postArray = $this->_request->editor1;
        foreach ($postArray as $sForm => $value){
            if (get_magic_quotes_gpc()){
               $postedValue = htmlspecialchars(stripslashes($value)) ;
            }
            else{
               $postedValue = htmlspecialchars($value);
            }
//            $postedValue=htmlentities(addslashes($postedValue));
            ($postedValue==""?$detcurso->eliminarDetalle($idcurso, $opt):$detcurso->insertarDetalle($idcurso, $opt, $postedValue));
        }
        
//        $this->view->xxx = $postedValue;
        return $this->_redirect('/docente/descripcioncurso/?idcurso='.$this->_request->idcurso.'&opt=ini');
    }
    
    public function editarunidadesAction(){
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso=$idcurso;
        $cursosunidad = new Application_Model_CursoUnidad();
        $arraycursosunidad = $cursosunidad->listarCursoUnidad($idcurso);
        
        if($arraycursosunidad==0){
            $cursosunidad->registrarUnidadesCurso($idcurso);            
        }
    }
    
    public function editarunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
    
        
    }
    
    public function agregarunidadcursoAction(){
        $idcurso = $this->_request->idcurso;
        $idunicurso = $this->_request->idunicurso;
        $titulounidad = $this->getRequest()->getParam('txtunidad');
        
        $cursounidad = new Application_Model_CursoUnidad();
        $cursounidad->setTituloUnidadCurso($idunicurso,$titulounidad);
        
        return $this->_redirect('docente/editarunidades?idcurso='.$idcurso);
    }
    
    public function verunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
    }
    
    public function detalleunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        $opt = $this->_request->opt;
        
        if(isset($this->_request->idcom)){
            $idcom=$this->_request->idcom;
            $this->view->idcom=$idcom;
        }
        if(isset($this->_request->idcap)){
            $idcap=$this->_request->idcap;
            $this->view->idcap=$idcap;
        }
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
        $this->view->opt=$opt;
        
    }
    
    public function registrardetalleunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        $opt = $this->_request->opt;
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
        $this->view->opt=$opt;
        
        if(isset($idcurso) && isset($idunicurso) && isset($opt)){
            $descripcion = $this->getRequest()->getParam('txtdescripcion');
            switch($opt){
                case 'com':
                    $competencia = new Application_Model_Competencias();
                    $titulo = $this->getRequest()->getParam('txttitulo');
                    $competencia->registrarCompetencia($idunicurso, $descripcion,$titulo);
                    break;
                case 'cap':
                    $idcompetencia = $this->_request->idcom;
                    $actitud = $this->getRequest()->getParam('txtactitud');                     
                    $capacidad = new Application_Model_Capacidades();
                    $capacidad->registrarCapacidad($idcompetencia, $descripcion, $actitud);
                    break;
                case 'con':
                    $idcap = $this->_request->idcap;                   
                    $conocimiento = new Application_Model_Conocimiento();
                    $conocimiento->registrarConocimiento($idcap, $descripcion);
                    break;
                case 'ind':
                    $idcap = $this->_request->idcap;                   
                    $indicadores = new Application_Model_Indicadores();
                    $indicadores->registrarIndicador($idcap, $descripcion);
                    break;
            }
           return $this->_redirect('docente/verunidadcurso?idcur='.$idcurso.'&idunicur='.$idunicurso);
        }
            
        
    }

    public function documentosAction(){
        $idcurso = $this->_request->idcurso;
        $iddocpadre = (isset($this->_request->iddocpadre)?$this->_request->iddocpadre:"0");
        
        $this->view->idcurso=$idcurso;
        
        $this->view->iddocpadre=$iddocpadre;
        
        $documentos = new Application_Model_Documentos();
        $listadocumentos = $documentos->getDocumentosbyIdCurso($idcurso);
        
        
        
        if($listadocumentos==0){
            mkdir("main/documentos/".$idcurso,0777);
            $ruta = "main/documentos/".$idcurso;
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de Videos", "Videos",0);
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de Audios", "Audios",0);
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de Imagenes", "Imagenes",0);
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de los Usuarios", "Carpeta de los Usuarios",0);
            $documentos->registrarCarpeta($idcurso, NULL, $ruta, "Carpeta de Lecciones", "Lecciones",0);
        }
        
    }
}