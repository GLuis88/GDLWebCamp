<?php include_once 'includes/templates/header.php' ?>

    <section class="seccion contenedor">
        <h2>La mejor conferencia de diseño web en español</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nesciunt deleniti fugiat vitae impedit qui sapiente eligendi ducimus amet eum. Quibusdam dolores deleniti mollitia officia eius corrupti, reiciendis quis distinctio.</p>
    </section>
    <!--.seccion-->

    <section class="programa">
        <div class="contenedor-video">
            <video autoplay loop muted poster="bg-talleres.jpg">
                <source src="video/video.mp4" type="video/mp4">
                <source src="video/video.webm" type="video/webm">
                <source src="video/video.ogv" type="video/ogv">
            </video>
        </div>
        <!--.contenedor-video-->
        <div class="contenido-programa">
            <div class="contenedor">
                <div class="programa-evento">
                    <h2>Programa del Evento</h2>

                    <?php 
                        try {
                            require_once('includes/funciones/bd_conexion.php');
                            $sql = " SELECT * FROM categoria_evento ";
                            $resultado = $conn->query($sql); 
                        } catch (\Exception $e) {
                            echo $e->getMessage();
                        }
                    ?>

                    <nav class="menu-programa">
                        <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                            <?php $categoria = $cat['cat_evento']; ?>
                            <a href="#<?php echo strtolower($categoria) ?>"><i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"></i> <?php echo $categoria ?></a>
                        <?php } ?>
                    </nav>

                    <?php 
                        try {
                            require_once('includes/funciones/bd_conexion.php');
                            $sql = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre`, `apellido` ";
                            $sql .= "FROM `eventos` ";
                            $sql .= "INNER JOIN `categoria_evento` ";
                            $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                            $sql .= "INNER JOIN `invitados` ";
                            $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                            $sql .= "AND eventos.id_cat_evento = 1 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                            $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre`, `apellido` ";
                            $sql .= "FROM `eventos` ";
                            $sql .= "INNER JOIN `categoria_evento` ";
                            $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                            $sql .= "INNER JOIN `invitados` ";
                            $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                            $sql .= "AND eventos.id_cat_evento = 2 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                            $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre`, `apellido` ";
                            $sql .= "FROM `eventos` ";
                            $sql .= "INNER JOIN `categoria_evento` ";
                            $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                            $sql .= "INNER JOIN `invitados` ";
                            $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                            $sql .= "AND eventos.id_cat_evento = 3 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                        } catch (\Exception $e) {
                            echo $e->getMessage();
                        }
                    ?>
                    
                    <?php $conn->multi_query($sql); ?>

                    <?php 
                        do {
                            $resultado = $conn->store_result();
                            $row = $resultado->fetch_all(MYSQLI_ASSOC) ?>

                            <?php $i = 0; ?>
                            <?php foreach($row as $evento): ?>
                                <?php if($i%2 == 0) { ?>
                                    <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">
                                <?php } ?>
                                        <div class="detalle-evento">
                                            <h3><?php echo ($evento['nombre_evento']) ?></h3>
                                            <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $evento['hora_evento']; ?></p>
                                            <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $evento['fecha_evento']; ?></p>
                                            <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo $evento['nombre'] . " " . $evento['apellido']; ?></p>
                                        </div>
                                <?php if($i%2 == 1): ?>
                                    <a href="calendario.php" class="button float-right">Ver todos</a>
                                    </div>
                                <?php endif; ?>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                            <?php $resultado->free(); ?>
                    <?php } while ($conn->more_results() && $conn->next_result());
                    ?>
                </div>
                <!--.programa-evento-->
            </div>
            <!--.contenedor-->
        </div>
        <!--.contenido-programa-->
    </section>
    <!--.programa-->

    <?php include_once 'includes/templates/invitados.php' ?> 

    <div class="contador parallax">
        <div class="contenedor">
            <ul class="resumen-evento clearfix">
                <li>
                    <p class="numero">6</p> Invitados
                </li>
                <li>
                    <p class="numero">15</p> Talleres
                </li>
                <li>
                    <p class="numero">3</p> Días
                </li>
                <li>
                    <p class="numero">9</p> Conferencias
                </li>
            </ul>
        </div>
        <!--.contenedor-->
    </div>
    <!--.contador-->

    <section class="precios seccion">
        <h2>Precios</h2>
        <div class="contenedor">
            <ul class="lista-precios clearfix">
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por día</h3>
                        <p class="numero">$30</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>

                <li>
                    <div class="tabla-precio">
                        <h3>Todos los días</h3>
                        <p class="numero">$50</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button">Comprar</a>
                    </div>
                </li>

                <li>
                    <div class="tabla-precio">
                        <h3>Pase dos días</h3>
                        <p class="numero">$45</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>
            </ul>
            <!--.lista-precios-->
        </div>
        <!--.contenedor-->
    </section>
    <!--precios-->

    <div id="mapa" class="mapa">

    </div>
    <!--.mapa-->

    <section class="seccion">
        <h2>Testimoniales</h2>
        <div class="testimoniales contenedor clearfix">
            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus minus possimus dolor dolorem, voluptatum molestias nobis perferendis quidem rerum quod eaque sunt maxime placeat nisi veritatis. Voluptas optio quos numquam.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Testimonial">
                        <cite>Oswaldo Aponte Escobita <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--.testimonial-->
            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus minus possimus dolor dolorem, voluptatum molestias nobis perferendis quidem rerum quod eaque sunt maxime placeat nisi veritatis. Voluptas optio quos numquam.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg " alt="Testimonial ">
                        <cite>Oswaldo Aponte Escobita <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--.testimonial-->
            <div class="testimonial">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus minus possimus dolor dolorem, voluptatum molestias nobis perferendis quidem rerum quod eaque sunt maxime placeat nisi veritatis. Voluptas optio quos numquam.</p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Testimonial">
                        <cite>Oswaldo Aponte Escobita <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--.testimonial-->
        </div>
        <!--.testimoniales-->
    </section>

    <div class="newsletter parallax">
        <div class="contenido contenedor">
            <p>Regístrate al newsletter:</p>
            <h3>GDLWebCamp</h3>
            <a href="#" class="button transparente">Registro</a>
        </div>
        <!--.contenido-->
    </div>
    <!--.newsletter-->

    <section class="seccion">
        <h2>Faltan</h2>
        <div class="cuenta-regresiva contenedor">
            <ul class="clearfix">
                <li>
                    <p id="dias" class="numero"></p>diás
                </li>


                <li>
                    <p id="horas" class="numero"></p>horas
                </li>

                <li>
                    <p id="minutos" class="numero"></p>minutos
                </li>

                <li>
                    <p id="segundos" class="numero"></p>segundos
                </li>
            </ul>
        </div>
        <!--.cuenta-regresiva-->
    </section>

    <?php include_once 'includes/templates/footer.php' ?>

    <script src=" js/vendor/modernizr-3.8.0.min.js "></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js " integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin=" anonymous "></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js "><\/script>')
    </script>
    <script src="js/plugins.js "></script>
    <script src="js/jquery.colorbox-min.js"></script>
    <script src="js/jquery.lettering.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
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