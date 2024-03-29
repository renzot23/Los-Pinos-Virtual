<?php
require ("../main/inc/configuration.php");
require_once '../main/inc/admin/portal_admin.class.php';

$portal = new PortalAdmin();

session_start();
if(!isset($_SESSION['login'])) {
  header("location:". $_configuration['root_web']); 
  exit();
}

/* INICIO head */
$head='<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">';
$head.='<head>';
$head.='<title>'.$_configuration['web_title'].'</title>';
$head.='<style type="text/css" media="screen, projection">';
$head.='/*<![CDATA[*/';
$head.='@import "'.$_configuration['root_web'].'main/css/base.css";@import "'.$_configuration['root_web'].'main/css/tesis/default.css";@import "'.$_configuration['root_web'].'main/css/tesis/course.css";/*]]>*/';
$head.='</style>';
$head.='<style type="text/css" media="print">';
$head.='/*<![CDATA[*/';
$head.='@import "http://localhost:3001/chamilo/main/css/chamilo/print.css";/*]]>*/';
$head.='</style>';
$head.='<script src="'.$_configuration['root_web'].'main/inc/lib/javascript/jquery.min.js" type="text/javascript" ></script>';
$head.='<script src="'.$_configuration['root_web'].'main/inc/lib/javascript/chosen/chosen.jquery.min.js" type="text/javascript" ></script>';
$head.='<script src="'.$_configuration['root_web'].'main/inc/lib/javascript/thickbox.js" type="text/javascript" ></script>';
$head.='<link rel="stylesheet" href="'.$_configuration['root_web'].'main/inc/lib/javascript/thickbox.css" type="text/css" media="projection, screen" />';
$head.='<link rel="stylesheet" href="'.$_configuration['root_web'].'main/inc/lib/javascript/chosen/chosen.css" type="text/css" media="projection, screen" />';
$head.='<script src= "'.$_configuration['root_web'].'main/inc/lib/javascript/jquery.menu.js" type="text/javascript"></script>';
$head.='<script type="text/javascript">
//<![CDATA[
// This is a patch for the "__flash__removeCallback" bug, see FS#4378.
if ( ( navigator.userAgent.toLowerCase().indexOf("msie") != -1 ) && ( navigator.userAgent.toLowerCase().indexOf( "opera" ) == -1 ) ) {
    window.attachEvent( "onunload", function() {
            window["__flash__removeCallback"] = function ( instance, name ) {
                try {
                    if ( instance ) {
                        instance[name] = null ;
                    }
                } catch ( flashEx ) {
                }
            } ;
	});
}
//]]>
</script>';
$head.='<script type="text/javascript" src="http://localhost:3001/chamilo/main/inc/lib/javascript/bxslider/jquery.bxSlider.min.js"></script>
<link rel="stylesheet" href="http://localhost:3001/chamilo/main/inc/lib/javascript/bxslider/bx_styles/bx_styles.css" type="text/css">
<script type="text/javascript">
$(document).ready(function(){
	$("#slider").bxSlider({
		infiniteLoop	: true,
		auto			: true,
		pager			: true,
		autoHover		: true,
		pause			: 10000
	});
});
</script>
<link rel="stylesheet" type="text/css" href="http://localhost:3001/chamilo/main/inc/lib/javascript/dtree/dtree.css" />
<script src="http://localhost:3001/chamilo/main/inc/lib/javascript/dtree/dtree.js" type="text/javascript"></script>
<link rel="shortcut icon" href="http://localhost:3001/tesis/favicon.ico" type="image/x-icon" />';
$head.='</head>';

echo $head;
/* FIN Head*/

/* INICIO EBody */
echo '<body>';
//Verificar archivo de Configuraci�n

/*Inicio EWrapper*/
echo '<div id="wrapper">';

/*Inicio ENavegacion*/
echo '<ul id="navigation">';
$report ='<li class="report">';
$report .='<a href="#" target="_blank" style="margin-left: 50px; ">';
$report .='<img src="http://localhost:3001/tesiss/main/img/bug.large.png" style="vertical-align: middle;" alt="Comunicar un error" title="Dejar un Mensaje"></a></li>';
echo $report;
echo '</ul>';
/*Fin ENavegacion*/

/*Inicio EHeader*/?>
<div id="header">
	<div id="header1">
		<div id="top_corner">
		</div>
		<div id="logo">
			<a href=<?php echo $_configuration['root_web']; ?>>
			<img title="INE Los Pinos - Los Pinos" src="http://localhost:3001/tesiss/main/css/chamilo/images/header-logo.png" alt="INE Los Pinos - Los Pinos">
			</a>
		</div>
		<div id="plugin-header">
		</div>
	</div>
	<div id="header2">
		<div id="Header2Right">
			<ul>
				<li>
				</li>
				<li>
					<a href="http://localhost:3001/tesiss/whoisonline.php" target="_top" title="Usuarios en l�nea">
						<img width="13px" src="http://localhost:3001/tesiss/main/img/members.gif" title="Usuarios en l�nea"> 1
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="header3">
		<ul id="logout">
			<li>
				<a href="" target="_top">
					<span>Salir (josuete)</span>
				</a>
			</li>
		</ul>
		<ul>
		<?php
				$portal->menu();
			?>
			
		</ul>
	</div>
	<div id="header4">
		<ul class="bread">
			<li>
				<a class="home" href="http://localhost:3001/tesiss/">
					<img align="middle" src="http://localhost:3001/tesiss/main/css/home.png" alt="P�gina principal" title="P�gina principal">
				</a>
			</li>
			<li>
				<span>Mis Cursos</span>
			</li>
		</ul>
	</div>
	<div class="clear">
	</div>
</div>
<?php
/*Fin EHeader*/

/*Inicio EMain*/
?>

<div id="main">
	<div id="submain">
		<div class="maincontent" id="maincontent">
			<div id="plugin-mycourses_main">
			</div>
			<div class="userportal-course-item">
				<div style="float:right;">
					<a id="document_preview_1_0" class="document_preview" href="#">
						<img align="absmiddle" src="http://localhost:3001/chamilo/main/img/icons/22/folder.png" alt="Documentos" title="Documentos">
					</a>
					<a href="#">
						<img align="absmiddle" src="http://localhost:3001/chamilo/main/img/icons/22/edit.png" alt="Editar" title="Editar">
					</a>
					<div id="document_result_1_0" class="document_preview_container" style="display: none; "> 
					</div>
				</div>
				<div style="float: left; margin-right: 10px;">
					<a href="#">
						<img width="48px" src="http://localhost:3001/chamilo/main/img/blackboard.png" alt="Curso" title="Curso">
					</a>
				</div>
				<span class="userportal-course-item-title">
					<!--<a href="http://localhost:3001/chamilo/courses/002/?id_session=0"> Matematica</a>-->
					<a href="admin_cursosmate.php"> Matematica</a>
				</span><br>Tello, Renzo&nbsp;
				<a href="#">
					<img title="-- Documento -- Desde su �ltima visita: visible (26/10/2011 19:08)." src="http://localhost:3001/chamilo/main/img/folder_document.gif" border="0" align="absbottom">
				</a>&nbsp;
			</div>
		</div>
		<div id="menu-wrapper">
			<div id="menu" class="menu">
				<div class="menusection  ">
					<span class="menusectioncaption">Perfil</span>
					<div id="social_widget">
						<div id="social_widget_image">
							<a href="http://localhost:3001/tesiss/main/auth/profile.php">
								<img title="Editar perfil" src="http://localhost:3001/tesiss/main/img/unknown.jpg" width="90" height="90" border="1">
							</a>
						</div>
					</div>
					<div class="clear">
					</div>
					<div class="message-content">
						<ul class="menulist">
							<li>
								<a href="#" class="message-body">Bandeja de entrada </a>
							</li>
							<li>
								<a href="#" class="message-body">Redactar </a>
							</li>
							<li>
								<a href="#" class="message-body">Invitaciones pendientes  </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="menu" id="menu">
				<div class="menusection">
					<span class="menusectioncaption">Usuario</span>
						<ul class="menulist">
							<li>
								<a href="#">Crear un curso</a>
							</li>
							<li>
								<a href="#">Cat�logo de cursos</a>
							</li>
								<a href="#"> Ordenar mis cursos</a>
							<li>
								<a href="#">Historial</a>
							</li>
						</ul>
								
				</div>
			</div>
		</div>
		<div class="clear">&nbsp;
		</div>
	</div> 
	<div class="push"></div>
</div>

<?php
/*Fin EMain*/
echo '</div>';
/*Fin EWrapper*/

/*Inicio Footer*/
?>
<div id="footer">
	<div id="bottom_corner">
	</div>
	<div class="copyright">
		<div align="right">Responsable : 
			<a href="mailto:administrados@lospinos.com" name="clickable_email_link">Tello, Vinces</a>
		</div>
		<div align="right">Plataforma
			<a href="http://www.lospinos.com/" target="_blank">Elearning v. 1.0.0.1</a>� 2011
		</div>
	</div>
	<div class="footer_emails">
		<div id="plugin-footer">
		</div><br>
		<div style="clear:both">
		</div>
	</div>
</div>
<?php
/*Fin Footer*/

echo '<script>
$(document).ready( function() {
    $(".chzn-select").chosen();
});
</script>';
$body .= '</body>';
echo $body;
/* FIN Ebody */
?>