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
	
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="<?=$tpath?>/libs/bootstrap/dist/css/bootstrap.min.css">

<!-- Custom styles for this webpage -->
<link rel="stylesheet" href="<?=$tpath?>/css/style.css">
</head>
<body>

	<header>
		<div class="sign-banner">
			<div class="container">
				<ul class="list-inline pull-right">
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
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<?php if ($logo): ?>
  					<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
  						<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
  					</a>
				<?php endif; ?>
				</div>
				<nav class="col-md-8">
					<ul class="nav nav-pills pull-right">
						<!--
						<li class="nav-item active" role="presentation"><a href="#" class="nav-link nav-item">首页</a></li>
						<li class="nav-item" role="presentation"><a href="#" class="nav-link nav-item">关于我们</a></li>
						<li class="nav-item" role="presentation"><a href="#" class="nav-link nav-item">组织结构</a></li>
						<li class="nav-item" role="presentation"><a href="#" class="nav-link nav-item">会议</a></li>
						<li class="nav-item" role="presentation"><a href="#" class="nav-link nav-item">时报文章</a></li>
						<li class="nav-item" role="presentation"><a href="#" class="nav-link nav-item">加入我们</a></li>
						-->
						<?php 
							$block = module_invoke('system', 'block_view', 'main-menu');
							print render($block);
						?>
					</ul>
				</nav>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</header><!-- /.header -->
	
	<figure class="main-banner">
		<img src="./static/images/banner2.png" alt="">
	</figure><!-- /.banner -->
	
	<main class="container">
		<div class="row">
			<section class="col-md-12 members-block">
				<h3 class="section-title">理事会成员<span> Board Members</span></h3>
				<p class="subtitle">The 2nd ICACHI Board Members(May 2014 - April 2016)</p>
				<ul class="post-block list-unstyled">
					<li class="post-hr"></li>
					<li><span class="post-title">秘书处</span></li>
				</ul>
				<br>
				<div class="row">
					<div class="col-md-3 member">
						<img src="./static/images/a1.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a2.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a3.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a4.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a4.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a3.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a2.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a1.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
				</div>
				<ul class="post-block list-unstyled">
					<li class="post-hr"></li>
					<li><span class="post-title">秘书处</span></li>
				</ul>
				<div class="row">
					<div class="col-md-3 member">
						<img src="./static/images/a1.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a2.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a3.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a4.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a4.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a3.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a2.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
					<div class="col-md-3 member">
						<img src="./static/images/a1.png" alt="" class="member-avatar img-circle">
						<p class="member-name">姓名</p>
						<p class="member-post">职务</p>
						<p class="member-org">所属单位</p>
					</div>
				</div>
			</section><!-- /.Member section -->
		
			<section class="col-md-12">
				<h3 class="section-title">组织机构<span> Organization</span></h3>
				<div class="organization-block">
				<img src="./static/images/organization.png" alt="">
				</div>
			</section><!-- /.Organization section -->			
		</div><!-- /.row -->
	</main><!-- /.main & container -->
	
	<footer>
		<div class="container">
			<div class="row">
				
				<div class="footer-section col-md-4">
					<h4>网站地图</h4>
					<ul class="list-unstyled">
						<li class="footer-li">协会介绍</li>
						<li class="footer-li">会议</li>
						<li class="footer-li">理事会成员</li>
						<li class="footer-li">协会章程</li>
						<li class="footer-li">组织机构</li>
						<li class="footer-li">时报文章</li>
						<li class="footer-li">加入我们</li>
					</ul>
				</div>
				
				<div class="footer-section col-md-4">
					<h4>联系我们</h4>
					<ul class="list-unstyled">
						<li class="footer-li">协会代表：Prof. Xiangshi Ren</li>
						<li class="footer-li">协会地址：Prof. Grace Ngai, Department of Computing, Hong Kong Polytechnic University, Kowloon, Hong Kong</li>
						<li class="footer-li">电话: +852 2766-7279, +81-887-57-2209</li>
						<li class="footer-li">传真: +852 2774-0842, +81-887-57-2209</li>
					</ul>
				</div>
				
				<div class="footer-section col-md-4">
					<h4>电子邮箱</h4>
					<ul class="list-unstyled">
						<li class="footer-li">协会网址: www.icachi.org</li>
						<li class="footer-li">秘书处: office@icachi.org</li>
						<li class="footer-li">理事会成员ML: board@icachi.org</li>
						<li class="footer-li">全体会员ML: members@icachi.org</li>
					</ul>
				</div>
				
				<div class="col-md-12 footer-cite">
					<hr>
					<p>Copyright 版权所有© 2012 International Chinese Association of Computer Human Interaction.</p>
				</div>
				
			</div><!-- /.row -->
		</div><!-- /.container -->
	</footer><!-- /.footer -->
	<?php print render($page['bottom']); ?>
	<!-- BootStrap & JQuery Script -->
	<script src="<?=$tpath?>/libs/jquery/dist/jquery.min.js"></script>
	<script src="<?=$tpath?>/libs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>