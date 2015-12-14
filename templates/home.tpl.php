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
	
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<img src=".<?=$tpath?>/images/12.png" alt="First slide" style="width:100%;postion:relative;z-index:100;">
				<div class="carousel-messege">
				<div class="carousel-left">
					<img src=".<?=$tpath?>/images/photo.png" alt="">
					<br>
					<a href="">
						<button class="btn"></button>
					</a>
				</div>
				<div class="carousel-right">
					<p class="title-1">ICACHI Newsletter</p>
					<p class="title-2">Spring 2015</p>
					<p class="title-3">春季刊</p>
					<p class="text-1"> 世界华人华侨人机交互协会（英文名International Chinese Association of Computer Human Interaction，简称“ICACHI”） 于2012年5月10日在美国Austin（ACM CHI2012国际会议期间）成立。</p>
					<a href="#" class="readmore pull-right">Read more</a>
				</div>
				<div class="clearfix"></div>
				</div>
			</div>
		<!--
		<div class="carousel-item">
		<img data-src="holder.js/900x500/auto/#666:#444/text:Second slide" alt="Second slide">
		</div>
		<div class="carousel-item">
		<img data-src="holder.js/900x500/auto/#555:#333/text:Third slide" alt="Third slide">
		</div>
		-->
		</div>
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="icon-prev" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="icon-next" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div><!-- /.carousel -->
	
	<main class="container">
		<div class="row">
			<section class="col-md-12">
				<h3 class="section-title">关于我们</h3>
				<p>      世界华人华侨人机交互协会（英文名International Chinese Association of Computer Human Interaction，简称“ICACHI”） 于2012年5月10日在美国Austin（ACM CHI2012国际会议期间）成立。理事会由27名来自于本研究领域（Human Computer Interaction：人机交互）且活跃在世界各地的海外华人华侨代表组成（包括两名监事）。
			本会目标和定位（或协会宗旨，见图）：促进会员发展，提升会员在所在国及世界的地位，通过研究人机交互为人类做出自己应有的贡献。协会对内、对外是一个开发放和透明的纯学术团体。本协会是第一个由华人华侨创立的横跨世界、超越地域和地区的纯专业性（人机交互）科技团体组织。</p>
				<a href="" class="button section-readmore pull-right">Read more </a>
			</section><!-- /.Aboutus section -->
			
			<section class="col-md-12">
				<div class="center-block">
				<h3 class="section-title">理事会成员</h3>
				<div class="home-member-block">
				<div class="home-member col-md-3">
					<img src=".<?=$tpath?>/images/avatar.png" alt="">
					<p class="home-member-name">姓名</p>
					<p class="home-member-post">职务或介绍</p>
				</div>
				<div class="home-member col-md-3">
					<img src=".<?=$tpath?>/images/avatar.png" alt="">
					<p class="home-member-name">姓名</p>
					<p class="home-member-post">职务或介绍</p>
				</div>
				<div class="home-member col-md-3">
					<img src=".<?=$tpath?>/images/avatar.png" alt="">
					<p class="home-member-name">姓名</p>
					<p class="home-member-post">职务或介绍</p>
				</div>
				<div class="home-member col-md-3">
					<img src=".<?=$tpath?>/images/avatar.png" alt="">
					<p class="home-member-name">姓名</p>
					<p class="home-member-post">职务或介绍</p>
				</div>
				<div class="clearfix"></div>
				</div>
				</div>
				<a href="" class="button section-readmore pull-right">Read more </a>
			</section><!-- /.Member section -->
			
			<section class="col-md-12">
				<h3 class="section-title">新闻时报</h3>
				<div class="row">
				<div class="col-md-3">
				<div class="card card-inverse news">
					<img class="card-img" src=".<?=$tpath?>/images/news1.png" alt="Card image">
					<div class="card-img-overlay news-overlay">
						<h4 class="card-title news-title">Call for Volunteer</h4>
					</div>
				<figcaption>09/24/2014</figcaption>
				</div>
				</div>
				<div class="col-md-3">
				<div class="card card-inverse news">
					<img class="card-img" src=".<?=$tpath?>/images/news2.png" alt="Card image">
					<div class="card-img-overlay news-overlay">
						<h4 class="card-title news-title">杭州第九届海外英才论坛</h4>
					</div>
				<figcaption>09/24/2014</figcaption>	
				</div>
				</div>
				<div class="col-md-3">
				<div class="card card-inverse news">
					<img class="card-img" src=".<?=$tpath?>/images/news3.png" alt="Card image">
					<div class="card-img-overlay news-overlay">
						<h4 class="card-title news-title">Ongoing Projects and Volunteers</h4>
					</div>
				<figcaption>09/24/2014</figcaption>
				</div>
				</div>
				<div class="col-md-3">
				<div class="card card-inverse news">
					<img class="card-img" src=".<?=$tpath?>/images/news2.png" alt="Card image">
					<div class="card-img-overlay news-overlay">
						<h4 class="card-title news-title">杭州第九届海外英才论坛</h4>
					</div>
				<figcaption>09/24/2014</figcaption>
				</div>
				</div>
				</div><!-- /.row -->
				<a href="" class="button section-readmore pull-right">Read more </a>
			</section><!-- /.News section -->
			
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