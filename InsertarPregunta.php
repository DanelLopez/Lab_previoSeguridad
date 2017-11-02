
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      		<span class="right"><a href="layout.html">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout_usu.html'>Inicio</a></spam>
		<span><a href='pregunta.html'>Insertar pregunta</a></spam>
		<span><a href='VerPreguntas.php'>Ver preguntas</a></spam>
		<span><a href='creditos_usu.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<?php  

	//expresiones regulares 
	$no_vacio ="/^\s*$/"; //para campos obligatorios
	$form_pregunta ="/^[\s\S]{10,50}$/"; //pregunta minimo 20
	$form_correo ="/^[a-z]+\d{3}@ikasle\.ehu\.(es|eus)$/"; 
 
	if(preg_match($no_vacio,$_POST['correo']) || preg_match($no_vacio,$_POST['pregunta']) || preg_match($no_vacio,$_POST['correcta']) 
	|| preg_match($no_vacio,$_POST['incorrecta1'])  || preg_match($no_vacio,$_POST['incorrecta2'])  || preg_match($no_vacio,$_POST['incorrecta3']) || preg_match($no_vacio,$_POST['incorrecta3']) || preg_match($no_vacio,$_POST['tema']) || preg_match($no_vacio,$_POST['complejidad'])) 
	{ 
		echo "Error en los datos"; 	
		echo "<p> <a href='InsertarPregunta.php'> Volver a intentar </a>";
    }
	else if (!preg_match($form_correo,$_POST['correo']) || !preg_match($form_pregunta,$_POST['pregunta'])) 
	{ 
		echo "Error en los datos"; 	
		echo "<p> <a href='InsertarPregunta.php'> Volver a intentar </a>";
    } 
	else{
	
		// Se conecta al SGBD 
		$iden = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");
  		
		//comprobamos que hayamos pasado la imagen
		if (!isset($_FILES["archivo"]) || $_FILES["archivo"]["error"] > 0)
		{
		$destino="fotos/image_not_found.png";
		
		}else
		{
		$foto=$_FILES["archivo"]["name"];
		$ruta=$_FILES["archivo"]["tmp_name"];
		$destino="fotos/".$foto;
		copy($ruta,$destino);
		}
			
		$tabla="SELECT * FROM preguntas";
		$Numero = mysqli_num_rows(mysqli_query($iden,$tabla));
		$Numero=$Numero +1;
			//sentencia a ejecutar
			$sql="INSERT INTO preguntas VALUES ('$Numero','$_POST[correo]','$_POST[pregunta]','$_POST[correcta]','$_POST[incorrecta1]','$_POST[incorrecta2]','$_POST[incorrecta3]','$_POST[tema]','$_POST[complejidad]','$destino')";
				if (!mysqli_query($iden ,$sql))
					{
					die('Error: ' . mysqli_error($iden));
					}

		echo "Pregunta añadida";
		echo "<p> <a href='VerPreguntas.php'> Ver preguntas registradas </a>";
		
			
	mysqli_close($iden);
	}	
	?>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
