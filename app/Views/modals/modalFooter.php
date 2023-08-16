<!-- MODAL FOOTER -->
<div class="modal-footer mt-10">
    <!-- SUBMIT -->
    <button type="button" id="btn-modal-submit" class="btn btn-sm btn-primary">Guardar <span id="spin-modal-submit" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden ></span></button>
    <!-- CLOSE --> 
    <button type="button" class="btn btn-sm btn-secondary closeModal" data-bs-dismiss="modal">Cerrar</button>
</div>
<script>
    $('#modal').modal('show');

    $('.closeModal').on('click', function () { // ON CLOSE
        $('#modal').modal('hide');
        $('#main-modal').html('');
    });

    function closeModal() {
        $('#modal').modal('hide');
        $('#main-modal').html('');
    }
</script>