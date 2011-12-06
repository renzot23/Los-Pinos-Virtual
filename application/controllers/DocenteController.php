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
        
        $this->view->xxx = $postedValue;
        return $this->_redirect('/docente/descripcioncurso/?idcurso='.$this->_request->idcurso.'&opt=ini');
    }
}