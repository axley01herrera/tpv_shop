<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <!-- TITLE -->
                <h5 class="modal-title" id="staticBackdropLabel"><?php echo $title; ?></h5>
                <!-- CLOSE -->
                <button type="button" class="btn-close closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mt-2">
                        <label for="txt-art">Artículo</label>
                        <input id="txt-name" type="text" class="form-control modal-required focus" value="<?php echo @$product[0]->name; ?>">
                        <p id="msg-txt-name" class="text-danger text-end"></p>
                    </div>
                    <div class="col-6">
                        <label for="txt-code">Código</label>
                        <input id="txt-code" type="text" class="form-control modal-required focus" value="<?php echo @$product[0]->code; ?>">
                        <p id="msg-txt-code" class="text-danger text-end"></p>
                    </div>
                    <div class="col-6">
                        <label for="txt-price">Precio</label>
                        <input id="txt-price" type="text" class="form-control modal-required focus" value="<?php echo @$product[0]->price; ?>">
                        <p id="msg-txt-price" class="text-danger text-end"></p>
                    </div>
                </div>
            </div>
            <?php echo view('modals/modalFooter'); ?>
        </div>
    </div>
</div>

<script>
    $('#btn-modal-submit').on('click', function() {  
    });
</script>