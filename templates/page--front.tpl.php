<?php
/**
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */
?>

<?php $tpath = $base_path.$directory; ?>

<script src="<?=$tpath?>/js/jquery-1.7.2.min.js"></script>
<script src="<?=$tpath?>/js/site.js"></script>
<link type="text/css" rel="Stylesheet" href="<?=$tpath?>/css/style.css" />

<div id="topbar">
	<div id="topbar-inner">
		<table><tr>
			<td style="float: right;">
				<ul class="topright">
					<?php
					global $user;
					$roleEditor = 'editor';
					$rolePublisher = 'publisher';
					$user_roles = array_values($user->roles);
						if ($user->uid == 0) { //if user is NOT LOGGED IN
							//print '<li><a href="' .url('node/add/article'). '">'.t('Submit News').'</a>  |';
							print 	'<li><a href="' .url('user/'). '">'.t('Sign in').'</a></li>';
						}
						else{  //if user is LOGGED IN
							print '<li>' .t('Logged in as '). '<a href="' .url('user/'.$user->uid). '">'.$user->name.'</a>  |';
							print ' <a href="' .url('node/add'). '">' .t('Add content'). '</a>  |';
							if (in_array($roleEditor, $user_roles) || in_array($rolePublisher, $user_roles)) {
								print ' <a href="' .url('submitted-news'). '">' .t('See list of unpublished news'). '</a>  |';
							}
							print ' <a href="' .url('user/logout'). '">' .t('Sign out'). '</a></li>'; 
						}
					?>
				</ul>
			</td>
		</tr></table>
	</div>
</div><!--end topbar-->	
<div id="page-wrapper">
	<div id="header">
		<table class="fitwidth">
			<tr>
				<td width="110">
					 <?php if ($logo): ?>
  					<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
  						<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
  					</a>
				<?php endif; ?>
       			</td>
				<td>		   
	    			<div id="siteinfo">
						<?php
							print "<div id='sitename'>".$site_name."</div>";
							print "<div id='sitelogan'>".$site_slogan."</div>";	
						?>								
					</div>
	    		</td>
	    	</tr>
		</table>
	</div><!-- /.section, /#header -->
    <div id="main-menu">
    	<div class="fitwidth">
    	<?php 
    		$block = module_invoke('system', 'block_view', 'main-menu');
        	print render($block);
    	?>
    	</div>
    </div>
	    <?php if ($messages): ?>
    <div id="messages"><div class="section clearfix">
      <?php print $messages; ?>
    </div></div> <!-- /.section, /#messages -->
  <?php endif; ?>
  
	<div id="main-wrapper">
  		<div id="main" class="fitwidth">
			<table class="front-table" width="100%">
				<tr valign="top">
					<td width="55%">
						<div class="box ulist">
							<h3>协会近期新闻与活动 / What's New</h3>
							<?php
								$viewName = 'news';
								$displayName = "block";
								print views_embed_view($viewName, $displayName);
							?>
						</div>
					</td>
					<td width="45%">
						<div class="box ulist">
							<h3>协会 / Downloads </h3>
							<?php
								$viewName='newsletter_download';
								$displayName = "block";
								print views_embed_view($viewName, $displayName);
							?>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div><!-- /#main, /#main-wrapper -->
	<?php print render($page['footer']); ?>
</div><!-- /#page-wrapper -->

<?php print render($page['bottom']); ?>
