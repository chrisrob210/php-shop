<?php
//Always check to see if session is active (session_status() = 2)
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once('../php/dbcontroller.php');

$mysql_login = json_decode(file_get_contents("../json/mysql.json"), true);
//Instantiate DBController. Constructor requires $servername, $username, $password, $dbname
$db_handle = new DBController($mysql_login['servername'], $mysql_login['username'], $mysql_login['password'], $mysql_login['dbname']);
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add": {
                if (isset($_GET['id'])) {
                    //Query database for items matching the ProductId
                    $productByCode = $db_handle->runQuery("SELECT * FROM shop WHERE ProductId ='" . $_GET['id'] . "'");
                    //Create Associative Array

                    $itemArray = array($productByCode[0]["ProductId"] => array(
                        'Name' => $productByCode[0]["Name"],
                        'ProductId' => $productByCode[0]["ProductId"],
                        'Quantity' => 1,
                        'Price' => $productByCode[0]["Price"],
                        'Image' => $productByCode[0]["Image"],
                        'Description' => $productByCode[0]["Description"]
                    ));
                    if (!empty($_SESSION['cart_item'])) {
                        if (in_array($productByCode[0]['ProductId'], array_keys($_SESSION['cart_item']))) {
                            foreach ($_SESSION['cart_item'] as $key => $value) {
                                if ($productByCode[0]['ProductId'] === $key) {
                                    if (empty($_SESSION['cart_item'][$key]['Quantity'])) {
                                        $_SESSION['cart_item'][$key]['Quantity'] = 0;
                                    }
                                    $_SESSION['cart_item'][$key]['Quantity'] += 1;
                                }
                            }
                        } else {
                            $_SESSION['cart_item'] = array_merge($_SESSION['cart_item'], $itemArray);
                        }
                    } else {
                        $_SESSION['cart_item'] = $itemArray;
                    }
                }
            }
            break;

        case "remove": {
                if (!empty($_SESSION['cart_item'])) {
                    foreach ($_SESSION['cart_item'] as $key => $value) {
                        if ($_GET['id'] == $key) {
                            if ($_SESSION['cart_item'][$key]['Quantity'] > 1)
                                $_SESSION['cart_item'][$key]['Quantity'] -= 1;
                            else {
                                unset($_SESSION['cart_item'][$key]);
                            }
                        }

                        if (empty($_SESSION['cart_item']))
                            unset($_SESSION['cart_item']);
                    }
                }
            }
            break;

        case "empty": {
                unset($_SESSION['cart_item']);
            }
            break;

        default:
            echo $_GET['action'];
            break;
    }
}
?>
<?php $title = 'Cart'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'Cest'; ?>
<?php require_once('../head.php'); ?>

<body class="container bg-dark">
    <?php require_once('../navbar.php'); ?>
    <main class="container bg-light m-0  vh-80">
        <section class="container w-auto p-3">

            <h1 class="text-center">Shopping Cart</h1>
            <article class="container row d-flex justify-content-center">

                <!-- If Session is set display it -->
                <?php if (isset($_SESSION['cart_item'])) {
                    $total_quantity = 0;
                    $total_price = 0;
                ?>
                    <!-- Empty Cart Button/Link -->
                    <form class="text-end p-2" action="/cart/index.php?action=empty" method="post">
                        <button type="submit" class="btn btn-outline-danger w-auto">Empty Cart</button>
                    </form>
                    <!-- Create Table -->
                    <table class="border border-secondary">
                        <thead class="bg-secondary bg-gradient text-light">
                            <tr>
                                <th class="p-2">Name</th>
                                <th class="p-2 px-0">Product ID</th>
                                <th class="p-2 px-0">Quantity</th>
                                <th class="p-2 px-0">Price</th>
                                <th class="p-2">Remove</th>
                            </tr>
                        </thead>
                        <tbody class="bg-body">
                            <?php foreach ($_SESSION['cart_item'] as $item) { ?>
                                <tr class="h-25">
                                    <td class="w-50"><img class="m-1 mx-3 img-thumbnail rounded-circle" style="width: 64px;" src="../<?= $item['Image'] ?>"> <?= $item['Name'] ?></td>
                                    <td class="w-25"><?= $item['ProductId'] ?></td>
                                    <td class="w-25"><?= $item['Quantity'] ?></td>
                                    <td class="w-25">&dollar;<?= $item['Price'] ?></td>
                                    <td class="text-center m-0 p-0 w-auto"><a class="btn btn-outline-danger p-0 border-0 fs-5" href="index.php?action=remove&id=<?php echo $item["ProductId"]; ?>" class="btnRemoveAction">&#128465;</a></td>
                                    <?php
                                    $total_quantity += $item["Quantity"];
                                    $total_price += ($item["Price"] * $item["Quantity"]);
                                    ?>
                                <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr class="border-top border-secondary">
                                <td colspan="2" class="text-end px-5">Total:</td>
                                <td><?= $total_quantity ?></td>
                                <td class="fw-bold">&dollar;<?= $total_price ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- If session is NOT set, Say Cart is empty -->
                <?php } else { ?>
                    <h5 class="text-center">Cart is empty!</h5>
                <?php } ?>
            </article>
        </section>
    </main>
    <?php require_once('../footer.php'); ?>
</body>

</html>