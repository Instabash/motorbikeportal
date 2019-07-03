<?php
session_start();
include '../../includes/restrictions.inc.php';
vendor_protect();
include '../../includes/header.php';
include '../../includes/dbh.inc.php';
?>
<!-- Sidebar -->
<label href="#" class="list-group-item" style="width: auto;">Vendor Panel
	<button class="btn" id="menu-toggle"><i class="fas fa-bars"></i></button>
</label>
<div class="d-flex" id="wrapper">
	<div class="bg-light border-right" id="sidebar-wrapper">
		<div class="list-group list-group-flush">
			<a href="/BikeLabs/pages/vendor/vendordash.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
            <a href="/BikeLabs/pages/vendor/vendor-orders.php" class="list-group-item list-group-item-action bg-light">Pending Orders</a>
            <a href="/BikeLabs/pages/vendor/vendor-modalt.php" class="list-group-item list-group-item-action bg-light">Pending Mod/Alt Orders</a>
            <a href="/BikeLabs/pages/vendor/vendor-modaltprocessed.php" class="list-group-item list-group-item-action bg-light">Processed Mod/Alt Orders</a>
            <a href="/BikeLabs/pages/vendor/vendor-sales.php" class="list-group-item list-group-item-action bg-light">Sales</a>
            <a href="/BikeLabs/pages/vendor/vendor-bikes.php" class="list-group-item list-group-item-action bg-light">Add new Bikes</a>
            <a href="/BikeLabs/pages/vendor/vendor-parts.php" class="list-group-item list-group-item-action bg-light">Add new Parts</a>
            <a href="/BikeLabs/pages/vendor/vendor-modaltpkg.php" class="list-group-item list-group-item-action bg-light">View Mod/Alt packages</a>
        </div>
    </div>
   <section class="section modsection content content2" style="width: 100%;">
        <div class="container">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Current Mod/Alt Packages</h3>
                </div>
            </div>
        </div>

        <div class="row pt-4" style="width: 100%;padding-left:5%">
            <!-- Left col -->
            <div class="col-sm-6 ">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Current Modification packages</h3>
                    </div><br>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive pl-4">
                            <h5 class="box-title"><b>Package 1</b></h5>
                            <br><br>
                            <?php
                            $sql = "SELECT * FROM modaltpackages WHERE map_pkg_1 = 1 AND map_type = 'modification' ";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) 
                                {?>
                                    <div class="row pl-4 pt-1 pb-1 border" style="width: 100%;">
                                        <div class="altright">
                                            <input type="text" value="<?php echo $row['map_name']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose"></input>
                                     </div>
                                     <div class="altright">
                                        <input type="text" value="<?php echo $row['map_price']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose"></input>
                                    </div>
                                </div>
                            <?php }
                            ?>
                            <br>
                        </div>

                        <div class="table-responsive pl-4 ">
                            <h5 class="box-title"><b>Package 2</b></h5>
                            <br><br>
                            <?php
                            $sql = "SELECT * FROM modaltpackages WHERE map_pkg_2 = 1 AND map_type = 'modification'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) 
                                {?>
                                    <div class="row pl-4 pt-1 pb-1 border" style="width: 100%;">
                                        <div class="altright">
                                         <input type="text" value="<?php echo $row['map_name']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose2"></input>
                                     </div>
                                     <div class="altright">
                                        <input type="text" value="<?php echo $row['map_price']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose2"></input>
                                    </div>
                                </div>
                            <?php }
                            ?>
                            <br>
                        </div>

                        <div class="table-responsive pl-4">
                            <h5 class="box-title"><b>Package 3</b></h5>
                            <br><br>
                            <?php
                            $sql = "SELECT * FROM modaltpackages WHERE map_pkg_3 = 1 AND map_type = 'modification'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) 
                                {?>
                                    <div class="row pl-4 pt-1 pb-1 border" style="width: 100%;">
                                        <div class="altright">
                                         <input type="text" value="<?php echo $row['map_name']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose3"></input>
                                     </div>
                                     <div class="altright">
                                        <input type="text" value="<?php echo $row['map_price']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose3"></input>
                                    </div>
                                </div>
                            <?php }
                            ?>
                            <br>
                        </div>

                        <div class="table-responsive pl-4">
                            <h5 class="box-title"><b>Package 4</b></h5>
                            <br><br>
                            <?php
                            $sql = "SELECT * FROM modaltpackages WHERE map_pkg_4 = 1 AND map_type = 'modification'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) 
                                {?>
                                    <div class="row pl-4 pt-1 pb-1 border" style="width: 100%;">
                                        <div class="altright">
                                         <input type="text" value="<?php echo $row['map_name']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose4"></input>
                                     </div>
                                     <div class="altright">
                                        <input type="text" value="<?php echo $row['map_price']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose4"></input>
                                    </div>
                                </div>
                            <?php }
                            ?>
                            <br>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
                <br>
            </div>
            <!-- /.box -->
        </div>
        <div class="col-sm-6 ">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Current Alteration packages</h3>
                </div><br>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive pl-4">
                        <h5 class="box-title"><b>Package 1</b></h5>
                        <br><br>
                        <?php
                        $sql = "SELECT * FROM modaltpackages WHERE map_pkg_1 = 1 AND map_type = 'alteration'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) 
                            {?>
                                <div class="row pl-4 pt-1 pb-1 border" style="width: 100%;">
                                    <div class="altright">
                                     <input type="text" value="<?php echo $row['map_name']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose5"></input>
                                 </div>
                                 <div class="altright">
                                    <input type="text" value="<?php echo $row['map_price']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose5"></input>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <br>
                    </div>

                    <div class="table-responsive pl-4 ">
                        <h5 class="box-title"><b>Package 2</b></h5>
                        <br><br>
                        <?php
                        $sql = "SELECT * FROM modaltpackages WHERE map_pkg_2 = 1 AND map_type = 'alteration'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) 
                            {?>
                                <div class="row pl-4 pt-1 pb-1 border" style="width: 100%;">
                                    <div class="altright">
                                     <input type="text" value="<?php echo $row['map_name']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose6"></input>
                                 </div>
                                 <div class="altright">
                                    <input type="text" value="<?php echo $row['map_price']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose6"></input>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <br>
                    </div>

                    <div class="table-responsive pl-4">
                        <h5 class="box-title"><b>Package 3</b></h5>
                        <br><br>
                        <?php
                        $sql = "SELECT * FROM modaltpackages WHERE map_pkg_3 = 1 AND map_type = 'alteration'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) 
                            {?>
                                <div class="row pl-4 pt-1 pb-1 border" style="width: 100%;">
                                    <div class="altright">
                                     <input type="text" value="<?php echo $row['map_name']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose7"></input>
                                 </div>
                                 <div class="altright">
                                    <input type="text" value="<?php echo $row['map_price']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose7"></input>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <br>
                    </div>

                    <div class="table-responsive pl-4">
                        <h5 class="box-title"><b>Package 4</b></h5>
                        <br><br>
                        <?php
                        $sql = "SELECT * FROM modaltpackages WHERE map_pkg_4 = 1 AND map_type = 'alteration'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) 
                            {?>
                                <div class="row pl-4 pt-1 pb-1 border" style="width: 100%;">
                                    <div class="altright">
                                     <input type="text" value="<?php echo $row['map_name']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose8"></input>
                                 </div>
                                 <div class="altright">
                                    <input type="text" value="<?php echo $row['map_price']; ?>" disabled style="background-color: transparent;border: none" class="textfieldToClose8"></input>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <br>
                    </div>

                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <br>
            </div>
            <!-- /.box -->
        </div>

      </div>


  </section>
</div>

<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
    <?php
    include_once '../../includes/footer.php';
    ?>