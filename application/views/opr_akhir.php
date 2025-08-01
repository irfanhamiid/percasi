                </div>
            </div>
        </div>
    </div>
</div>

  <script src="<?= base_url();?>cssjs_materio/jquery.js"></script>
  <script src="<?= base_url();?>cssjs_materio/popper.js"></script>
  <script src="<?= base_url();?>cssjs_materio/bootstrap.js"></script>
  <script src="<?= base_url();?>cssjs_materio/node-waves.js"></script>
  <script src="<?= base_url();?>cssjs_materio/perfect-scrollbar.js"></script>
  <script src="<?= base_url();?>cssjs_materio/hammer.js"></script>
  <script src="<?= base_url();?>cssjs_materio/i18n.js"></script>
  <script src="<?= base_url();?>cssjs_materio/typeahead.js"></script>
  <script src="<?= base_url();?>cssjs_materio/menu.js"></script>
  <script src="<?= base_url();?>cssjs_materio/main.js"></script>
  <?php
  if ($TimeLine==1)
  {
	  ?>
  <script src="<?= base_url();?>cssjs_materio/extended-ui-timeline.js"></script>
  <?php
  }
  ?>
  <script src="<?= base_url();?>dttable_new/dataTables.js"></script>
  <script src="<?= base_url();?>dttable_new/dataTables.buttons.js"></script>
  <script src="<?= base_url();?>dttable_new/buttons.dataTables.js"></script>
  <script src="<?= base_url();?>dttable_new/jszip.min.js"></script>
  <script src="<?= base_url();?>dttable_new/pdfmake.min.js"></script>
  <script src="<?= base_url();?>dttable_new/vfs_fonts.js"></script>
  <script src="<?= base_url();?>dttable_new/buttons.html5.min.js"></script>
  <script src="<?= base_url();?>dttable_new/buttons.print.min.js"></script>
  <script src="<?= base_url();?>ckeditor/ckeditor.js"></script>
  <script>
  <!-- Page JS -->
  <script src="<?= base_url();?>cssjs_all/sweetalert2.all.min.js"></script>
  <script src="<?= base_url();?>cssjs_all/id.verify.notify.js"></script>
  <script src="<?= base_url();?>ckeditor/ckeditor.js"></script>
  <script>
	$(document).ready(function() {
		new DataTable('#dataTable', {
		layout: {
			topStart: {
				buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
			}
		}
		});
	})
  <?php
	if ($_SESSION['POPUP_MSG']!='')
	{
		?>
	  swal.fire ({
			title: 'Info',
			html: '<?= $_SESSION['POPUP_MSG'];?>',      
			icon: '<?= $_SESSION['POPUP_CLR'];?>',                 
			  })
		<?php
		$_SESSION['POPUP_MSG']='';
	}
	?>
  </script>
</body>

</html>