<?php
//Always check to see if session is active (session_status() = 2)
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once('php/dbcontroller.php');
$mysql_login = json_decode(file_get_contents("json/mysql.json"), true);
//DBController constructor requires $servername, $username, $password, $dbname
$db_handle = new DBController($mysql_login['servername'], $mysql_login['username'], $mysql_login['password'], $mysql_login['dbname']);
$result = $db_handle->runQuery("SELECT * FROM shop");
?>

<?php $title = 'Home'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'Home'; ?>
<?php require_once(__DIR__ . '/head.php'); ?>

<body class="container bg-dark">
    <?php require_once(__DIR__ . '/navbar.php'); ?>
    <main class="container bg-light m-0 vh-80">
        <section class="p-3">
            <div class="text-center">
                <h1>Welcome to our Store</h1>
                <h3>Check out some of these limited time specials</h3>
            </div>
            <!-- Special sale items go here -->
            <article class="row d-flex justify-content-center gap-3">
                <?php foreach ($result as $item) { ?>
                    <form class="col-2 text-left d-flex align-items-end flex-column border rounded" action="/cart/index.php?action=add&id=<?= $item['ProductId'] ?>" method="post">

                        <div class="row p-3 mb-auto"><img class="w-100 mx-auto" src="<?= $item['Image'] ?>"></div>
                        <div name="description" class="row d-inline mx-auto"><?= $item['Description'] ?></div>
                        <div class="row d-flex align-items-center mx-auto">&dollar;<?= $item['Price'] ?><button class="btn btn-secondary d-inline w-auto m-0 p-0 px-1 m-1 fs-6" type="submit">Add to Cart</button></div>
                    </form>
                <?php } ?>
            </article>
        </section>
    </main>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>

</html>