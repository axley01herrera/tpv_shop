
<div class="row">
    <div class="col-12 text-end">
        <h5>Efectivo: € <?php echo number_format($collectionDay['cash'], 2, ".", ','); ?></h5>
        <h5>Tarjeta: € <?php echo number_format($collectionDay['card'], 2, ".", ','); ?></h5>
        <h5>Total: € <?php echo number_format($collectionDay['total'], 2, ".", ','); ?></h5>
    </div>
</div>
