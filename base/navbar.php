<html>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

        </div>
        <ul class="nav navbar-top-links navbar-right">


            <?php if ($_SESSION['role'] != 'Customer'): ?>
                <?php include("inc/fetch_low_stocks.php"); ?>

                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>
                        <?php if (!empty($count)): ?>
                            <span class="label label-danger"><?php echo $count; ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <?php foreach ($lowstocks as $ls): ?>
                            <li>
                                <a href="#" class="dropdown-item">
                                    <div>
                                        <i class="fa-solid fa-boxes-stacked"></i>&nbsp; <?php echo $ls['product_name']; ?> Stock
                                        is
                                        low
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                        <?php endforeach; ?>


                        <!-- <li>
                            <div class="text-center link-block">
                                <a href="notifications" class="dropdown-item">
                                    <strong>See All</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li> -->
                    </ul>
                </li>
            <?php endif; ?>


            <li>
                <a href="inc/logout.php">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>

</html>