<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<?php $body_class = is_rtl() ? 'ro-rtl' : ''; ?>
<body <?php body_class($body_class) ?>>
	<div id="ro-main">
		<?php tb_Header(); ?>
