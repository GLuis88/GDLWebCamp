<?php include_once 'includes/templates/header.php' ?>

    <div class="seccion contenedor">
        <h2>Calendario de Eventos</h2>

        <?php 
            try {
                require_once('includes/funciones/bd_conexion.php');
                $sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre, apellido ";
                $sql .= " FROM eventos ";
                $sql .= " INNER JOIN categoria_evento ";
                $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                $sql .= " INNER JOIN invitados ";
                $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                $sql .= " ORDER BY evento_id ";
                $resultado = $conn->query($sql); 
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        ?>

        <div class="calendario">
            <?php 
                $calendario = array();

                while( $eventos = $resultado->fetch_assoc() ) { 
                    $fecha = $eventos['fecha_evento'];
                  
                    $evento = array(
                      'titulo' => $eventos['nombre_evento'],
                      'fecha' => $eventos['fecha_evento'],
                      'hora' => $eventos['hora_evento'],
                      'categoria' => $eventos['cat_evento'],
                      'icono' => 'fa' . " " .  $eventos['icono'],
                      'invitado' => $eventos['nombre'] . " " . $eventos['apellido']
                  );
                  $calendario[$fecha][] = $evento;
                  ?>
               <?php } ?>

               <?php 
                    foreach($calendario as $dia => $lista_eventos) { ?>
                        <h3>
                            <i class="fa fa-calendar"></i>
                            <?php 
                                setlocale(LC_TIME, 'spanish');
                                echo utf8_encode( strftime( "%A, %d de %B del %Y", strtotime($dia) ) );
                            ?>
                        </h3>
                        <?php 
                         foreach($lista_eventos as $evento) { ?>
                            <div class="dia">
                                <p class="titulo"><?php echo $evento['titulo']; ?></p>
                                <p class="hora">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <?php echo $evento['fecha'] . " " . $evento['hora']; ?>
                                </p>
                                <p>
                                <i class="<?php echo $evento['icono']; ?>" aria-hidden="true"></i>
                                <?php echo $evento['categoria']; ?></p>
                                <p>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php echo $evento['invitado']; ?>
                                </p>
                            </div>
                         <?php } ?>
                         <pre>
                             <?php var_dump($eventos); ?>
                         </pre>
                <?php } ?> 
        </div>

        <?php $conn->close(); ?>
        
    </div>
    <!--.seccion-->

    <?php include_once 'includes/templates/footer.php' ?>

    <script src=" js/vendor/modernizr-3.8.0.min.js "></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js " integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin=" anonymous "></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js "><\/script>')
    </script>
    <script src="js/plugins.js "></script>
    <script src="js/lightbox.js "></script>
    <script src="js/jquery.lettering.js "></script>
    <script src="js/jquery.countdown.min.js "></script>
    <script src="js/jquery.animateNumber.min.js "></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js "></script>
    <script src="js/main.js "></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js " async></script>
</body>

</html>