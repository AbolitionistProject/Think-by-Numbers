<?php
/**
 *	Template Name: Analyze Page (v2, no correlations)
 *	Description: Page based on original PHP website
 */
	$stylesheet_dir = get_stylesheet_directory_uri();
	
	wp_enqueue_style("analyze", $stylesheet_dir . "/css/analyze.css");
	wp_enqueue_style("shared-styles", $stylesheet_dir . "/css/_shared_styles.css");
	wp_enqueue_style("jquery-ui-flick", $stylesheet_dir . "/css/jquery-ui-flick.css");
	wp_enqueue_style("jquery-dropdown", $stylesheet_dir . "/css/jquery.dropdown.css");

	wp_enqueue_script("jquery", true);
	wp_enqueue_script("jquery-ui-core");
	wp_enqueue_script("jquery-ui-dialog");
	wp_enqueue_script("jquery-ui-datepicker");
	wp_enqueue_script("jquery-ui-button");
	wp_enqueue_script("jquery-ui-sortable");
	wp_enqueue_script("jquery-ui-menu");
	wp_enqueue_script("jquery-dropdown",$stylesheet_dir . "/js/libs/jquery.dropdown.min.js", "jquery");
	wp_enqueue_script("jquery-touch",$stylesheet_dir . "/js/libs/jquery.ui.touch-punch.min.js", "jquery");
	wp_enqueue_script("qm-math", $stylesheet_dir . "/js/math.js", "jquery", false, true);
	wp_enqueue_script("timezone", $stylesheet_dir . "/js/jstz.min.js", "jquery", false, true);
	wp_enqueue_script("qm-sdk", $stylesheet_dir . "/js/libs/quantimodo-api.js", "jquery", false, true);
	wp_enqueue_script("highcharts", "https://code.highcharts.com/stock/highstock.js", "jquery", false, true);
	wp_enqueue_script("highcharts-more", "https://code.highcharts.com/highcharts-more.js", "highcharts", false, true);
	wp_enqueue_script("analyze-charts", $stylesheet_dir . "/js/analyze_charts.js", array("highcharts-more", "qm-sdk", "qm-math"), false, true);

	wp_enqueue_script("other-shared", $stylesheet_dir . "/js/_other_shared.js", array("jquery"), false, true);
	wp_enqueue_script("variable-settings", $stylesheet_dir . "/js/_variable_settings.js", array("jquery"), false, true);
	wp_enqueue_script("refresh-shared", $stylesheet_dir . "/js/_data_refresh.js", array("jquery"), false, true);

	wp_enqueue_script("analyze", $stylesheet_dir . "/js/analyze.js", array("analyze-charts", "jquery-ui-datepicker", "jquery-ui-button"), false, true);
	
	get_header();
?>

<?php if(!is_user_logged_in()): ?>
<div class="dialog-background" id="login-dialog-background"></div>
<div class="dialog" id="login-dialog">
	<?php login_with_ajax(); ?>
</div>
<?php endif; ?>

<?php require "modules/dialog_delete_measurements.php"; ?>
<?php require "modules/dialog_share.php"; ?>
<?php require "modules/variable_settings.php"; ?>

<section id="content">
<div id="buddypress">
<div class="container">
<div class="row">

	<!-- BuddyPress profile menu -->
	<div class="col-md-2 col-sm-3">
		<?php do_action( 'bp_before_member_home_content' ); ?>
		<div class="pagetitle">
			<div id="item-header" role="complementary">
				<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

			</div><!-- #item-header -->
		</div>
		<div id="item-nav" class="">
			<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
				<ul>

					<?php bp_get_displayed_user_nav(); ?>

					<?php do_action( 'bp_member_options_nav' ); ?>

				</ul>
			</div>
		</div>
	</div>

	<!-- Content -->
	<div class="col-md-10 col-sm-8">

		<section id="section-configure">
			<header class="card-header">
				<h3 class="heading">
					<span>Resolution</span>
				</h3>
			</header>
			<div class="accordion-content closed" id="accordion-date-content">
				<div class="inner">
					<div id="accordion-content-rangepickers">							
						<input type="radio" value="Hour" id="radio3" name="radio" /><label for="radio3">Hour</label>
						<input type="radio" value="Day" id="radio4" name="radio" checked='checked' /><label for="radio4">Day</label>
						<input type="radio" value="Week" id="radio5" name="radio" /><label for="radio5">Week</label>
						<input type="radio" value="Month" id="radio6" name="radio" /><label for="radio6">Month</label>
					</div>
				</div>
			</div>

			<header class="card-header">
				<h3 class="heading">
					<span>Variables</span>
				</h3>
			</header>
			<div class="accordion-content closed" id="accordion-input-content">
				<div class="inner">
					<ul id="addVariableMenu">
					  <li>
						<a>Add a Variable</a>
						<ul id="addVariableMenuCategories" style="z-index: 999999">
						</ul>
					  </li>
					</ul>
					<ul id="selectedVariables">
					</ul>
				</div>
			</div>
		</section>

		<section id="section-analyze">
			<div style="width: 1px; overflow: hidden;"></div>	<!-- Dirty hack for <768px -->
			<div id="timeline-graph">
				<header class="card-header">
					<h3 class="heading">
						<span>Timeline</span>
						<div id="gauge-timeline-settingsicon" data-dropdown="#dropdown-timeline-settings" class="gear-icon"></div>
					</h3>
				</header>
				<div class="graph-content" id="graph-timeline">
				</div>
			</div>
		</section>
	</div>
</div>


<!-- Menu for timeline settings -->
<div id="dropdown-timeline-settings" class="dropdown dropdown-tip dropdown-anchor-right">
	<ul class="dropdown-menu">
		<li><label><input name="tl-enable-markers" type="checkbox" /> Show markers</label></li>
		<li><label><input name="tl-smooth-graph" type="checkbox" /> Smoothen graph</label></li>
		<li><label><input name="tl-enable-horizontal-guides" type="checkbox" /> Show horizontal guides</label></li>
		<li class="dropdown-divider"></li>
		<li><a id="shareTimeline">Share graph</a></li>
	</ul>
</div>

</div>
</div>
</section>

<?php
	get_footer( 'buddypress' );
?>