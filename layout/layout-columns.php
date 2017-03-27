<?php 
/**
 * Layout type: Columns
 * @since 1.1.0
 **/ 

$attributes = get_section_attributes('settings_', $extra_class = 'section__row' ); // atframe-layout.php
$columns    = (int) get_sub_field('columns');

if ( $columns > 0 ) : ?>

	<section <?= $attributes ?>>
		<div class="container">


			<?php 
			/**
			 * Section title
			 **/ 
			$add_title = get_sub_field('add_title');
			if ( $add_title ) {
				echo get_section_title('title_', 'section__title'); // atframe-layout.php
			} ?>

			<div class="row">


				<?php 
				/**
				 * Generate column markup
				 **/ 

				$i = 0;
				while ( $i < $columns ) :

					// Prepare and retrieve ACF field values from cloned field
				 	$i++;
				 	$column = get_sub_field('column_' . $i);
				 	$column_attributes = get_column_attributes($column, $extra_class = 'section__col entry'); // atframe-layout.php
					?>

					<div <?= $column_attributes ?>>

						<?php if ( isset($column['title']) && $column['title'] !== '' ) : ?>
							<h3 class="section__title--col"><?= $column['title'] ?></h3>
						<?php endif; ?>

						<?= $column['content'] ?>

					</div>

				<?php endwhile; ?>


			</div>
		</div>
	</section>

<?php endif; ?>