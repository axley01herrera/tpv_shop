<div class="card">
    <div class="card-header">
        <h3 class="text-muted">Recaudación del Día</h3>
    </div>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="row mb-3">
                <div class="col-4 text-center">
                    <p class="text-muted mb-2"><strong>Efectivo:</strong></p>
                    <h5 class="text-primary">€ <?php echo number_format($collectionDay['cash'], 2,".",','); ?></h5>
                </div>
                <div class="col-4 text-center">
                    <p class="text-muted mb-2"><strong>Tarjeta:</strong></p>
                    <h5 class="text-primary">€ <?php echo number_format($collectionDay['card'], 2,".",','); ?></h5>
                </div>
                <div class="col-4 text-center">
                    <p class="text-muted mb-2"><strong>Total:</strong></p>
                    <h5 class="text-primary">€ <?php echo number_format($collectionDay['total'], 2,".",','); ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>