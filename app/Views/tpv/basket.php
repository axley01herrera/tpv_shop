<style>
    .scrollable {
        max-height: 500px;
        overflow-y: auto;
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h3>Cesta de Compra</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row scrollable">
            <div class="col-12 mt-2">
                <div class="table-responsive">
                    <table id="dt-basket" class="table" style="width: 100%;">
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($basket as $article) :
                            ?>
                                <tr>
                                    <td><?php echo $article->name; ?></td>
                                    <td><?php echo '€ ' . number_format($article->amount, 2, ".", ','); ?></td>
                                    <td class="text-end">
                                        <button data-id="<?php echo $article->id; ?>" class="btn btn-sm btn-warning edit-price"><span class="mdi mdi-square-edit-outline" title="Editar Precio"></span></button>
                                        <button data-id="<?php echo $article->id; ?>" class="btn btn-sm btn-danger remove-article"><span class="mdi mdi-trash-can-outline" title="Remover Artículo"></span></button>
                                    </td>
                                </tr>
                            <?php
                                $total = $total + $article->amount;
                            endforeach
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-end">
                <h3>Total: <span><?php echo '€ ' . number_format($total, 2, ".", ','); ?></span> </h3>
                <br>
                <button id="btn-charge" class="btn btn-sm btn-success">Cobrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.edit-price').on('click', function() {
        let id = $(this).attr('data-id');

        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/modalEditArticleFromBasket'); ?>",
            data: {
                'id': id
            },
            dataType: "html",
            success: function(response) {
                $('#main-modal').html(response);
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error!');
            }
        });
    });

    $('.remove-article').on('click', function() {
        let id = $(this).attr('data-id');

        $.ajax({
            type: "post",
            url: "<?php echo base_url('TPV/removeArticleFromBasket'); ?>",
            data: {
                'id': id
            },
            dataType: "json",
            success: function(response) {
                switch (response.error) {
                    case 0:
                        dtBasket();
                        showToast('success', 'Artículo removido de la cesta de compra!');
                        break;
                    case 1:
                        showToast('error', 'Ha ocurrido un error!');
                        break;
                    case 2:
                        window.location.href = "<?php echo base_url('Authentication?session=expired'); ?>";
                        break;
                }
            },
            error: function(error) {
                showToast('error', 'Ha ocurrido un error!');
            }
        });

    });

    $('#btn-charge').on('click', function() {
        let total = Number(<?php echo $total; ?>)
        if (total > 0) {
            $('#btn-charge').attr('disabled', true);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('TPV/modalPayType'); ?>",
                data: {
                    'basketID': basketID
                },
                dataType: "html",
                success: function(response) {
                    $('#main-modal').html(response);
                    $('#btn-charge').removeAttr('disabled');
                },
                error: function(error) {
                    showToast('error', 'Ha ocurrido un error!');
                }
            });
        } else
            showToast('error', 'No hay artículos en la cesta!');
    });
</script>