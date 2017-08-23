
 	  <script src="<?=base_url() ?>asset/js/jquery.js"></script>
   <script src="<?php echo base_url()  ?>asset/tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: "link image"
         });
         
</script>

 	    <script src="<?=base_url() ?>asset/datatables/dataTables.bootstrap.js"></script>
 	    <script src="<?=base_url() ?>asset/datatables/jquery.dataTables.js"></script>
 	    <script type="text/javascript">
            $(function() {
                $("#tabel").dataTable();
                  $(".tip").tooltip();
            });
        </script>
        
      <!-- Bootstrap javascript -->
      <script src="<?=base_url() ?>asset/js/bootstrap.min.js"></script>

</body>
</html>
