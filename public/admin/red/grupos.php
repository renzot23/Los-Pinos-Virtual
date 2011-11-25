<?php
$includePath = dirname(__FILE__);
$main_configuration_file_path = $includePath.'/main/inc/configuration.php';
$already_installed = false;
if (file_exists($main_configuration_file_path)) {
    require_once $main_configuration_file_path;
    $already_installed = true;
} else {
    $_configuration = array();
}

/* INICIO head */
$head='<head>';
$head.='<title>Colegio Los Pinos - Los Pinos</title>';
$head.='<style type="text/css" media="screen, projection">';
$head.='@import "http://localhost:3001/tesiss/main/css/base.css";@import "http://localhost:3001/tesiss/main/css/chamilo/default.css";@import "http://localhost:3001/tesiss/main/css/chamilo/course.css";';
$head.='</style>';
$head.='<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery.min.js" type="text/javascript" ></script>';
$head.='<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/chosen/chosen.jquery.min.js" type="text/javascript" ></script>';
$head.='<script src="http://localhost:3001/tesiss/main/inc/lib/javascript/thickbox.js" type="text/javascript" ></script>';
$head.='<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/thickbox.css" type="text/css" media="projection, screen" />';
$head.='<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/chosen/chosen.css" type="text/css" media="projection, screen" />';
$head.='<script src= "http://localhost:3001/tesiss/main/inc/lib/javascript/jquery.menu.js" type="text/javascript"></script>';
$head.='</head>';
echo $head;
/* FIN Head*/
?>
<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery-ui/smoothness/jquery-ui-1.8.16.custom.css" type="text/css">
<script type="text/javascript" src="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery-ui/smoothness/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" href="http://localhost:3001/tesiss/main/inc/lib/javascript/jquery-ui/default.css" type="text/css">
<script type="text/javascript"> 
var counter_image = 1;
function remove_image_form(id_elem1) {
    var elem1 = document.getElementById(id_elem1);
    elem1.parentNode.removeChild(elem1);
    counter_image--;
    var filepaths = document.getElementById("filepaths");
    if (filepaths.childNodes.length < 3) {
        var link_attach = document.getElementById("link-more-attach");
        if (link_attach) {
            link_attach.innerHTML='<a href="javascript://" onclick="return add_image_form()">Agregar otro fichero</a>';
        }
    }
}

function add_image_form() {
    // Multiple filepaths for image form
    var filepaths = document.getElementById("filepaths");
    if (document.getElementById("filepath_"+counter_image)) {
        counter_image = counter_image + 1;
    }  else {
        counter_image = counter_image;
    }
    var elem1 = document.createElement("div");
    elem1.setAttribute("id","filepath_"+counter_image);
    filepaths.appendChild(elem1);
    id_elem1 = "filepath_"+counter_image;
    id_elem1 = "'"+id_elem1+"'";
    document.getElementById("filepath_"+counter_image).innerHTML = "<input type=\"file\" name=\"attach_"+counter_image+"\"  size=\"20\" />&nbsp;<a href=\"javascript:remove_image_form("+id_elem1+")\"><img src=\"http://localhost:3001/tesiss/main/img/delete.gif\"></a>";

    if (filepaths.childNodes.length == 3) {
        var link_attach = document.getElementById("link-more-attach");
        if (link_attach) {
            link_attach.innerHTML="";
        }
    }
}

function validate_text_empty (str,msg) {
    var str = str.replace(/^\s*|\s*$/g,"");
    if (str.length == 0) {
        alert(msg);
        return true;
    }
}

jQuery(document).ready(function() {
    /* Binds a tab id in the url */
    $("#tab_browse").bind("tabsselect", function(event, ui) {
        window.location.href=ui.tab;
    });
    $("#tabs").tabs();
    $("#tab_browse").tabs();

    var valor = "topic_";

    $(".head").click(function() {
                $(this).next().next().slideToggle("fast");
                image_clicked = $("#" + this.id + " img").attr("src");
                image_clicked_info = image_clicked.split("/");
                image_real_clicked = image_clicked_info[image_clicked_info.length-1];
                image_path = image_clicked.split("img");
                current_path = image_path[0]+"img/";
                if (image_real_clicked == "div_show.gif") {
                    current_path = current_path+"div_hide.gif";
                    $("#" + this.id + " img").attr("src", current_path);
                } else {
                    current_path = current_path+"div_show.gif";
                    $("#" + this.id + " img").attr("src", current_path)
                }
                return false;
            }).next().next().hide();

   // anchor for current topic
   if (valor) {
        $("#"+valor).show();
        window.location = document.URL+"#"+valor;
   }

});
</script>

<?php

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
			<a href="http://localhost:3001/tesiss/index.php">
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
				<a href="http://localhost:3001/tesiss/index.php?logout=logout&amp;uid=3" target="_top">
					<span>Salir (josuete)</span>
				</a>
			</li>
		</ul>
		<ul>
			<li>
				<a href="alumno_principal.php" target="_top">
					<span id="tab_active">P�gina principal</span>
				</a>
			</li>
			<li>
				<a href="alumno_cursos.php" target="_top">
					<span id="tab_active">Mis cursos</span>
				</a>
			</li>
			<li>
				<a href="alumno_agenda.php" target="_top">
					<span id="tab_active">Mi agenda</span>
				</a>
			</li>
			<li>
				<a href="alumno_progreso.php" target="_top">
					<span id="tab_active">Mi progreso</span>
				</a>
			</li>
			<li id="current">
				<a href="alumno_redsocial.php" target="_top">
					<span id="tab_active">Red social</span>
				</a>
			</li>
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
				<span>Mi Red Social</span>
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
		<div id="social-content">
			<div id="social-content-left">
				<div class="social-menu">
					<script type="text/javascript">      
						function show_icon_edit(element_html) { 
							ident="#edit_image";
							$(ident).show();
						}       
						
						function hide_icon_edit(element_html)  {
							ident="#edit_image";
							$(ident).hide();
						}               
					</script>
					<div class="social-content-image">
						<div class="social-background-content" onmouseout="hide_icon_edit()" onmouseover="show_icon_edit()">
							<center>
								<img src="http://localhost:3001/tesiss/main/img/unknown.jpg?4e9625d0543fc" width="110px">
								<div id="edit_image" class="hidden_message" style="display: none; ">
									<a href="">Editar perfil</a>
								</div>
							</center>
						</div>
					</div>
					<div align="center" class="social-menu-title">
						<span class="social-menu-text1">Men�</span>
					</div>
					<div>
						<ul>
							<li>
								<a href="../alumno_redsocial.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/home.png" alt="Principal" title="Principal">
									<span class="social-menu-text4">Principal</span>
								</a>
							</li>
							<li>
								<a href="mensajes.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/instant_message.png" alt="Mensajes" title="Mensajes">
									<span class="social-menu-text4">Mensajes</span>
								</a>
							</li>
							<li>
								<a href="invitaciones.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/invitation.png" alt="Invitaciones" title="Invitaciones">
									<span class="social-menu-text4">Invitaciones</span>
								</a>
							</li>
							<li>
								<a href="perfilcompartido.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/my_shared_profile.png" alt="Mi perfil compartido" title="Mi perfil compartido">
									<span class="social-menu-text4">Mi perfil compartido</span>
								</a>
							</li>
							<li>
								<a href="amigos.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/friend.png" alt="Amigos" title="Amigos">
									<span class="social-menu-text4">Amigos</span>
								</a>
							</li>
							<li>
								<a href="grupos.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/group.png" alt="Grupos" title="Grupos">
									<span class="social-menu-text-active">Grupos</span>
								</a>
							</li>
							<li>
								<a href="buscar.php">
									<img hspace="6" src="http://localhost:3001/tesiss/main/img/zoom.png" alt="Buscar" title="Buscar">
									<span class="social-menu-text4">Buscar</span>
								</a>
							</li>
							<li>
								<a href="archivos.php">
								<img hspace="6" src="http://localhost:3001/tesiss/main/img/icons/16/briefcase.png" alt="Mis archivos" title="Mis archivos">
								<span class="social-menu-text4">Mis archivos</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="social-content-right">
				<div id="tab_browse" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
					<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
						<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
							<a href="#tab_browse-1"> Mis grupos</a>
						</li>
						<li class="ui-state-default ui-corner-top">
							<a href="#tab_browse-2"> Lo �ltimo</a>
						</li>
						<li class="ui-state-default ui-corner-top">
							<a href="#tab_browse-3"> Populares</a>
						</li>
					</ul>
					<div id="tab_browse-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
						<p> </p>
					</div>
					<div id="tab_browse-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
						<p> </p>
					</div>
					<div id="tab_browse-3" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
						<p> </p>
					</div>
				</div>
			</div>
		</div>
		<div class="clear">&nbsp;
		</div>
	</div> 
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