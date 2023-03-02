<!-- Modal -->
<div class="modal fade" id="modalEmpleados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mdltitulo"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="dempleados_form">
          <input type="hidden" id="id" name="id">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Apellido paterno:</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Apellido materno:</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Puesto:</label>
            <input type="text" class="form-control" id="puesto" name="puesto">
          </div>
           <div class="mb-3">
            <input type="hidden" class="form-control" id="status" name="status">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" name="action" id="#" value="add" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>