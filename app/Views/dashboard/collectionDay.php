<div class="card">
    <div class="card-header">
        <h3>Producción</h3>
    </div>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="row mb-3">
                <div class="col-6 text-center">
                    <p class="text-dark mb-2"><strong>Efectivo</strong></p>
                    <h5><small class="badge badge-soft-success font-13 ms-2"><img src="<?php echo base_url('assets/images/dcash.png'); ?>" alt="cash" width="25px"></small> € <?php echo number_format($collectionDay['cash'], 2,".",','); ?></h5>
                </div>
                <div class="col-6 text-center">
                    <p class="text-dark mb-2"><strong>Tarjeta</strong></p>
                    <h5><small class="badge badge-soft-success font-13 ms-2"><img src="<?php echo base_url('assets/images/dcreditcard.png'); ?>" alt="credit card" width="25px"></small> € <?php echo number_format($collectionDay['card'], 2,".",','); ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>