<?php
global $tb_options;
$tb_show_page_title = isset($tb_options['tb_page_show_page_title']) ? $tb_options['tb_page_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($tb_options['tb_page_show_page_breadcrumb']) ? $tb_options['tb_page_show_page_breadcrumb'] : 1;

if($tb_show_page_title || $tb_show_page_breadcrumb){
?>
<div class="ro-page-title-shop">
	<div class="container">
		<?php if($tb_show_page_title){  ?>
			<h2 class="page-title"><?php echo ro_woocommerce_page_title(); ?></h2>
		<?php } ?>
		<?php if($tb_show_page_breadcrumb) do_action( 'woocommerce_breadcrumb' ); ?>
	</div>
</div>
<?php
}