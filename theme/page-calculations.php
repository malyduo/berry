<?php
/*
Template Name: Calculations Display
*/

get_header();

$file = get_template_directory() . '/calculations.csv';
?>
	<section id="primary">
		<main id="main">
			<div class="container mx-auto">
				<table class="min-w-full bg-white border border-gray-200 shadow-md">
					<thead>
					<tr>
						<th class="py-2 px-4 border-b">Data</th>
						<th class="py-2 px-4 border-b">IP</th>
						<th class="py-2 px-4 border-b">Działanie</th>
						<th class="py-2 px-4 border-b">Wynik</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (file_exists($file)) {
						$rows = array_reverse(file($file));
						foreach ($rows as $row) {
							$data = str_getcsv($row);
							echo '<tr>';
							foreach ($data as $cell) {
								echo '<td class="py-2 px-4 border-b">' . esc_html($cell) . '</td>';
							}
							echo '</tr>';
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</main>
	</section>
<?php
get_footer();
