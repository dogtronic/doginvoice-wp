<?php
/**
 * Template Name: Kontakt
 *
 * Strona kontaktowa: dane firmy + formularz Contact Form 7.
 * Nagłówek (odznaka, tytuł wyświetlany, lead) pochodzi z pól ACF
 * „Nagłówek strony”, dane firmy i shortcode formularza z grupy
 * „Kontakt: dane firmy i formularz”. Style w src/scss/_contact.scss.
 *
 * @package doginvoice
 */

get_header();

while ( have_posts() ) :
	the_post();

	$page_badge = get_field( 'page_badge' );
	$page_lead  = get_field( 'page_lead' );
	$page_title = doginvoice_page_heading();

	$company_name    = get_field( 'contact_company_name' );
	$company_address = get_field( 'contact_company_address' );
	$company_ids     = get_field( 'contact_company_ids' );
	$contact_email   = get_field( 'contact_email' );
	$contact_phone   = get_field( 'contact_phone' );
	$contact_hours   = get_field( 'contact_hours' );
	$form_title      = get_field( 'contact_form_title' );
	$form_shortcode  = get_field( 'contact_form_shortcode' );

	$phone_href = $contact_phone ? preg_replace( '/[^0-9+]/', '', $contact_phone ) : '';
	?>
	<main class="contact-page" aria-labelledby="contact-page-title">
		<?php doginvoice_breadcrumbs(); ?>
		<header class="contact-page-header" data-aos="fade-up">
			<?php if ( $page_badge ) : ?>
				<span class="contact-page-badge badge badge--beige">
					<span class="badge-text"><?php echo esc_html( $page_badge ); ?></span>
				</span>
			<?php endif; ?>
			<h1 id="contact-page-title" class="contact-page-title typography--h2" data-remove-orphans>
				<?php echo esc_html( $page_title ); ?>
			</h1>
			<?php if ( $page_lead ) : ?>
				<p class="contact-page-lead typography--body-lg" data-remove-orphans>
					<?php echo wp_kses_post( $page_lead ); ?>
				</p>
			<?php endif; ?>
		</header>

		<div class="contact-page-grid">
			<aside class="contact-info" data-aos="fade-up" aria-label="Dane kontaktowe">
				<?php if ( $company_name ) : ?>
					<h2 class="contact-info-title typography--h4"><?php echo esc_html( $company_name ); ?></h2>
				<?php endif; ?>

				<dl class="contact-info-list">
					<?php if ( $contact_email ) : ?>
						<div class="contact-info-item">
							<dt class="contact-info-label typography--body-md">E-mail</dt>
							<dd class="contact-info-value typography--body-lg">
								<a href="mailto:<?php echo esc_attr( antispambot( $contact_email ) ); ?>"><?php echo esc_html( antispambot( $contact_email ) ); ?></a>
							</dd>
						</div>
					<?php endif; ?>

					<?php if ( $contact_phone ) : ?>
						<div class="contact-info-item">
							<dt class="contact-info-label typography--body-md">Telefon</dt>
							<dd class="contact-info-value typography--body-lg">
								<a href="tel:<?php echo esc_attr( $phone_href ); ?>"><?php echo esc_html( $contact_phone ); ?></a>
							</dd>
						</div>
					<?php endif; ?>

					<?php if ( $contact_hours ) : ?>
						<div class="contact-info-item">
							<dt class="contact-info-label typography--body-md">Godziny pracy</dt>
							<dd class="contact-info-value typography--body-md"><?php echo nl2br( esc_html( $contact_hours ) ); ?></dd>
						</div>
					<?php endif; ?>

					<?php if ( $company_address ) : ?>
						<div class="contact-info-item">
							<dt class="contact-info-label typography--body-md">Adres</dt>
							<dd class="contact-info-value typography--body-md">
								<address><?php echo nl2br( esc_html( $company_address ) ); ?></address>
							</dd>
						</div>
					<?php endif; ?>

					<?php if ( $company_ids ) : ?>
						<div class="contact-info-item">
							<dt class="contact-info-label typography--body-md">Dane rejestrowe</dt>
							<dd class="contact-info-value typography--body-md"><?php echo nl2br( esc_html( $company_ids ) ); ?></dd>
						</div>
					<?php endif; ?>
				</dl>
			</aside>

			<div class="contact-form-card" data-aos="fade-up" data-aos-delay="100">
				<?php if ( $form_title ) : ?>
					<h2 class="contact-form-card-title typography--h4"><?php echo esc_html( $form_title ); ?></h2>
				<?php endif; ?>

				<?php
				if ( $form_shortcode ) {
					echo do_shortcode( $form_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} elseif ( current_user_can( 'edit_pages' ) ) {
					echo '<p class="contact-form-card-empty typography--body-md">Wklej shortcode formularza Contact Form 7 w polu „Shortcode formularza” w edycji tej strony.</p>';
				}
				?>
			</div>
		</div>
	</main>
	<?php
endwhile;

get_footer();
