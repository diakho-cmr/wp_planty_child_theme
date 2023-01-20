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
		]);
        foreach ( $posts as $post ) {
        ?>
            <div class="product">
                <?php if(has_post_thumbnail($post->ID)) : ?>
                    <?php echo get_the_post_thumbnail($post->ID); ?>
                <?php endif; ?>
                <p><?php echo $post->post_title ?></p>
            </div>
            <?php
        }
	}

}

add_action( 'widgets_init', 'register_flavours_widget' );

function register_flavours_widget() {
	register_widget( 'flavours_widget' );
}