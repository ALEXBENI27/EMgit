<?php
    require_once 'conexion.php';
    session_start();

    //Valida que el usuario este logueado, además de que otros usuarios no puedan acceder a partes del sistema que no deberían poder acceder.

    $codigo = $_SESSION['codigo'];
    $query = mysqli_query($conexion, "SELECT * FROM persona WHERE codigo = '$codigo'"); 
    $usuario = mysqli_fetch_assoc($query);

    if($usuario['cargo'] != "alumno"){
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
    <title>Alumno</title>
    <link rel="stylesheet" href="../css/calificaciones.css">
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
          <a href="inicioAlumno.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Usuario</span>
          </a>
          <span class="tooltip">Usuario</span>
        </li>
        <li>
          <a href="calificaciones.php">
            <i class='bx bx-book'></i>
            <span class="links_name">Calificaciones</span>
          </a>
          <span class="tooltip">Calificaciones</span>
        </li>
        <li>
          <a href="registro.php">
            <i class='bx bxs-folder'></i>
            <span class="links_name">Registro</span>
          </a>
          <span class="tooltip">Registro</span>
        </li>
        <li>
          <a href="pagos.php">
            <i class='bx bx-cart-alt' ></i>
            <span class="links_name">Pagos</span>
          </a>
          <span class="tooltip">Pagos</span>
        </li>
        <li>
          <a href="servicios.php">
            <i class='bx bxs-data'></i>
            <span class="links_name">Servicios</span>
          </a>
          <span class="tooltip">Servicios</span>
        </li>
        <li>
          <a href="configuracion.php">
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
    <!--***************************************************************************************  -->
    <!-- REVISAR EN ESTE APARTADO, CÓMO BUSCAR POR EL CÓDIGO ESPECÍFICO DEL USUARIO QUE INGRESÓ. -->
    <!--***************************************************************************************  -->
    <div class="home_content"> 
        <div class="text">Bienvenido, alumno 
        <?php 
        $valor = $_SESSION['codigo'];
        $query = mysqli_query($conexion, "SELECT * FROM persona WHERE codigo = '$valor'"); 
        $usuario = mysqli_fetch_assoc($query);
        echo $usuario['nombre'];
        ?>
        </div>

      <div id="content">
        
        <div id="center">
          <p>Datos personales</p>
        </div>

        <div id="left">
          <p>Horario</p>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis fugit sint fugiat voluptatem, praesentium libero consequatur excepturi! Consequatur ullam libero ex quis, unde architecto perspiciatis maxime ad. Voluptatibus sunt, minus nemo qui est sapiente corrupti porro maxime corporis alias fuga sequi, id quidem similique dignissimos incidunt. Saepe cumque corporis et commodi soluta ipsa, pariatur nesciunt nihil doloremque officia autem facilis, corrupti tempora neque? Magnam necessitatibus eius sint. Quisquam iste id quibusdam, laborum, fuga quas accusamus alias odit nulla facere asperiores! Placeat qui quas unde necessitatibus error. Id, quam unde. Repellendus minima consequuntur amet reiciendis perspiciatis eligendi nam, alias laboriosam aliquid!</p>
        </div>

        <div id="right">
          <p>Datos generales del alumno:</p>
          <div id = "datos">
              <table class="tabla">
                <thead>
                  <th>Codigo</th>
                  <th>nombre</th>
                  <th>apellido</th>
                  <th>correo</th>
                  <th>cargo</th>
                  <th>estatus</th>
                </thead>
                <tbody id="body-table">
                  <tr>
                    <td><?php echo $usuario['codigo'];?></td>
                    <td><?php echo $usuario['nombre'];?></td>
                    <td><?php echo $usuario['apellido'];?></td>
                    <td><?php echo $usuario['correo'];?></td>
                    <td><?php echo $usuario['cargo'];?></td>
                    <td><?php echo $usuario['estatus'];?></td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
        <div class="footer">
        <p> Todos los derechos reservados © 2021</p>
      </div>
      </div>
    </div>

    </div>
  
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