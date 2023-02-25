<div class="row">
<?php
    if ($filteredProducts > 0) {
        foreach ($filteredProducts as $product) {
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card overflow-hidden h-100">
                    <div class="bg-image overflow-hidden d-flex">
                        <a href="/shop/product?id=<?= $product->id ?>" class="flex-grow-1 d-flex justify-content-center">
                            <img src="../../images/<?= $product->image ?>"
                                 class="w-auto hover-zoom mx-auto" alt="keyboard" style="height: 200px;"/>
                        </a>
                    </div>
                    <div class="card-body">
                        <a href="/shop/product?id=<?= $product->id ?>"
                           class="card-title mb-1 text-decoration-none text-black">
                            <h5 class="card-title mb-1"><?= $product->name ?></h5>
                        </a>
                        <p class="opacity-75 badge bg-theme"><?= $product->company ?></p>
                        <h6 class="mb-3" id="price-<?= $product->id ?>">&euro;<?= $product->price ?></h6>
                        <button type="button" id="btn-add-<?= $product->id ?>" onclick="add_product(this.id)"
                                class="btn btn-theme text-white">Add To Cart</button>
                        <a href="/shop/product?id=<?= $product->id ?>" class="btn btn-theme text-white">
                            More Info</a>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No records found...";
    }
    ?>
</div>
<?= $pagination->createLinks(); ?>
