<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 11:32
 */

include_once ('../incluciones/verificacionUsuario.php');

?>
<!DOCTYPE html>
<html lang="es" >

<head>
    <?php include_once ('../incluciones/head.php'); ?>
    <script type="text/javascript" src="../js/indexModulo.js"></script>
    <script type="text/javascript" src="../js/nosotrosController.js"></script>
    <!-- AngularVideo directive -->
    <script type="text/javascript" src="../librerias/angular-video/anguvideo.js"></script>
    <script type="text/javascript" src="../librerias/angular-video/controller.js"></script>

    <title>Nosotros - MODPC</title>

</head>

<body ng-app="index" ng-controller="nosotrosController">
<!-- Navigation -->
<?php include_once('../incluciones/navbarVistas.php'); ?>
<!-- FIN DEL NAV   -->

<!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- ASIDE - COLUMNA LATERAL -->
        <!-- <div class="col-md-3" ng-init="cargarMoneda()" >
            <div class="col-md-12" ng-init="generarCheckoutBasicoMP(<?= $id ?>)">
                <p class="lead">Categorias:</p>
                <div class="list-group" ng-init="listarCategorias()" >
                    <a ng-repeat="categoria in categorias" href="categoria.php?id={{categoria.id}}" class="list-group-item" >{{categoria.descripcion}}</a>

                </div>
            </div>
            
        </div> -->
        <!-- fin ASIDE -->

        <?php include_once('../incluciones/asideCategoria.php') ?>
        
        <!--SECTION -->
        <div class="col-md-9">

            <div class="row" >
                <div class="jumbotron" ng-init="cargarProductosCarrito(<?= $id ?>)">
                    <h1 >Sobre herlam DIGITAL:</h1>
                </div>
                
                <div class="col-lg-10 col-lg-offset-1">
                    <dl>
                        <!-- <dt>Sobre herlam DIGITAL:</dt> -->
                        <dd class="text-justify"><strong>Herlam DIGITAL</strong> te permite conocer nuestras ofertas, beneficios, servicios y precios est&eacute;s donde est&eacute;s para 
                            planificar mejor tus compras. Adem&aacute;s, podes armar tu solicitud de perdido y coordinar con los  vendedores la disponibilidad, 
                            la elecci&oacute;n de tu medio de pago y el env&iacute;o.</dd>

                        <dd class="text-justify">La plataforma <strong>Herlam DIGITAL</strong> es una aplicaci&oacute;n pensada para nuestros Clientes Profesionales Veterinarios.
                         A trav&eacute;s de la misma, el usuario accede a las ofertas, servicios, beneficios, informaci&oacute;n, y toda la Propuesta de Valor que ofrece 
                         <strong>Herlam Argentina</strong>.</dd>

                        <dd class="text-justify">Herlam ha generado diferentes acuerdos comerciales con Empresas, Droguer&iacute;as y Farmacias. Los mismos tienen como objetivo fundamental 
                            brindar un beneficio econ&oacute;mico a todos los clientes de nuestra firma. Los productos listados en estas categor&iacute;as <strong>No</strong> son 
                            comercializados por GRUPO HERLAM SRL. Por lo que las solicitudes generadas son procesadas para la obtenci&oacute;n de los beneficios y 
                            completadas con los datos requeridos (Matr&iacute;cula profesional, Habilitaciones, Recetas etc.) en el momento de contacto con el asesor 
                            comercial que vincular&aacute; la solicitud con la farmacia o droguer&iacute;a seg&uacute;n corresponda.</dd>
                                
                        <dt class="text-justify">Los pasos a realizarse en esta plataforma son:</dt>
                        <dd>
                            <ol class="text-justify">
                                <li>La b&uacute;squeda de productos necesarios de nuestros clientes.</li>
                                <li>La Selecci&oacute;n de los mismos. Teniendo tambi&eacute;n la posibilidad el cliente de hacer consultas sobre sus caracter&iacute;sticas 
                                    t&eacute;cnicas o presentaci&oacute;n de lo mismos.</li>
                                <li>La Confirmaci&oacute;n de la solicitud de pedido, la cual congelar&aacute; el precio para poder finalizar con la gesti&oacute;n.</li>
                            </ol>
                        </dd>

                        <dd class="text-justify"><strong>Posteriormente un vendedor se contactar&aacute; con el cliente para finalizar la gesti&oacute;n. No requiriendo el sistema el 
                            acceso de medios de pago de ning&uacute;n tipo.</strong></dd>
                        <br>
                        <dt>T&eacute;rminos y condiciones de uso:</dt>
                        <dd>
                            <ol class="text-justify">
                                <li>Estos t&eacute;rminos y condiciones (en adelante, los “T&eacute;rminos y Condiciones”) regulan el uso de la 
                                    aplicaci&oacute;n <strong>Herlam DIGITAL</strong> de GRUPO HERLAM SRL (en adelante, “HERLAM”).</li>
                                <li>La actividad de los usuarios (en adelante, los “Usuarios”) dentro de la aplicaci&oacute;n <strong>Herlam DIGITAL</strong> 
                                (en adelante, la "Aplicaci&oacute;n") se regir&aacute; por &eacute;stos T&eacute;rminos y Condiciones. Cualquier persona que 
                                no acepte estos T&eacute;rminos y Condiciones, los cuales tienen car&aacute;cter vinculante, deber&aacute; abstenerse de 
                                utilizar la Aplicaci&oacute;n. Al utilizar la Aplicaci&oacute;n, los Usuarios declaran haber le&iacute;do, entendido y aceptado 
                                todas las condiciones establecidas en los presentes T&eacute;rminos y Condiciones.</li>
                                <li>Se entiende por Usuarios de la Aplicaci&oacute;n a los clientes profesionales de <strong>HERLAM</strong> que operen 
                                comercialmente en cualquiera de las categor&iacute;as: se registren en la Aplicaci&oacute;n conforme se indica en la cl&aacute;usula 
                                4 de los presentes T&eacute;rminos y Condiciones.</li>
                                <li>Para hacer uso de la Aplicaci&oacute;n, los Usuarios deber&aacute;n registrarse en la misma. La registraci&oacute;n como Usuarios 
                                    es libre y gratuita. Al ingresar los Usuarios sus datos personales en la Aplicaci&oacute;n nos proporcionan informaci&oacute;n, 
                                    la cual queda tecnol&oacute;gicamente protegida y su acceso queda restringido s&oacute;lo en las situaciones que los propios 
                                    Usuarios lo soliciten. La aceptaci&oacute;n de las solicitudes de registro es una decisi&oacute;n exclusiva de <strong>HERLAM</strong>, 
                                    quien en cualquier momento podr&aacute; determinar la cancelaci&oacute;n del registro de un Usuario sin expresar motivos. Toda la 
                                    informaci&oacute;n que los Usuarios proporcionan al momento de su registraci&oacute;n deber&aacute; ser verdadera, exacta y completa. 
                                    Los Usuarios son los &uacute;nicos y exclusivos responsables de la informaci&oacute;n que brindan mediante el uso de la Aplicaci&oacute;n 
                                    y de las consecuencias que genere cualquier inexactitud o falsedad de la informaci&oacute;n suministrada. Al proporcionar los Usuarios 
                                    sus datos personales, estos pasan a formar parte de un archivo confidencial, que define el perfil de los Usuarios.</li>
                                <li>Los Usuarios se comprometen a indemnizar y mantener indemne y libre de da&ntilde;os a <strong>HERLAM</strong>, sus subsidiarias, controlantes, 
                                empresas vinculadas de y contra toda y cualquier acci&oacute;n o juicio de responsabilidad, reclamo, denuncia, penalidad, intereses, costos, 
                                gastos, multas, honorarios, iniciado por terceros debido a o con origen en cualquier uso indebido de la Aplicaci&oacute;n.</li>
                                <li>Los contenidos de la Aplicaci&oacute;n incluir&aacute;n una descripci&oacute;n de los productos, servicios y beneficios ofrecidos por 
                                    <strong>HERLAM</strong> (en adelante, los "Contenidos”). Los Contenidos incluidos, entre otros, textos, software, gr&aacute;ficos, fotos, 
                                    sonidos, m&uacute;sica, contenidos interactivos y similares, as&iacute; como las marcas registradas, marcas de servicio y logos son de 
                                    propiedad de <strong>HERLAM</strong> o han sido otorgados a &eacute;ste bajo acuerdo o licencia, y quedan sujetos a derechos de autor u 
                                    otros derechos de propiedad intelectual de conformidad con la legislaci&oacute;n Argentina, la legislaci&oacute;n extranjera y 
                                    convenciones internacionales. Los Contenidos son suministrados en el estado en que se encuentran a los fines inform&aacute;tivos y 
                                    &uacute;nicamente para uso personal, y no podr&aacute;n ser utilizados, copiados, modificados, reproducidos, distribuidos, transmitidos, 
                                    exhibidos, comercializados, sujetos a licencias o explotados de cualquier otro modo ni con alg&uacute;n otro fin sin que mediare el 
                                    consentimiento previo por escrito de <strong>HERLAM</strong>. Los Usuarios se comprometen a no hacer uso, copiar o distribuir los 
                                    Contenidos salvo que se los autorice expresamente, incluido el uso, copia o distribuci&oacute;n del material de terceros obtenido a trav&eacute;s 
                                    de la Aplicaci&oacute;n. Si los Usuarios descargan o imprimen una copia de los Contenidos para uso personal, deber&aacute;n guardar todas las 
                                    notificaciones de derechos de autor y otros derechos de propiedad que all&iacute; se encuentran.</li>
                                <li>La oferta de los productos publicada a trav&eacute;s de la Aplicaci&oacute;n se encuentra sujeta a la disponibilidad de stock al momento de 
                                    la compra. La aplicaci&oacute;n solo genera el contacto comercial y la solicitud o intenci&oacute;n de compra del cliente. La aplicaci&oacute;n 
                                    no solicita el pago en ning&uacute;n momento de los productos seleccionados por el cliente. Un asesor comercial de <strong>HERLAM</strong> o 
                                    de la droguer&iacute;a o farmacia seg&uacute;n sea el caso se contactara con el cliente tomando la solicitud generada por el mismo como 
                                    una intenci&oacute;n de compra. El cliente posteriormente al definir la forma de pago formalizar&aacute; la compra.</li>
                                <li>Las fotos de los productos son meramente Ilustrativas. Los productos, sus caracter&iacute;sticas t&eacute;cnicas, precios, disponibilidad, y 
                                    ofertas contenidas en esta Aplicaci&oacute;n pueden variar sin previo aviso.</li>
                                <li>El titular de los datos personales tiene la facultad de ejercer el derecho de acceso a los mismos en forma gratuita a intervalos no inferiores 
                                    a seis meses, salvo que se acredite un inter&eacute;s leg&iacute;timo al efecto conforme lo establecido en el art&iacute;culo 14, inciso 3 de 
                                    la Ley Nº 25.326. La Direcci&oacute;n Nacional de Protecci&oacute;n de Datos Personales, &Oacute;rgano de Control de la Ley Nº 25.326, 
                                    tiene la atribuci&oacute;n de atender las denuncias y reclamos que se interpongan con relaci&oacute;n al incumplimiento de las normas sobre 
                                    protecci&oacute;n de datos personales. El titular de los datos personales podr&aacute; dirigir un correo electr&oacute;nico a 
                                    <strong>administracion@herlam.com.ar</strong>, solicitando el acceso a sus datos y, en su caso, requerir la actualizaci&oacute;n, modificaci&oacute;n 
                                    o eliminaci&oacute;n de los datos que considere err&oacute;neamente registrados. HERLAM proteger&aacute; la informaci&oacute;n personal de 
                                    los Usuarios de acuerdo con los est&aacute;ndares impuestos por la normativa vigente y las reglas del arte que razonablemente brinden 
                                    integridad y seguridad a los datos personales de los Usuarios. Al momento de facilitar a <strong>HERLAM</strong> sus datos personales, 
                                    los Usuarios prestan expreso consentimiento para que tales datos puedan ser utilizados por <strong>HERLAM</strong> con fines comerciales, 
                                    publicitarios y para el env&iacute;o de informaci&oacute;n promocional. La informaci&oacute;n de los Usuarios ser&aacute; tratada en los 
                                    t&eacute;rminos previstos por la Ley Nacional de Protecci&oacute;n de Datos Personales Nº 25.326.</li>
                                <li>Bajo ning&uacute;n concepto <strong>HERLAM</strong>, sus funcionarios, directores, empleados o representantes ser&aacute;n responsables por 
                                cualquier da&ntilde;o directo, indirecto, incidental, especial o punitivo que pudiera ser causado por: (i) errores, inexactitudes u 
                                omisiones en los Contenidos; (ii) da&ntilde;os de cualquier naturaleza a la persona o a la propiedad emergentes de su acceso a la Aplicaci&oacute;n 
                                o de la utilizaci&oacute;n de la misma; (iii) cualquier acceso no autorizado a nuestros servidores seguros y/o a toda informaci&oacute;n 
                                almacenada en dicho servidor; (iv) cualquier interrupci&oacute;n o cese de la transmisi&oacute;n desde o hacia la Aplicaci&oacute;n; 
                                y/o cualquier “bug”, virus, troyano o virus similares que pudieran ser transmitidos por terceros desde o hacia la Aplicaci&oacute;n. <strong>HERLAM</strong> 
                                se abstiene de manifestar que la Aplicaci&oacute;n es apropiada para otros lugares fuera del &aacute;mbito de la Rep&uacute;blica Argentina, 
                                como as&iacute; tambi&eacute;n que se encuentre disponible en &eacute;stos. Aquellas personas que accedan a la Aplicaci&oacute;n o hagan 
                                uso de &eacute;sta desde otras jurisdicciones lo hacen por su propia voluntad y asumen la responsabilidad de respetar la legislaci&oacute;n 
                                local.</li>
                                <li><strong>HERLAM</strong> no es, ni ser&aacute; responsable, por el contenido, pol&iacute;ticas de privacidad o t&eacute;rminos de uso 
                                de ninguna Aplicaci&oacute;n distinta a la de <strong>HERLAM</strong> no ser&aacute; responsable por la conducta en l&iacute;nea o fuera 
                                de l&iacute;nea de cualquier Usuario de la Aplicaci&oacute;n. <strong>HERLAM</strong> no asume responsabilidad alguna por errores, omisiones, 
                                interrupciones, supresiones, defectos, demoras en la operaci&oacute;n o transmisi&oacute;n, desperfectos en las l&iacute;neas de comunicaci&oacute;n, 
                                robo o destrucci&oacute;n, acceso no autorizado a cualquier comunicaci&oacute;n de los Usuarios o su alteraci&oacute;n, ni por errores 
                                humanos o acciones deliberadas de terceros que pudieran interrumpir o alterar el normal desarrollo de la Aplicaci&oacute;n o causar 
                                da&ntilde;os en los equipos o software de los Usuarios. <strong>HERLAM</strong> no se responsabiliza por problemas o desperfectos t&eacute;cnicos 
                                de las redes o l&iacute;neas telef&oacute;nicas, sistemas inform&aacute;ticos en l&iacute;nea, servidores o proveedores, equipos de 
                                computaci&oacute;n, software, desperfectos de correos electr&oacute;nicos o de reproductores, derivados de inconvenientes t&eacute;cnicos o 
                                congesti&oacute;n en el tr&aacute;fico en internet o en cualquiera de los contenidos de la Aplicaci&oacute;n o cualquier combinaci&oacute;n 
                                de los mismos. Los inconvenientes antedichos incluyen los da&ntilde;os o lesiones a Usuarios o a la computadora de cualquier persona que tengan 
                                relaci&oacute;n o que resulten de la participaci&oacute;n o la descarga de materiales en relaci&oacute;n con los contenidos de la Aplicaci&oacute;n. 
                                <strong>HERLAM</strong> no puede garantizar y no promete resultados espec&iacute;ficos como consecuencia del uso de los contenidos de 
                                la Aplicaci&oacute;n.</li>
                                <li><strong>HERLAM</strong> se reserva el derecho de modificar o interrumpir el contenido de la Aplicaci&oacute;n, 
                                ya sea en forma permanente o transitoria, sin aviso previo y/o consentimiento de los Usuarios, en cualquier 
                                momento y a su exclusivo criterio.</li>
                                <li><strong>HERLAM</strong> se reserva el derecho de modificar los T&eacute;rminos y Condiciones de la Aplicaci&oacute;n, 
                                a fin de adaptarlos a nuevos requerimientos en materia de legislaci&oacute;n, jurisprudencia, t&eacute;cnica o cualquier 
                                otro motivo que le permitan mejorar el contenido de la Aplicaci&oacute;n. Por este motivo, aconsejamos revisar 
                                peri&oacute;dicamente estos T&eacute;rminos y Condiciones.</li>
                                <li>Ante cualquier consulta, queja o comentario pude contactarse con nosotros ingresando a <a href="https://www.herlam.com.ar">www.herlam.com.ar</a>  
                                y completar en  la secci&oacute;n contacto.</li>
                                <li>Para cualquier cuesti&oacute;n judicial que pudiere derivarse del uso de la Aplicaci&oacute;n, los Usuarios, y <strong>HERLAM</strong> 
                                se someter&aacute;n a la jurisdicci&oacute;n de la provincia de Buenos Aires, partido de la matanza. La partes se someten a su jurisdicci&oacute;n, 
                                haciendo renuncia expresa a cualquier otra que pudiese corresponder, para la resoluci&oacute;n de los conflictos y con renuncia de cualquier otro 
                                fuero, a los juzgados y tribunales del domicilio del usuario.</li>																	
                            </ol>
                        </dd>
                    </dl>
                </div>
                
            </div>

        </div>
        <!-- fin SECTION -->
    </div>

</div>
<!-- /.container -->

<div class="container">

    <hr>

    <!-- Footer -->
    <!-- <footer>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>Copyright &copy; ModPC 2017</p>
            </div>
        </div>
    </footer> -->
    <?php include_once('../incluciones/footer.php') ?>
</div>
<!-- /.container -->
<!-- jQuery -->
<script src="../librerias/template/js/jquery.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="../librerias/template/js/bootstrap.min.js"></script>

<!-- Bootbox js -->
<script type="text/javascript" src="../librerias/bootbox/bootbox.min.js"></script>


<!-- modal de contacto -->
<?php include_once('../incluciones/formularioContacto.php'); ?>
<script src="../librerias/formulario_contacto/jqBootstrapValidation.js"></script>
<script src="../librerias/formulario_contacto/contact_me.js"></script>


</body>

</html>