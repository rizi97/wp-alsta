<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
		if( is_front_page() ) {
			wp_enqueue_style( 'chld_custom_body', trailingslashit( get_stylesheet_directory_uri() ) . '/assets/body.css', array(), '0.1.0', 'all' );
		wp_enqueue_script( 'chld_custom_body', trailingslashit( get_stylesheet_directory_uri() ) . '/assets/body.js', array(), '1.0.0', true );
		}
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );



add_shortcode("technical_data", function() {

	$prd_ID = get_the_ID();
	$prd_title = get_the_title( $prd_ID );

	$st_check = get_field("specification_table");
	
	if( $st_check ) 
	{

		$st_desc = get_field("st_description");

?>

	<style>
		.technical-desktop-table td,
		.technical-mob-table td {
			vertical-align: middle;
			font-size: 13px;
		}
		.technical-desktop-table td p {
			color: #0872ae;
			text-align: center;
		}
		.technical-desktop-table th {
			vertical-align: middle;
			font-size: 14px;
			background-color: #e2e2e2;
			font-weight: normal;
			line-height: 21px;
		}
		.technical-desktop-table tr td:nth-child(even) {
			background-color: #eaeaea;
		}
		.technical-mob-table th {
			vertical-align: middle;
			color: #0872ae;
			font-size: 14px;
			font-weight: normal;
			text-align: left;
		}
		.technical-mob-table tr:nth-child(odd) td{
			background-color: #f4f4f4;
		}
		.technical-mob-table td p {
			margin-bottom: 0;
		}
		.technical-mob-table {
			display: none;
		}

		@media screen and (max-width: 567px) {
			.technical-desktop-table {
				display: none
			}
			.technical-mob-table {
				display: block;
			}
		}
	</style>

			<table class="technical-desktop-table" width="100%">
				<tbody>
				<tr style="background-color: #2F2E4A; color: #fff">
					<td colspan="9"> <?= $prd_title; ?> Product Specifications</td>
				</tr>
				<tr>
					<td style="text-align: left" colspan="9">
					 	<?= $st_desc; ?>
					</td>
				</tr>
				<tr>
					<?php
						if( have_rows('st_table_content') ):
							while( have_rows('st_table_content') ) : the_row();
					?>
								<th>
									<?= get_sub_field('st_heading'); ?>
								</th>
					<?php
							endwhile;
						endif;
					?>
				</tr>
				<tr>
					<?php
						if( have_rows('st_table_content') ):
							while( have_rows('st_table_content') ) : the_row();
					?>
								<td>
									<?= get_sub_field('st_content'); ?>
								</td>
					<?php
							endwhile;
						endif;
					?>
				</tr>
				</tbody>
			</table>

			<table class="technical-mob-table" style="width: 100%;">
				<tbody>
				<tr>
					<td style="background-color: #2F2E4A; color: #fff" colspan="2"><?= $prd_title; ?> Product Specification</td>
				</tr>
				<tr>
					<td colspan="2">
						<?= $st_desc; ?>
					</td>
				</tr>

				<?php
					if( have_rows('st_table_content') ):
						while( have_rows('st_table_content') ) : the_row();
				?>
					<tr>
						<th><?= get_sub_field('st_heading'); ?></th>
						<td><?= get_sub_field('st_content'); ?></td>
					</tr>
				<?php
						endwhile;
					endif;
				?>
				
				</tbody>
			</table>
<?php

	}



$files_check       = get_field("files_for_product_data");
$files_promo_check = get_field("files_for_promo_data");

if( $files_check || $files_promo_check) 
{

		$format_img = array(
			"https://alumicor.com/wp-content/uploads/2021/06/word-file.png",
			"https://tubeliteinc.com/wp-content/uploads/2018/05/dwg-file.jpg",
			"https://tubeliteinc.com/wp-content/uploads/2018/05/PDF-file.png"
		);

?>

	<style>
		.panels {
			justify-content: space-between;
			margin: 5% 0
		}
		.panels .elementor-col-50 {
			border: 1px solid #cccccc;
			max-height: 60px;
			width: 45%;
		}
		.panels .elementor-col-50.is-clicked {
			max-height: inherit;
		}
		.panels h4.panel-title {
			color: #0872ae;
			font-size: 18px;
			padding: 15px 45px;
			cursor: pointer
		}
		.panels .collapse {
			margin: 0 20px;
		}
		.panels .collapse tr {
			border: none;
		}
		.panels .collapse tr td {
			font-size: 14px;
			border: none;
			border-bottom: 1px solid #ccc;
			color: #0872ae;
			width: 50%;
		}
		.panels .promo_data .collapse tr td {
			vertical-align: middle;
		}
		.panels .promo_data .collapse tr td a{
			display: block
		}
		.panels .collapse tr td  img {
			width: 11%
		}
		.panels .promo_data .collapse tr td img {
			width: 45%
		}
		.panels .collapse tr .specsub {
			text-indent: 25px;
			color: #888888;
		}
		.panels .collapse.hide {
			display: none;
		}

		@media screen and (max-width: 567px) {
			.panels h4.panel-title {
				padding: 15px 30px;
			}
			.panels .elementor-col-50 {
				max-height: inherit;
				width: 100%;
				margin-top: 5%;
			}
			.panels .promo_data .collapse tr td:first-child {
				width: 30%
			}
			.panels .promo_data .collapse tr td img {
				width: 100%
			}
			.panels .promo_data .collapse tr td:last-child {
				width: 70%
			}
		}
		
	</style>


	<div class="elementor-row panels">
		
<?php
	
	if( $files_check ) 
	{
?>

		<div class="elementor-col-50 product_data is-clicked">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?= $prd_title; ?> Product Data
				</h4>
			</div>
			<div class="panel-collapse collapse">
				<table style="width: 100%; border: none;">
					<tbody>
					
					<?php
						if( have_rows('product_data_content') ):
							while( have_rows('product_data_content') ) : the_row();

							$parent_media     = get_sub_field('pd_media');
        					$parent_media_acc = get_sub_field('pd_media_access');
							$parent_media_url = ( $parent_media ) ? get_sub_field('pd_media')['url'] : '';
							$filteredURL      = strtok($parent_media_url, "?");
							$media_ext        = ( $filteredURL ) ? pathinfo( $filteredURL )['extension'] : '';
							$icon             = ( $parent_media ) ? get_sub_field('pd_media')['icon'] : '';

							if( $media_ext === 'doc' || $media_ext === 'docx') {
								$icon = $format_img[0];
							}
							else if( $media_ext === 'zip' || $media_ext === 'gzip') {
								$icon = $format_img[1];
							}
							else if( $media_ext === 'pdf') {
								$icon = $format_img[2];
							}
							

							$files_sub_heading_check = get_sub_field("pd_need_sub_headings");

					?>
								<tr>
									<td <?= ( $files_sub_heading_check ) ? "colspan='2'" : ''; ?>>
										<?= get_sub_field('pd_heading'); ?>
									</td>
					<?php
									
									if( $files_sub_heading_check ) {

										if( have_rows('sub_heading_content') ):
											while( have_rows('sub_heading_content') ) : the_row();

											$sub_media        = get_sub_field('pd_sub_media');
                                        	$sub_media_acc    = get_sub_field('pd_sub_media_access');
											$sub_media_url    = ( $sub_media ) ? get_sub_field('pd_sub_media')['url'] : '';
											$filteredURL      = strtok($sub_media_url, "?");
											$media_ext        = ( $filteredURL ) ? pathinfo( $filteredURL )['extension'] : '';
											$icon             = ( $sub_media ) ? get_sub_field('pd_sub_media')['icon'] : '';

											if( $media_ext === 'doc' || $media_ext === 'docx') {
												$icon = $format_img[0];
											}
											else if( $media_ext === 'zip' || $media_ext === 'gzip') {
												$icon = $format_img[1];
											}
											else if( $media_ext === 'pdf') {
												$icon = $format_img[2];
											}
					?>						
												<tr>
													<td class="specsub">
														<?= get_sub_field('pd_sub_heading'); ?>
													</td>
													<td align="right">
                                                        <?php 
                                                            if( $sub_media_acc ) {
                                                        ?>
                                                                <a href="<?= $sub_media_url; ?>"
                                                                    target="_blank">
                                                                    <img src="<?= $icon; ?>" />
                                                                </a>
                                                        <?php 
                                                            } else {
                                                        ?>
                                                            	<a href="#" class="need_permission">
                                                                    <img src="<?= $icon; ?>" />
                                                                </a>
                                                        <?php 
                                                            } 
                                                        ?>
													</td>
												</tr>
					<?php
											endwhile;
										endif;

									} 
									else {
					?>
										<td align="right">
                        					<?php 
                                                if( $parent_media_acc ) {
                                            ?>
                                                	<a href="<?= $parent_media_url; ?>"
                                                        target="_blank">
                                                		<img src="<?= $icon; ?>" />
                                                	</a>
                                            <?php 
                                                } else {
                                            ?>
                                                    <a href="#" class="need_permission">
                                                        <img src="<?= $icon; ?>" />
                                                	</a>
                                            <?php 
                                                } 
                                        	?>
										</td>
					<?php
									}
					?>
								</tr>
					<?php
							endwhile;
						endif;
					?>

					</tbody>
				</table>
			</div>
	
		</div>

		<script>
			/*var panel_heading = document.querySelector('.panel-heading');
			var panel_collapse = document.querySelector('.panel-collapse')
			panel_heading.onclick = function() {
				
				if( document.querySelector('.elementor-col-50.promo_data') ) {
					document.querySelector('.elementor-col-50.promo_data').classList.remove("is-clicked");
					document.querySelector('.elementor-col-50.promo_data .panel-collapse2').classList.add("hide");
				}

				this.closest('.elementor-col-50').classList.toggle("is-clicked");
				panel_collapse.classList.toggle('hide');
			}*/
		</script>

<?php
	}

	
	if( $files_promo_check ) 
	{
?>
		<div class="elementor-col-50 promo_data is-clicked">
			<div class="panel-heading2">
				<h4 class="panel-title">
					<?= $prd_title; ?> Promo/Tech Data
				</h4>
			</div>
			<div class="panel-collapse2 collapse">
				<table style="width: 100%; border: none;">
					<tbody>
					
					<?php
						if( have_rows('promo_data_content') ):
							while( have_rows('promo_data_content') ) : the_row();

								$img     = ( isset( get_sub_field("fpd_image")['url'] ) ) ? get_sub_field("fpd_image")['url'] : '';
								$heading = get_sub_field("fpd_heading");
								$link    = ( isset( get_sub_field("fpd_link")['url'] ) ) ? get_sub_field("fpd_link")['url'] : '';
	
					?>
								<tr>
									<td>
										<a
											href="<?= $link; ?>"
											target="_blank">
											<img src="<?= $img; ?>"
												alt="" width="93" height="120">
										</a>
									</td>
									<td>
										<a href="<?= $link; ?>"
											target="_blank">
											<?= $heading; ?>
										</a>
									</td>
								</tr>
					<?php
							endwhile;
						endif;
					?>

					</tbody>
				</table>
			</div>
		</div>

		<script>
			/*var panel_heading2 = document.querySelector('.panel-heading2');
			var panel_collapse2 = document.querySelector('.panel-collapse2')
			panel_heading2.onclick = function() {

				if( document.querySelector('.elementor-col-50.product_data') ) {
					document.querySelector('.elementor-col-50.product_data').classList.remove("is-clicked");
					document.querySelector('.elementor-col-50.product_data .panel-collapse').classList.add("hide");
				}

				this.closest('.elementor-col-50').classList.toggle("is-clicked");
				panel_collapse2.classList.toggle('hide');
			}*/
		</script>

<?php
	}
?>

	</div>

<?php

	}

});




add_shortcode("home_slider", function() { 
	
?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<div class="ci-stage ci-theme ci-theme--light">
		<div id="cm-placement-stage" class="cm-placement-stage">
			<div class="ci-m01c-stage-media-fader" data-ci-module="m01c-stage-media-fader">
				<div
						class="ci-m01c-stage-media-fader__background "
						data-reference-id="3154280"
				>
					<div class="ci-m01c-stage-media-fader__image-compare" data-is-vertical="false">
						<img src="<?= get_field('tab_1_image_left')['url']; ?>" alt=""/>
						<img src="<?= get_field('tab_1_image_right')['url']; ?>" alt=""/>
					</div>
				</div>
				<div
						class="ci-m01c-stage-media-fader__background "
						data-reference-id="3154296"
				>
					<div class="ci-m01c-stage-media-fader__image-compare" data-is-vertical="false">
						<img src="<?= get_field('tab_2_image_left')['url']; ?>" alt=""/>
						<img src="<?= get_field('tab_2_image_right')['url']; ?>" alt=""/>
					</div>
				</div>
				<div
						class="ci-m01c-stage-media-fader__background "
						data-reference-id="3154288"
				>
					<div class="ci-m01c-stage-media-fader__image-compare" data-is-vertical="false">
						<img src="<?= get_field('tab_3_image_left')['url']; ?>" alt=""/>
						<img src="<?= get_field('tab_3_image_right')['url']; ?>" alt=""/>
					</div>
				</div>
				<div class="ci-m01c-stage-media-fader__icon-container">
					<div class="ci-m01c-stage-media-fader__icon ws-slide-left " data-visible-trigger="visible" data-reference-id="3154280" data-is-active="true">
						<div class="ci-m01c-stage-media-fader__icon-headline no-icon">
							<?= get_field('tab_1_heading'); ?>
						</div>
					</div>
					<div class="ci-m01c-stage-media-fader__icon ws-appear " data-visible-trigger="visible" data-reference-id="3154296" data-is-active="false">
						<div class="ci-m01c-stage-media-fader__icon-headline no-icon">
							<?= get_field('tab_2_heading'); ?>
						</div>
					</div>
					<div class="ci-m01c-stage-media-fader__icon ws-slide-right " data-visible-trigger="visible" data-reference-id="3154288" data-is-active="true">
						<div class="ci-m01c-stage-media-fader__icon-headline no-icon">
							<?= get_field('tab_3_heading'); ?> 
						</div>
					</div>
				</div>
				<div class="ci-m01c-stage-media-fader__details" data-reference-id="3154280">
					<div class="ci-m01c-stage-media-fader__details-headline-container">
					</div>
					<div class="ci-m01c-stage-media-fader__details-text" data-ci-module="clamp" data-lines="4">
						<p><?= get_field('tab_1_content'); ?></p> </div>
				</div>
				<div class="ci-m01c-stage-media-fader__details" data-reference-id="3154296">
					<div class="ci-m01c-stage-media-fader__details-headline-container">
					</div>
					<div class="ci-m01c-stage-media-fader__details-text" data-ci-module="clamp" data-lines="4">
						<p><?= get_field('tab_2_content'); ?></p> </div>
				</div>
				<div class="ci-m01c-stage-media-fader__details" data-reference-id="3154288">
					<div class="ci-m01c-stage-media-fader__details-headline-container">
					</div>
					<div class="ci-m01c-stage-media-fader__details-text" data-ci-module="clamp" data-lines="4">
						<p><?= get_field('tab_3_content'); ?></p> </div>
				</div>
				<div class="ci-m01c-stage-content__content">
					<div class="ci-m01c-stage-content__breadcrumbs">
						<div class="ci-pe07-breadcrumb" data-ci-module="pe07-breadcrumb">
							<ul class="ci-pe07-breadcrumb__options">

							<?php
								if( have_rows('breadcrumbs_content') ):
									while( have_rows('breadcrumbs_content') ) : the_row();
										$content = get_sub_field("title_link");
							?>
										<li class="ci-pe07-breadcrumb__item">
											<a class="" href="<?= $content['url']; ?>" ><?= $content['title']; ?></a>
										</li>
							<?php
									endwhile;
								endif;
							?>

							</ul>
							<div class="ci-pe07-breadcrumb__content-left">
								<div class="ci-pe07-breadcrumb__dropdown-wrapper">
									<div class="ci-pe07-breadcrumb__selector"></div>
									<span class="ci-pe07-breadcrumb__dropdown-dots">...</span>
								</div>
								<ul class="ci-pe07-breadcrumb__container">

								<?php
									if( have_rows('breadcrumbs_content') ):
										while( have_rows('breadcrumbs_content') ) : the_row();
											$content = get_sub_field("title_link");
								?>
											<li class="ci-pe07-breadcrumb__item">
												<a class="" href="<?= $content['url']; ?>" ><?= $content['title']; ?></a>
											</li>
								<?php
										endwhile;
									endif;
								?>

								</ul>
							</div>
						</div> 
					</div>
				</div>
			</div>
		
		</div> 
	</div>

<?php

});