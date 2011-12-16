<?php
class AlumnoController extends Zend_Controller_Action{
    public function init(){  
        $this->verificarInactividad();
        $mysession = new Zend_Session_Namespace('sesion');
        $mysession->setExpirationSeconds(60*3,'actividad');
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
    public function pruebandoAction(){
        $this->_helper->layout->disableLayout();        
    }
    public function cursosAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';        
    }
    public function agendaAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mi Agenda';        
    }
    public function detallecursoAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';  
        $idcurso = $this->_request->idcurso;
        $this->view->idcurso = $idcurso;
    }
    public function documentosAction(){
        $idcurso = $this->_request->idcurso;
        $iddocpadre = (isset($this->_request->iddocpadre)?$this->_request->iddocpadre:"0");
        
        $this->view->idcurso=$idcurso;
        $this->view->iddocpadre=$iddocpadre;
    }
    public function descripcioncursoAction(){
        $mysession = new Zend_Session_Namespace('sesion');                    
        $mysession->paginaActual = 'Mis Cursos';   
        
        $idcurso = $this->_request->idcurso;
        $opt = $this->_request->opt;
        
        $this->view->idcurso = $idcurso;
        $this->view->opt = $opt;
    }
    public function leccionesAction(){
        $idcurso = $this->_request->idcurso;
        $idcurunidad = $this->_request->idcurunidad;
        $opt = (isset($this->_request->opt)?$this->_request->opt:0);
        $idleccion = (isset($this->_request->idleccion)?$this->_request->idleccion:0);
        
        $this->view->idcurso=$idcurso;
        $this->view->idcurunidad=$idcurunidad;
        $this->view->opt=$opt;
        $this->view->idleccion=$idleccion;
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
    public function verunidadcursoAction(){
        $idcurso = $this->_request->idcur;
        $idunicurso = $this->_request->idunicur;
        
        $this->view->idcurso=$idcurso;
        $this->view->idunicurso=$idunicurso;
    }
    public function evaluacionesAction(){
        $idcurso = $this->_request->idcurso;
        $idcurunidad = $this->_request->idcurunidad;
        $opt = (isset($this->_request->opt)?$this->_request->opt:0);
        $ideval = (isset($this->_request->ideval)?$this->_request->ideval:0);
        
        $this->view->idcurso=$idcurso;
        $this->view->idcurunidad=$idcurunidad;
        $this->view->opt=$opt;
        $this->view->ideval=$ideval;
    }
    
}