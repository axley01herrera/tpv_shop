<div class="card">
    <div class="card-header">
        <h3>Productos Según Estado</h3>
    </div>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="row mb-3">
                <div class="col-4 text-center">
                    <p class="text-dark mb-2"><strong>Activos</strong></p>
                    <h5 class="badge badge-soft-success"><?php echo $productInfo['active']; ?></h5>
                </div>
                <div class="col-4 text-center">
                    <p class="text-dark mb-2"><strong>Inactivos</strong></p>
                    <h5 class="badge badge-soft-danger"><?php echo $productInfo['inactive']; ?></h5>
                </div>
                <div class="col-4 text-center">
                    <p class="text-dark mb-2"><strong>Total</strong></p>
                    <h5 class="badge badge-soft-primary"><?php echo $productInfo['total']; ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>