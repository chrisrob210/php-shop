<?php
$totalQuantity = 0;
if (isset($_SESSION['cart_item'])) {
    foreach ($_SESSION['cart_item'] as $item) {
        $totalQuantity += $item['Quantity'];
    }
}
?>
<header class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid w-auto d-grid gap-5">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav navbar-right fw-bold">
                <?php
                // Define each name associated with an URL
                $urls = array(
                    'Home' => '/',
                    'Cart' => '/cart',
                    // …
                );

                foreach ($urls as $name => $url) {
                    echo '<li class="nav-item"><a class="' . (($currentPage === $name) ? 'nav-link active' : 'nav-link') . '" href="' . $url . '">' . $name . ($name == 'Cart' ? (isset($_SESSION['cart_item']) ? "(" . $totalQuantity . ")" : "") : "") . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</header>