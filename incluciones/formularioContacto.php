

<!-- Modal -->
<div id="contactModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contacto</h4>
      </div>
      <div class="modal-body">
        <!-- Formulario de contacto -->
        <form id="contactForm" name="sentMessage" novalidate>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <input class="form-control" id="name" type="text" placeholder="Tu Nombre *" required data-validation-required-message="Por favor ingresa tu nombre.">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
                <input class="form-control" id="email" type="email" placeholder="Tu Email *" required data-validation-required-message="Por favor ingresa tu direccion de correo.">
                <p class="help-block text-danger"></p>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <textarea class="form-control" id="message" placeholder="Tu Mensaje *" required data-validation-required-message="Por favor ingresa tu mensaje." rows="3"></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 text-center">
              <div id="success"></div>
              <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit"><span class="fa fa-send"></span> Enviar Mensaje</button>
            </div>
          </div>
        </form>
        <!-- fin formulario contacto -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>