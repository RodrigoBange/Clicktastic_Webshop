<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom fixed-top">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">
            <img src="images/logo.png" height="28" alt="Clicktastic">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="/" class="nav-item nav-link <?= $page == 'home' ? 'active' : ''?>">Home</a>
                <a href="/shop/products" class="nav-item nav-link <?= $page == 'shop' ? 'active' : ''?>">Shop</a>
                <?php
                $navFunc->management($page);
                ?>
            </div>
            <div class="navbar-nav ms-auto">
                <a href="/cart/shoppingcart" class="nav-item nav-link <?= $page == 'cart' ? 'active' : ''?>">
                    <i class="fa fa-shopping-basket"></i>
                    <span id="cartcount">
                        <?php
                        echo $navFunc->getCount();
                        ?>
                    </span>
                </a>
                <?php
                $navFunc->displayUser($page);
                ?>
            </div>
        </div>
    </div>
</nav>