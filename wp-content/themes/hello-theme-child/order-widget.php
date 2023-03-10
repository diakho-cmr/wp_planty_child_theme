<?php

function planty_register_order_widget() {
	register_widget('planty_order_widget');
}

add_action('widgets_init', 'planty_register_order_widget');

class planty_order_widget extends WP_Widget {

	function __construct() {

		parent::__construct(
		// widget ID
			'planty_order_widget',
			// widget name
			__('Commande', ' planty_widget_domain'),
			// widget description
			array('description' => __('Formulaire de commande pour le site Planty', 'planty_widget_domain'),)
		);

	}

	/** FRONT FINAL */
	public function widget($args, $instance) {

		$posts = get_posts([
			'post_type' => 'flavour',
			'posts_per_page' => -1
		]);

		if(isset($GLOBALS['success']) && $GLOBALS['success'] == true) { ?>

		<div class="success-container">
			<p class="success-msg">Nous vous remercions pour votre commande ! Un courriel de confirmation vous a été envoyé.</p>
		</div>

		<?php } ?>
        
		<form action="#" method="POST" id="order-form">

			<?php wp_nonce_field('order', 'order-verif', true, true) ?>
            <input type="text" name="order-mail" value="<?php echo $instance['mail'] ?>" hidden="hidden"/>
            <h3 class="order-title">Votre commande</h3>
            <div id="products">
	            <?php foreach ($posts as $post) { ?>
                <div class="product">
                    <?php echo get_the_post_thumbnail($post->ID); ?>
                    <div class="quantities">
						<div class="inc-dec-number">
							<div class="number">
								<input name="<?php echo $post->post_name; ?>" type="text" readonly value="0">
							</div>
							<div class="inc-dec">
								<button type="button" id="top-button" onclick="inc('<?php echo $post->post_name; ?>')">+</button>
								<button type="button" id="bottom-button" onclick="dec('<?php echo $post->post_name; ?>')">-</button>
							</div>
						</div>
						<div class="ok-number">
							<button type="button" class="ok-number-button">OK</button>
						</div>
					</div>
                </div>
                <?php } ?>
            </div>
			<hr>
             <div id="informations-client">
                <div id="informations">
                    <h3 class="order-title">Vos informations</h3>
                    <label for="nom" class="order-label">Nom</label>
                    <input type="text" name="nom" class="order-input">
                    <label for="prenom" class="order-label">Prénom</label>
                    <input type="text" name="prenom" class="order-input">
                    <label for="email" class="order-label">E-mail</label>
                    <input type="text" name="email" class="order-input">
                </div>
                <div id="livraison">
                    <h3 class="order-title">Livraison</h3>
                    <label for="adresse" class="order-label">Adresse de livraison</label>
                    <input type="text" name="adresse" class="order-input">
                    <label for="code-postal" class="order-label">Code postal</label>
                    <input type="text" name="code-postal" class="order-input">
                    <label for="ville" class="order-label">Ville</label>
                    <input type="text" name="ville" class="order-input">
                </div>
            </div>
			<div class="submit-container">
				<button type="submit" name="send-order" id="send-order">Commander</button>
			</div>
        </form>
    <?php }

	public function form($instance) {

		if (isset($instance['mail'])) 
			$mail = $instance['mail'];
		else
			$mail = __('planty.drinks@gmail.com,', 'planty_widget_domain'); ?>
        <p>
            <label for="<?php echo $this->get_field_id('mail'); ?>"><?php _e('Mail de réception de commande :'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>"
                   name="<?php echo $this->get_field_name('mail'); ?>" type="text"
                   value="<?php echo esc_attr($mail); ?>"/>
        </p>

	<?php }

	public function update($new_instance, $old_instance) {

		$instance = array();
		$instance['mail'] = (!empty($new_instance['mail'])) ? strip_tags($new_instance['mail']) : '';
		return $instance;

	}

}

function traitement_formulaire_order() {

	$GLOBALS['success'] = false;
	$success = false;

	if (isset($_POST['send-order']) && isset($_POST['order-verif']))  {

		if (wp_verify_nonce($_POST['order-verif'], 'order')) {
			$flavours = get_posts([
				'post_type' => 'flavour',
				'posts_per_page' => -1
			]);

			if(!empty($flavours)) {
				$quantities = '<ul>';
				foreach ($flavours as $flavour) {
					if(!empty($_POST[$flavour->post_name])) {
						$quantities .= '<li>'. $flavour->post_name . ' : ' . $_POST[$flavour->post_name] . '</li>';
					}
				}
				$quantities .= '</ul>';
			}

			$form_fields = [
				'nom',
				'prenom',
				'email',
				'adresse',
				'code-postal',
				'ville'
			];
			
			$client_informations = '<ul>';
			foreach($form_fields as $field) {
				if(isset($_POST[$field]) && !empty($_POST[$field])) {
					$client_informations .= '<li>'. $field . ' : ' . $_POST[$field] . '</li>';
				}
			}
			$client_informations .= '</ul>';

			$message = '<div>
			<h1>Nouvelle commande Planty</h1>'
			. $quantities . $client_informations .
			'</div>';

			$to = $_POST['order-mail'];
			$subject = 'Commande Planty';
			$headers = array('Content-Type: text/html; charset=UTF-8', 'From: Planty <diakho.camara@opsone.net>');

			$GLOBALS['success'] = wp_mail($to, $subject, $message, $headers);
		}
	}
}
add_action('template_redirect', 'traitement_formulaire_order');