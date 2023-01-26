<?php

class flavours_widget extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'flavours_widget', // Base ID
			'Saveurs', // Name
			array( 'description' => __( 'Présentation des saveurs pour le site Planty', 'text_domain' ) ) // Args
		);

	}

    // Front-end display
	public function widget($args, $instance) {

        $posts = get_posts([
			'post_type' 	 => 'flavour',
			'posts_per_page' => -1
		]); ?>

		<div class="flavours-container">
			<div class="flavours">
				<?php foreach ($posts as $post) { ?>
				<div class="flavour-item">
					<?php if(has_post_thumbnail($post->ID)) : ?>
						<div class="flavour-background" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID); ?>)">
							<?php
							$title = $post->post_title;
							$length = strlen($title);
							if($length > 8) {
								if($length % 2 == 0){
									$half = $length / 2;
									$first_string = substr($title, 0, $half * -1);
									$second_string = substr($title, $half);
    							} else {
									$first_part = floor($length / 2);
									$second_part = ceil($length / 2);
									$first_string = substr($title, 0, $second_part * -1);
									$second_string = substr($title, $first_part);
								}
								$title = $first_string . '<br>' . $second_string;
							}
							?>
							<p class="flavour-title"><?php echo $title; ?></p>
						</div>
					<?php endif; ?>
				</div>
			<?php } ?>
			</div>
		</div>
		
	<?php }

}

add_action( 'widgets_init', 'register_flavours_widget' );

function register_flavours_widget() {
	register_widget( 'flavours_widget' );
}