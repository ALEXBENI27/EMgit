<?php
    require_once 'conexion.php';
    session_start();

    //Valida que el usuario este logueado, además de que otros usuarios no puedan acceder a partes del sistema que no deberían poder acceder.

    $codigo = $_SESSION['codigo'];
    $query = mysqli_query($conexion, "SELECT * FROM persona WHERE codigo = '$codigo'"); 
    $usuario = mysqli_fetch_assoc($query);

    if($usuario['cargo'] != "maestro"){
      session_destroy();
      header("Location: login.php");
    }

?>
<!DOCTYPE html><html class="menu">
<html ng-app="EM-SCHOOL">

  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
    <meta name="google" value="notranslate"/>
    <title>Maestro</title>
    <link rel="stylesheet" href="../css/calificaciones.css">
    <link rel="stylesheet" href="../css/FormAdmin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="../img/icono.png">
  </head>

  <body>
    
    <!--Header-->
    <header class="header">
      
    </header> 
    <!--Fin del Header-->
    
    <div class="sidebar">
      <div class="logo_content">
        <div class="logo">
          <i class='bx bxs-school'></i>
          <div class="logo_name">EM-School</div>
        </div>
        <i class='bx bx-menu' id="btn" ></i>
      </div>
      <ul class="nav_list">
        <li>
          <a href="inicioMaestro.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Usuario</span>
          </a>
          <span class="tooltip">Usuario</span>
        </li>
        <li>
          <a href="calificacionesMaestro.php">
            <i class='bx bx-book'></i>
            <span class="links_name">Calificaciones</span>
          </a>
          <span class="tooltip">Calificaciones</span>
        </li>
        <li>
          <a href="registroMateriasMaestro.php">
            <i class='bx bxs-folder'></i>
            <span class="links_name">Registro</span>
          </a>
          <span class="tooltip">Registro</span>
        </li>
        <li>
          <a href="configuracionMaestro.php">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Configuración</span>
          </a>
          <span class="tooltip">Configuración</span>
        </li>
      </ul>
      <div class="profile_content">
        <div class="profile">
          <div class="profile_details">
            <!--<img src="profile.jpg" alt="">-->
            <div class="name_job">
              <div class="name">Prem Shahi</div>
              <div class="job">Web Designer</div>
            </div>
          </div>
          <a href="logout.php">
          <i class='bx bx-log-out' id="log_out" ></i>
          </a>
        </div>
      </div>
    </div>

    <div class="home_content">
      <div class="text">
      <?php 
        $valor = $_SESSION['codigo'];
        $query = mysqli_query($conexion, "SELECT * FROM persona WHERE codigo = '$valor'"); 
        $usuario = mysqli_fetch_assoc($query);
        ?>
        </div>
        <h1>Eventos</h1>
        <h2>
            En este apartado podrá crear eventos para realizar en la escuela. <br>
            Solo puede crear un evento a la vez, por lo cual maneje bien sus eventos.
        </h2>
        <br>
        <?php $consulta = mysqli_query($conexion, "SELECT * FROM eventos;"); ?>
        <?php $tabla = 0; 
            if ($tabla == 0){?>
            <table class="container">
              <thead>
              <th>Nombre del evento</th>
              <th>Descripción del evento</th>
              <th>Código del docente encargado</th>
              <th>Fecha del evento (A/M/D)</th>
              <th>Hora del evento</th>
              <th>Modificar evento</th>
              <th>Eliminar evento</th>
            </thead>
            <p>
              hola putin
            </p>
            <tbody>
              <?php $tabla = 1;
              }
              ?> 
                  <?php $contador = 0;
                  //if ($calificacion['mostrar_calificacion'] == 1){
                    //for($i = 0 ; $i < sizeof($calificacion) ; $i++ ){echo ($calificacion['mostrar_calificacion']);}
                    while($calificacion = mysqli_fetch_array($consulta)){
                      //echo ($calificacion['mostrar_calificacion']); ?>
                    <tr>
                      <?php if ($calificacion['id_docente'] == $usuario['codigo']){ ?>
                      <?php $contador++;?>
                      <td><?php echo $calificacion['nombre_evento']?></td>
                      <td><?php echo $calificacion['descripcion']?></td>
                      <td><?php echo $calificacion['id_docente']?></td>
                      <td><?php echo $calificacion['fecha']?></td>
                      <td><?php echo $calificacion['hora']?></td>
                      <form action="modificarEvento.php" method="post">
                        <input type="hidden" name="id_evento" value="<?php echo $calificacion['nombre_evento']?>">
                        <input type="hidden" name="descripcion" value="<?php echo $calificacion['descripcion']?>">
                        <input type="hidden" name="id_docente" value="<?php echo $calificacion['id_docente']?>">
                        <input type="hidden" name="fecha" value="<?php echo $calificacion['fecha']?>">
                        <input type="hidden" name="hora" value="<?php echo $calificacion['hora']?>">
                        <td><button type="submit" value="enviar">Modificar</button></td>
                      </form>
                      <form action="eliminarEvento.php" method="post">
                        <input type="hidden" name="id_evento" value="<?php echo $calificacion['nombre_evento']?>">
                        <input type="hidden" name="descripcion" value="<?php echo $calificacion['descripcion']?>">
                        <input type="hidden" name="id_docente" value="<?php echo $calificacion['id_docente']?>">
                        <input type="hidden" name="fecha" value="<?php echo $calificacion['fecha']?>">
                        <input type="hidden" name="hora" value="<?php echo $calificacion['hora']?>">
                        <td><button type="submit" value="enviar">Eliminar</button></td>
                      </form>
                    </tr>
                    <?php
                      }else if($calificacion['id_docente'] != $usuario['codigo']){ ?>
                        <td><?php echo $calificacion['nombre_evento']?></td>
                        <td><?php echo $calificacion['descripcion']?></td>
                        <td><?php echo $calificacion['id_docente']?></td>
                        <td><?php echo $calificacion['fecha']?></td>
                        <td><?php echo $calificacion['hora']?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php }else if($contador == 0)echo("Aún no hay eventos registrados");$contador = 1;   
                    }
                    ?>
                </tbody>
              </table>

        <form action="crearEvento.php" method="post">
          <label>Nombre para el evento</label>
          <input type="input" name="nombre_evento" placeholder ="Nombre del evento">
          <br>
          <label>Descripción breve del evento</label>
          <input type="input" name="descripcion" placeholder="Descripción del evento">
          <br>
          <label>Fecha del evento</label>
          <input type="date" name="fecha_evento">
          <br>
          <label>Hora del evento</label>
          <input type="time" name="hora_evento">
          <br>
          <input type="submit" value="Enviar">
          <input type="hidden" name = "codigo" value =" <?php echo $valor ?>"> 
          <br><br><br>
        </form>

        
        <?php while($dato = mysqli_fetch_array($consulta)){ ?>
          
          <table class="container">
            <thead>
              <th>Nombre del evento</th>
              <th>Código del evento</th>
              <th>Descripción del evento</th>
              <th>Código del docente encargado</th>
              <th>Fecha del evento (A/M/D)</th>
              <th>Hora del evento</th>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $dato['nombre_evento'];?></td>
                <td><?php echo $dato['id_evento'];?></td>
                <td><?php echo $dato['descripcion'];?></td>
                <td><?php echo $dato['id_docente'];?></td>
                <td><?php echo $dato['fecha'];?></td>
                <td><?php echo $dato['hora'];?></td>
              </tr>
            </tbody>
          </table>
          <?php } ?>
          <!--  Tabla de alumnos inscritos en los eventos  --> 
          <?php $lista = mysqli_query($conexion, "SELECT persona.codigo, persona.nombre, persona.apellido, persona.telefono, lista_evento.id_alumno FROM lista_evento INNER JOIN persona ON persona.codigo = lista_evento.id_alumno;"); ?>
          <?php if($lista < 0){ ?>
          <h2>Alumnos registrados a los eventos</h2>
            <table class="container">
            <thead>
              <th>Código del alumno</th>
              <th>Nombre del alumno</th>
              <th>Teléfono del alumno</th>
            </thead>
            <tbody>
              <?php while($dato = mysqli_fetch_array($lista)){ ?>
              <tr>
                <td><?php echo $dato['codigo'];?></td>
                <td><?php echo $dato['nombre'];?> <?php echo $dato['apellido'];?></td>
                <td><?php echo $dato['telefono'];?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <?php } ?>
      </div><!--Div text  -->
    </div><!--Div home_content  -->
    <?php if(isset($_SESSION['mensaje'])){
          echo "<div>".$_SESSION['mensaje']."</div>";
          unset($_SESSION['mensaje']);
        }?>
    <script>
    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");
    let searchBtn = document.querySelector(".bx-search");
  
    btn.onclick = function() {
      sidebar.classList.toggle("active");
      if(btn.classList.contains("bx-menu")){
        btn.classList.replace("bx-menu" , "bx-menu-alt-right");
      }else{
        btn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    }
    searchBtn.onclick = function() {
      sidebar.classList.toggle("active");
    }
    </script>

  <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="../js/inicioAlumno.js"></script>
</body>
</html>