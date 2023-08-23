<div class="card">
    <div class="card-header">
        <h3>Recaudación del Día</h3>
    </div>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="row mb-3">
                <div class="col-4 text-center">
                    <p class="text-dark mb-2"><strong>Efectivo</strong></p>
                    <h5 class="badge badge-soft-success">€ <?php echo number_format($collectionDay['cash'], 2,".",','); ?></h5>
                </div>
                <div class="col-4 text-center">
                    <p class="text-dark mb-2"><strong>Tarjeta</strong></p>
                    <h5 class="badge badge-soft-danger">€ <?php echo number_format($collectionDay['card'], 2,".",','); ?></h5>
                </div>
                <div class="col-4 text-center">
                    <p class="text-dark mb-2"><strong>Total</strong></p>
                    <h5 class="badge badge-soft-primary">€ <?php echo number_format($collectionDay['total'], 2,".",','); ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>