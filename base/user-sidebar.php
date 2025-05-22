<html>
<?php include("inc/fetch_user_info.php"); ?>
<?php
if (!isset($_SESSION['id'])) {
    header('Location: /login.php');
    exit();
}
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <?php if (isset($profile)): ?>
                        <img alt="image" class="rounded-circle" src="assets/img/profile/<?php echo $profile; ?>"
                            style="height: 48px; width: 48px; object-fit: cover;" />
                    <?php else: ?>
                        <img alt="image" class="rounded-circle" src="assets/img/profile/default_profile.jpg"
                            style="height: 48px; width: 48px; object-fit: cover;" />
                    <?php endif; ?>


                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <?php if (isset($name)): ?>
                            <span class="block m-t-xs font-bold"><?php echo $name; ?></span>
                        <?php else: ?>
                            <span class="block m-t-xs font-bold">Name</span>
                        <?php endif; ?>
                        <?php if (isset($roles)): ?>
                            <span class="text-white text-xs block"><?php echo $roles; ?></span>
                        <?php else: ?>
                            <span class="text-white text-xs block">Roles</span>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="logo-element">
                    QYEA
                </div>
            </li>

            <!-- Dashboard -->
            <!-- <li <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
                echo ' class="active"';
            } ?>>
                <a href="dashboard"><i class="fa-solid fa-chart-simple"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li> -->

            
            <!-- Shop -->
            <li>
                <a href="shop"><i class="fa-solid fa-shop"></i> <span class="nav-label">Shop</span></a>
            </li>
            
            <!-- Orders -->
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'orders.php') {
                echo ' class="active"';
            } ?>>
                <a href="orders"><i class="fa-solid fa-cart-shopping"></i> <span class="nav-label">Orders</span></a>
            </li>



            <!-- Settings -->


            <li <?php if (basename($_SERVER['PHP_SELF']) == 'user-settings.php') {
                echo ' class="active"';
            } ?>>
                <a href="user-settings"><i class="fa-solid fa-gear"></i> <span class="nav-label">Settings</span></a>
            </li>

            <li <?php if (basename($_SERVER['PHP_SELF']) == 'shipping-address.php') {
                echo ' class="active"';
            } ?>>
                <a href="shipping-address"><i class="fa-solid fa-location-dot"></i> <span class="nav-label">Shipping Address</span></a>
            </li>

            <!-- Logout -->
            <li>
                <a href="inc/logout"><i class="fa-solid fa-right-from-bracket"></i> <span
                        class="nav-label">Logout</span></a>
            </li>




        </ul>

    </div>
</nav>

</html>