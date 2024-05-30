</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="color: #2d3032;">
    <!-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> -->
    © Copyright <strong>BTP</strong> Construction
    <div class="float-right d-none d-sm-inline-block">
      <b>.2024</b> 
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>



<script src="<?=base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.js') ?>"></script>

<script>
  function maj(){
    $.ajax({
      url:'/web/maj-data-btp',
      method:'GET',
      success: function(response){
        console.log("Okey data maj");
      },
      error:function(xhr,status,error){
        console.error('Erreur maj',error);
      }
    });
  }
  //20 min io
  setInterval(maj,1200000);
  //setInterval(maj,15000); //15secondsds
</script>
</body>
</html>
