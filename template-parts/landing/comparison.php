<?php
/**
 * Landing: porównanie w tabeli. Tabela ma wygląd sekcji „Co robi księgowa,
 * a co pokazuje DogInvoice” ze strony głównej (src/scss/_accountant.scss).
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_id      = $args['id'];
$lp_rows    = array_values( array_filter( (array) ( $lp_section['rows'] ?? array() ) ) );
$lp_columns = array(
	'a' => trim( (string) ( $lp_section['col_a'] ?? '' ) ),
	'b' => trim( (string) ( $lp_section['col_b'] ?? '' ) ),
);

if ( ! $lp_rows ) {
	return;
}
?>
    <!-- ===== LANDING: PORÓWNANIE ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="lp-section max-width" aria-labelledby="<?php echo esc_attr( $lp_id ); ?>-title">
      <?php doginvoice_landing_head( $lp_section, $lp_id . '-title' ); ?>

      <table class="accountant-table" data-aos="fade-up">
        <thead>
          <tr>
            <td></td>
            <th scope="col" class="accountant-table-col"><?php echo esc_html( $lp_columns['a'] ); ?></th>
            <th scope="col" class="accountant-table-col accountant-table-col--brand"><?php echo esc_html( $lp_columns['b'] ); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $lp_rows as $lp_row ) : ?>
            <tr>
              <th scope="row" class="accountant-table-label"><?php echo esc_html( $lp_row['label'] ?? '' ); ?></th>
              <td class="accountant-table-cell" data-label="<?php echo esc_attr( $lp_columns['a'] ); ?>">
                <?php echo esc_html( $lp_row['a'] ?? '' ); ?>
              </td>
              <td class="accountant-table-cell accountant-table-cell--brand" data-label="<?php echo esc_attr( $lp_columns['b'] ); ?>">
                <?php echo esc_html( $lp_row['b'] ?? '' ); ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
