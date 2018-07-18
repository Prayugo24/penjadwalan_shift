
<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">

        </nav>
        <div class="copyright pull-right">
            &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="https://www.facebook.com/profile.php?id=100005207868295">Prayugo Dwi S</a>
        </div>
    </div>
</footer>

</div>
</div>
</body>

    <!--   Core JS Files   -->

    <script src=<?php echo base_url("assets/js/jquery-1.10.2.js");?> type="text/javascript"></script>


    <!-- untuk modal crud pegawai-->
    <script src=<?php echo base_url("assets/js/crud_pegawai.js");?> type="text/javascript"></script>
    <!-- untuk pencarian tabel -->
    <script src=<?php echo base_url("assets/js/search.js");?> type="text/javascript"></script>

	<script src=<?php echo base_url("assets/js/bootstrap.min.js");?> type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src=<?php echo base_url("assets/js/bootstrap-checkbox-radio.js");?>></script>

	<!--  Charts Plugin -->
	<script src=<?php echo base_url("assets/js/chartist.min.js");?>></script>

    <!--  Notifications Plugin    -->
    <script src=<?php echo base_url("assets/js/bootstrap-notify.js");?>></script>

    <!-- sweet alert -->
    <script src="<?php echo base_url("assets/js/sweetalert.min.js"); ?>"></script>

    <!-- edit jadwal -->
    <script src="<?php echo base_url("assets/js/edit_jadwal.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/edit_all_jadwal.js"); ?>"></script>
    <!-- hapus jadwal -->
    <script src="<?php echo base_url("assets/js/hapus_jadwal.js"); ?>"  type="text/javascript"></script>
    <!-- cetak jadwal -->
    <script src="<?php echo base_url("assets/js/cetak_jadwal.js"); ?>"></script>

    <script src="<?php echo base_url("assets/js/tambah_jadwal.js"); ?>" charset="utf-8"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src=<?php echo base_url("assets/js/paper-dashboard.js");?>></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src=<?php echo base_url("assets/js/demo.js");?>></script>
<?php echo ob_get_clean(); ?>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'ti-gift',
            	message: "Selamat Datang di <b>CV.Trans Jogja</b> "

            },{
                type: 'success',
                timer: 4000
            });

    	});
	</script>


</html>
