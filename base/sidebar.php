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
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
                echo ' class="active"';
            } ?>>
                <a href="dashboard"><i class="fa-solid fa-chart-simple"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>

            <!-- Shop -->
            <li>
                <a href="shop"><i class="fa-solid fa-shop"></i> <span class="nav-label">Shop</span></a>
            </li>



            <!-- Sales -->
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'sales.php' || basename($_SERVER['PHP_SELF']) == 'cashflow.php' || basename($_SERVER['PHP_SELF']) == 'total-cashflow.php') {
                echo ' class="active"';
            } ?>>
                <a href="#"><i class="fa-solid fa-scale-unbalanced"></i> <span class="nav-label">Sales</span><span
                        class="fa arrow"></a>
                <ul class="nav nav-second-level collapse">

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'sales.php') {
                        echo ' class="active"';
                    } ?>><a
                            href="sales">Sales</a></li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'cashflow.php') {
                        echo ' class="active"';
                    } ?>><a       href="cashflow">Cashflow</a></li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'total-cashflow.php') {
                        echo ' class="active"';
                    } ?>><a href="total-cashflow">Total Cashflow</a></li>

                </ul>
            </li>

            <!-- Orders -->
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'pending-orders.php' || basename($_SERVER['PHP_SELF']) == 'orders.php' || basename($_SERVER['PHP_SELF']) == 'completed-orders.php' || basename($_SERVER['PHP_SELF']) == 'rejected-orders.php' || basename($_SERVER['PHP_SELF']) == 'manage-order.php' || basename($_SERVER['PHP_SELF']) == 'view-order.php') {
                echo ' class="active"';
            } ?>>
                <a href="#"><i class="fa-solid fa-cash-register"></i> <span class="nav-label">Orders</span><span
                        class="fa arrow"></a>
                <ul class="nav nav-second-level collapse">


                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'pending-orders.php') {
                        echo ' class="active"';
                    } ?>>
                        <a href="pending-orders">Pending Orders</a>
                    </li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'orders.php') {
                        echo ' class="active"';
                    } ?>><a
                            href="orders">Orders</a></li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'completed-orders.php') {
                        echo ' class="active"';
                    } ?>>
                        <a href="completed-orders">Completed Orders</a>
                    </li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'rejected-orders.php') {
                        echo ' class="active"';
                    } ?>>
                        <a href="rejected-orders">Rejected Orders</a>
                    </li>

                </ul>
            </li>

            <!-- Products -->
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'add-products.php' || basename($_SERVER['PHP_SELF']) == 'products-list.php' || basename($_SERVER['PHP_SELF']) == 'add-tags.php') {
                echo ' class="active"';
            } ?>>
                <a href="#"><i class="fa-solid fa-tag"></i> <span class="nav-label">Products</span><span
                        class="fa arrow"></a>
                <ul class="nav nav-second-level collapse">

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'add-products.php') {
                        echo ' class="active"';
                    } ?>><a       href="add-products">Add Product</a></li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'add-tags.php') {
                        echo ' class="active"';
                    } ?>><a       href="add-tags">Add Tags</a></li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'products-list.php') {
                        echo ' class="active"';
                    } ?>><a       href="products-list">Product List</a></li>

                </ul>
            </li>

            <!-- Supplies -->
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'add-supplies.php' || basename($_SERVER['PHP_SELF']) == 'supplies-list.php') {
                echo ' class="active"';
            } ?>>
                <a href="#"><i class="fa-solid fa-box-open"></i> <span class="nav-label">Supplies</span><span
                        class="fa arrow"></a>
                <ul class="nav nav-second-level collapse">

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'add-supplies.php') {
                        echo ' class="active"';
                    } ?>><a       href="add-supplies">Add Supplies</a></li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'supplies-list.php') {
                        echo ' class="active"';
                    } ?>><a       href="supplies-list">Supplies List</a></li>

                </ul>
            </li>



            <!-- Users -->
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'users-list.php' || basename($_SERVER['PHP_SELF']) == 'add-users.php' || basename($_SERVER['PHP_SELF']) == 'edit-users.php') {
                echo ' class="active"';
            } ?>>
                <a href="#"><i class="fa-solid fa-users"></i></i> <span class="nav-label">Users</span><span
                        class="fa arrow"></a>
                <ul class="nav nav-second-level collapse">

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'add-users.php') {
                        echo ' class="active"';
                    } ?>><a       href="add-users">Add Users</a></li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'users-list.php') {
                        echo ' class="active"';
                    } ?>><a       href="users-list">Users List</a></li>

                </ul>
            </li>

            <!-- Settings -->
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'user-settings.php' || basename($_SERVER['PHP_SELF']) == 'web-settings.php') {
                echo ' class="active"';
            } ?>>
                <a href="#"><i class="fa-solid fa-gear"></i> <span class="nav-label">Settings</span><span
                        class="fa arrow"></a>
                <ul class="nav nav-second-level collapse">

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'user-settings.php') {
                        echo ' class="active"';
                    } ?>><a       href="user-settings">User Settings</a></li>

                    <li <?php if (basename($_SERVER['PHP_SELF']) == 'web-settings.php') {
                        echo ' class="active"';
                    } ?>><a       href="web-settings">Web Settings</a></li>

                    <!-- <li <?php if (basename($_SERVER['PHP_SELF']) == 'history.php') {
                        echo ' class="active"';
                    } ?>><a       href="history">History</a></li> -->

                </ul>
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