(function() {
    'use strict';

    var regalo = document.getElementById('regalo');
    document.addEventListener('DOMContentLoaded', function() {

        if (document.getElementById('mapa')) {
            var map = L.map('mapa').setView([20.656368, -103.325686], 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([20.656368, -103.325686]).addTo(map)
                .bindPopup('GDLWebCamp 2018 <br> Boletos ya disponibles')
                .openPopup();
        }

        // Campos datos usuario
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        // Campos pases
        var pase_dia = document.getElementById('pase_dia');
        var pase_dosdias = document.getElementById('pase_dosdias');
        var pase_completo = document.getElementById('pase_completo');

        //  Botones y divs
        var calcular = document.getElementById('calcular');
        var errorDiv = document.getElementById('error');
        var botonRegistro = document.getElementById('btnRegistro');
        var lista_productos = document.getElementById('lista-productos');
        var suma = document.getElementById('suma-total');

        //Extras
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');

        botonRegistro.disabled = true;

        if (document.getElementById('calcular')) {

            calcular.addEventListener('click', calcularMontos);

            pase_dia.addEventListener('blur', mostrarDias);
            pase_dosdias.addEventListener('blur', mostrarDias);
            pase_completo.addEventListener('blur', mostrarDias);

            nombre.addEventListener('blur', validarCampos);
            apellido.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarMail);

            function validarCampos() {
                if (this.value == '') {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Este campo es obligatorio";
                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red';
                } else {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #CCCCCC';
                }
            }

            function validarMail() {
                if (this.value.indexOf("@") > -1) {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #CCCCCC';
                } else {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "El correo electronico debe contener una @";
                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red';
                }
            }

            function calcularMontos(event) {
                event.preventDefault();
                if (regalo.value == '') {
                    alert("Debes elegir un regalo");
                    regalo.focus();
                } else {
                    var boletoDias = parseInt(pase_dia.value, 10) || 0,
                        boleto2Dias = parseInt(pase_dosdias.value, 10) || 0,
                        boletoCompleto = parseInt(pase_completo.value, 10) || 0,
                        cantCamisas = parseInt(camisas.value, 10) || 0,
                        cantEtiquetas = parseInt(etiquetas.value, 10) || 0;

                    var totalaPagar = (boletoDias * 30) + (boleto2Dias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);

                    var listadoProductos = [];

                    if (boletoDias >= 1) {
                        listadoProductos.push(`${boletoDias} Pases por día`);
                    }
                    if (boleto2Dias >= 1) {
                        listadoProductos.push(`${boleto2Dias} Pases por 2 dias`);
                    }
                    if (boletoCompleto >= 1) {
                        listadoProductos.push(`${boletoCompleto} Pases Completos`);
                    }
                    if (cantCamisas >= 1) {
                        listadoProductos.push(`${cantCamisas} Camisas`);
                    }
                    if (cantEtiquetas >= 1) {
                        listadoProductos.push(`${cantEtiquetas} Etiquetas`);
                    }

                    lista_productos.style.display = "block";
                    lista_productos.innerHTML = '';
                    for (var i = 0; i < listadoProductos.length; i++) {
                        lista_productos.innerHTML += listadoProductos[i] + '<br/>';
                    }
                    suma.innerHTML = '$ ' + totalaPagar.toFixed(2);

                    botonRegistro.disabled = false;
                    document.getElementById('total_pedido').value = totalaPagar;

                    console.log(listadoProductos);
                }
            }

            function mostrarDias() {
                var boletoDias = parseInt(pase_dia.value, 10) || 0,
                    boleto2Dias = parseInt(pase_dosdias.value, 10) || 0,
                    boletoCompleto = parseInt(pase_completo.value, 10) || 0;

                var diasElegidos = [];

                if (boletoDias > 0) {
                    diasElegidos.push('viernes');
                }
                if (boleto2Dias > 0) {
                    diasElegidos.push('viernes', 'sabado');
                }
                if (boletoCompleto > 0) {
                    diasElegidos.push('viernes', 'sabado', 'domingo');
                }
                for (var i = 0; i < diasElegidos.length; i++) {
                    document.getElementById(diasElegidos[i]).style.display = 'block';
                }
            }

        }

    });

})();

$(function() {
    // Lettering
    if (document.getElementById('.nombre-sitio')) {
        $('.nombre-sitio').lettering();
    }

    // Agregar clase a Menú
    $('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');

    // Menu Fijo
    var headerAltura = $('.site-header').innerHeight();
    var barraAltura = $('.barra').innerHeight();

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll > headerAltura) {
            $('.barra').addClass('fixed');
            $('body').css({ 'margin-top': barraAltura + 'px' });
        } else {
            $('.barra').removeClass('fixed');
            $('body').css({ 'margin-top': '0px' });
        }
    })

    // Menu Responsive

    $('.menu-movil').on('click', function() {
        $('.navegacion-principal').slideToggle();
    })

    // Programa de Conferencias
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click', function() {
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);
        return false;
    })

    // Animaciones para los Numeros
    $('.resumen-evento').on('mouseenter', animarNumeros);

    function animarNumeros() {
        $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6 }, 1200);
        $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15 }, 1200);
        $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 3 }, 1500);
        $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9 }, 1500);
    }

    // Cuenta Regresiva
    $('.cuenta-regresiva').countdown('2020/12/25 00:00:00', function(event) {
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));
    });

    // Colorbox
    $('.invitado_info').colorbox({ inline: true, width: "50%" });
});