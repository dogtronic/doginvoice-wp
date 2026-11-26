<?php
/**
 * Front page section: Co robi księgowa, a co pokazuje DogInvoice
 *
 * Minimalistyczna tabela porównawcza. Na mobile wiersze składają się w bloki,
 * a nazwy kolumn pochodzą z atrybutów data-label (src/scss/_accountant.scss).
 *
 * @package doginvoice
 */

$accountant_columns = array( 'Księgowa', 'DogInvoice' );
$accountant_rows    = array(
	array(
		'label'  => 'Co robi',
		'values' => array(
			'prowadzi księgi, rozlicza podatki i wysyła deklaracje',
			'pokazuje nowe faktury z KSeF i to, które z nich są opłacone',
		),
	),
	array(
		'label'  => 'Kiedy widzisz wynik',
		'values' => array(
			'po zamknięciu miesiąca',
			'na bieżąco, na pulpicie',
		),
	),
	array(
		'label'  => 'Jak się kontaktujecie',
		'values' => array(
			'wysyłasz jej dokumenty',
			'na koniec miesiąca wysyłasz jej link do folderu z całym miesiącem',
		),
	),
);
?>
    <!-- ===== KSIĘGOWA A DOGINVOICE ===== -->
    <section
      id="accountant"
      class="accountant max-width"
      aria-labelledby="accountant-title">
      <h2
        id="accountant-title"
        class="accountant-title typography--h3"
        data-remove-orphans
        data-aos="fade-up">
        Co robi księgowa, a co pokazuje DogInvoice
      </h2>

      <table class="accountant-table" data-aos="fade-up">
        <thead>
          <tr>
            <td></td>
            <?php foreach ( $accountant_columns as $accountant_index => $accountant_column ) : ?>
              <th
                scope="col"
                class="accountant-table-col<?php echo 1 === $accountant_index ? ' accountant-table-col--brand' : ''; ?>">
                <?php echo esc_html( $accountant_column ); ?>
              </th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $accountant_rows as $accountant_row ) : ?>
            <tr>
              <th scope="row" class="accountant-table-label">
                <?php echo esc_html( $accountant_row['label'] ); ?>
              </th>
              <?php foreach ( $accountant_row['values'] as $accountant_index => $accountant_value ) : ?>
                <td
                  class="accountant-table-cell<?php echo 1 === $accountant_index ? ' accountant-table-cell--brand' : ''; ?>"
                  data-label="<?php echo esc_attr( $accountant_columns[ $accountant_index ] ); ?>">
                  <?php echo esc_html( $accountant_value ); ?>
                </td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
