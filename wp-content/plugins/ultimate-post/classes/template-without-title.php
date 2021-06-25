<?php
defined('ABSPATH') || exit;

get_header();
$width = ultimate_post()->get_setting('container_width');
$width = $width ? $width : '1140';
?>
<div class="ultp-template-container" style="margin:0 auto;max-width:<?php echo $width;?>px; padding: 0 15px">
	<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	?>
</div>
<?php
get_footer();