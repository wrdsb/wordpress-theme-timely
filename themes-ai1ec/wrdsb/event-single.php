<div class=" timely ai1ec-single-event
	 ai1ec-event-id-<?php echo $event->post_id; ?>
	 <?php if ( $event->get_multiday() ) echo 'ai1ec-multiday'; ?>
	 <?php if ( $event->allday ) echo 'ai1ec-allday'; ?>">

	<a name="ai1ec-event"></a>

	<div class="ai1ec-event-details clearfix container">

		<div class="clearfix" style =""><?php echo $back_to_calendar; ?></div>


		<?php
		$contact_items = array(
			'When' => $event->get_timespan_html(),
			'Where' => $location,
			'Cost' => esc_html( $event->cost ),
			'Contact' => array(
				$event->contact_name, $event->contact_phone, $event->contact_email
			),
			'Grade' => get_wrdsb_terms( 'grades' ),
			'Category' => get_wrdsb_terms( 'programs' ),
			'Tags' => $tags,
		);
		?>

		<div class="ai1ec-contact col-lg-8 col-md-12 col-sm-12 col-xs-12 pull-left">
			<?php
			foreach ( $contact_items as $key => $contact_item ) {

				$class = sanitize_title( $key ) . '-item'
				?>
				<div class ="row contact-info">
					<div class ="pull-left col-lg-2 col-md-2 col-sm-2 col-xs-12 labels <?php echo $class ?>">
						<?php echo _e( $key ) . ': '; ?>
					</div>
					<div class ="values pull-left col-lg-9 col-md-9 col-sm-9 col-xs-12 <?php echo $class ?>">
						<?php
						if ( $key != 'Contact' ) {
							echo $contact_item;
						} else {
							foreach ( $contact_item as $c ) {
								$i++;
								if ( $i == 3 ) {
									$c = '<a href ="mailto:' . $c . '">Email</a>';
								}
								echo '<span class ="contact-group">' . $c . '<br/>' . '</span>';
							}
						}
						?>
					</div>
				</div>
			<?php }
			?>
		</div>
		<?php if ( $map ) : ?>
			<div class="ai1ec-map  col-lg-4 col-md-12 col-sm-12 col-xs-12 pull-right"><?php echo $map; ?></div>
		<?php endif; ?>
	</div>
	<div class ="event-content">
		<a href="<?php esc_attr_e( $event->ticket_url ); ?>" target="_blank"
		   class="register"><i class ='icon-pencil'></i>
			   <?php _e( 'REGISTER' ); ?>
		</a>
		<div class ="entry">
			<?php
			global $post;
			echo apply_filters( 'the_content', $post->post_content );
			?>
			<a href="<?php esc_attr_e( $event->ticket_url ); ?>" target="_blank"
			   class="register"><i class ='icon-pencil'></i>
				   <?php _e( 'REGISTER' ); ?>
			</a>
		</div>
	</div>
	<img class ="footer-image" src ="<?php echo content_url(); ?>/themes-ai1ec/wrdsb/img/event-interior-footer.png">
</div>
<?php

//var_dump( $event );


function get_wrdsb_terms( $type )
{
	$grades_array = array( 'grade-8', 'grade-7', 'grade-7-8', 'highschool' );
	global $post;
	$categories = wp_get_post_terms( $post->ID, 'events_categories' );
	$cat_count = count( $categories );

	foreach ( $categories as $category ) {
		$i++;
		if ( $type == 'grades' ) {
			$cond = in_array( $category->slug, $grades_array );
		}
		if ( $type == 'programs' ) {
			$cond = !in_array( $category->slug, $grades_array );
		}

		if ( $cond ) {
			$term_link = get_term_link( $category->term_id, 'events_categories' );
			$terms .= $category->name . ' ';
		}
	}
	return $terms;
}

//var_dump( $event )
?>