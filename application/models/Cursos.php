<?php
class Application_Model_Cursos{
    protected $iCursIdCursos;
    protected $vCursNombreCurso;
    protected $tiCursActivo;
    protected $iCursCreado;
    protected $iCursFechaCreacion;
    protected $iCursDescripcion;
    protected $Seccion_iSeccIdSeccion;
    
    public function listarCursosPeriodoActual(){
            $periodoacademico=  new Application_Model_PeriodoAcademico();
            $idperiodoacademicoactual=$periodoacademico->getPeriodoActualId();
  
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $stmt=$dbAdapter->query("Select sec.iSeccIdSeccion, sec.vSeccDescripcion, sec.Grado_iGradoIdGrado , gr.vGradoDescripcion, sec.tiSeccEstado 
                            from seccion sec inner join grado gr on sec.Grado_iGradoIdGrado=gr.iGradoIdGrado
                            inner join periodoacademico pera on gr.PeriodoAcademico_iPerAcaIdPeriodoAcademico=pera.iPerAcaIdPeriodoAcademico
                            where pera.iPerAcaIdPeriodoAcademico='".$idperiodoacademicoactual."' and gr.tiGradoEstado='A' order by sec.Grado_iGradoIdGrado, gr.vGradoDescripcion,  sec.vSeccDescripcion");
             
            $result = $stmt->fetchAll();
            
            if(isset($result)){
                return $result;
            }else{
                return NULL;   
            }
    }
    
    public function crearTablaCursosSimple() {
         $contenido = '
                <table class="data_table">
            <tbody>
            <tr class="row_odd">
                    <th width="18px">&nbsp;</th>
                    <th>Codigo</th>
                    <th>Nombre del Curso</th>
                    <th><a href="">Grado</a></th>
                    <th><a href="">Sección</a></th> 
                    <th width="15px"><a href="">Activo</a></th> 
            </tr>';

            $listacursos = $this->listarCursosPeriodoActual();
            $cont=0;
            foreach ($listacursos as $aux){
                if ($cont % 2){
                    $contenido.='<tr class="row_even">';
                }
                else{
                    $contenido .= '<tr class="row_odd">';
                }
                $contenido.='
                            <td>
                                <input type="checkbox" name="id" value="'.$aux['iSeccIdSeccion'].'">
                            </td>
                            <td>
                                <center>'.$aux['iSeccIdSeccion'].'</center>
                            </td>
                            <td>
                                <center>Nombre del Cursillo</center>
                            </td>
                            <td>
                                <center>'.$aux['vGradoDescripcion'].'</center>
                            </td> 
                            <td>
                                <center>'.$aux['vSeccDescripcion'].'</center>
                            </td>
                            <td>
                                <center>';
                                if($aux['tiSeccEstado']=='A'){
                                    $contenido.=' <a href="/admin/actualizarseccion/?secc='.$aux['iSeccIdSeccion'].'&est=I"><img id="img_4" src="/main/img/icons/16/accept.png" alt="Desactivar" title="Desactivar"></a>';
                                }
                                else{
                                    $contenido.=' <a href="/admin/actualizarseccion/?secc='.$aux['iSeccIdSeccion'].'&est=A"><img id="img_4" src="/main/img/icons/16/error.png" alt="Activar" title="Activar"></a>';
                                }
                $contenido.='
                               </center>
                            </td>
                        </tr>';
            
            $cont++;
        }
        
	$contenido .= '</tbody>
                </table>';
         
        return $contenido;
    }    
	 
    public function registrarCurso($descripcion, $idgrado) {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
             
            $dbAdapter->insert("seccion", array(
                    'vSeccDescripcion'     =>  $descripcion,
                    'tiSeccEstado' => 'A',
                    'Grado_iGradoIdGrado'     =>  $idgrado ));
        }
}