<?php
/**
 * Single project partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php //understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->


	<div class="entry-content">
		<div class="row">
			<?php if (has_post_thumbnail()) : ?>
				<div class="col-md-6">
					<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
				</div>
				<div class="col-md-6">
			<?php else:?>
				<div class="col-md-12">	
			<?php endif;?>			
				<?php the_field('description')?>
				<div class="cc-license">
					<?php echo license_badge();?>
				</div>
			</div>	
		</div>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->
	<!-- project extras -->
	<div class="row padded">
		<div class="col-md-12">			
			<?php herald_get_repeater ('Student Learning Outcomes', 'student_learning_outcomes', 'learner_outcome');?>
		</div>

		<div class="col-md-4">			
			<?php herald_get_repeater ('Pre-requisites', 'pre-requisites', 'pre-requisite_item');?>
		</div>
		<div class="col-md-4">
			<?php herald_get_repeater('Resources Needed', 'resources', 'resource_needed');?>
		</div>
		<div class="col-md-4">
			<?php herald_get_repeater('Student Characteristics', 'student_characteristics', 'student_characteristic');?>
		</div>
		<div class="col-md-6">
			<?php herald_get_users('Builders');?>
		</div>

	</div>

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
