<li><a class="nav-link page-scroll" href="/">Home</a></li>
<li><a class="nav-link page-scroll" href="about">About</a></li>
<li><a class="nav-link" href="shop">Shop</a></li>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php include("inc/fetch_cart_count.php"); ?>
<?php if (empty($_SESSION['id'])): ?>
    <li><a class="nav-link" href="login">Login</a></li>
<?php elseif (!empty($_SESSION['id']) && ($_SESSION['role'] != 'Customer')): ?>
    <li><a class="nav-link" href="/dashboard">Dashboard</a></li>
    <li><a class="nav-link" href="inc/logout">Logout</a></li>
<?php else: ?>
    <li><a class="nav-link" href="/orders">Orders</a></li>
    <li>
        <a class="nav-link" href="cart">Cart <i class="fa-solid fa-cart-shopping"></i><sup><?php echo $cart; ?></sup></a>
    </li>
    <li><a class="nav-link" href="inc/logout">Logout</a></li>

<?php endif; ?>