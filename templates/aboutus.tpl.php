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
		<img src="./static/images/banner1.png" alt="">
	</figure><!-- /.banner -->
	
	<main class="container">
		<div class="row">
			<section class="col-md-12">
				<h3 class="section-title">协会介绍</h3>
				<p>"世界华人华侨人机交互协会（英文名International Chinese Association of Computer Human Interaction，简称“ICACHI”）” 于2012年5月10日在美国Austin（ACM CHI2012国际会议期间）成立。理事会由27名来自于本研究领域（Human Computer Interaction：人机交互）且活跃在世界各地的海外华人华侨代表组成（包括两名监事）。
本会目标和定位（或协会宗旨，见图）：促进会员发展，提升会员在所在国及世界的地位，通过研究人机交互为人类做出自己应有的贡献。协会对内、对外是一个开发放和透明的纯学术团体。本协会是第一个由华人华侨创立的横跨世界、超越地域和地区的纯专业性（人机交互）科技团体组织。
人机交互本身就像空气和水一样，存在于我们生活和工作的各个角落。它是研究关于供人们使用的交互计算系统的设计、评价和实现，以及围绕这些方面的主要现象的交叉学科领域，它在计算机科学，信息科学等诸多领域中，其本身以及其应用都极为重要。其研究目的就是如何使人-计算机（或人-计算机-人）之间信息更快更好地发出和接收。由此可见，人机交互对21世纪信息化社会的健全发展是必不可缺的研究领域。从广义上讲，人机交互也是研究关于人类和整个信息空间交互方式的科学。把计算机生成的假想世界和现实世界连接一起的这个领域今后必将更加广泛地向纵深发展和实现更多改变世界的应用。我们坚信通过理事会和全体会员的努力，在未来本协会以及本领域将会有更加光辉的前景。
To join ICACHI, please visit here. Please also ensure you have read and agree to ICACHI membership agreement.
</p>			
				<div class="text-center">
				<img src="./static/images/duty.png" alt="">	
				</div>
				<a href="" class="button section-readmore pull-right">English </a>
			</section><!-- /.Aboutus section -->
			
			<section class="col-md-12">
				<div class="center-block">
				<h3 class="section-title">章程</h3>
				<pre>
				第1章 总则
				第 1 条(名称及地址)
				(1) 本会的名称为世界华人华侨人机交互协会(英文名 International Chinese Association of Computer Human Interaction,简称「ICACHI」)。
				URL 为 http://www.icachi.org/ (2)本会的总部设在香港。协会地址: Prof. Grace Ngai, Department of Computing, Hong Kong Polytechnic 
				University, Kowloon, Hong Kong 电话: +852 2766-7279, +81-887-57-2209 传真: +852 2774-0842, +81-887-57-2209 协会网址: 
				www.icachi.org 秘书处: office@icachi.org 理事会成员 ML: board@icachi.org 全体会员 ML: members@icachi.org (3)本会在世界其他各地
				设协会的办事处。目前协会在北京和多伦多分别设有办事 处。
				第2章 目的及活动内容
				第 2 条(目的) 本会的目的如下:
				(1)促进世界华人华侨人机交互学生学者间,以及本会会员和其他人机交互国际组 织和学者的学术交流和合作研究。
				(2)促进亚洲特别是华语地区的人机交互发展, 学术交流和合作。促进具有地域文 化的人机交互的发展和交流。
				(3)通过各种学术交流等活动,提高会员的学术水平及社会地位。
				(4)承担起多国(包括地区,以下同样)间的文化,学术和经济交流的桥梁作用。
				(5)对人类的科学进歩和技术发展,以及学者所在国和全人类的社会,经济,科学, 技术发展等做出贡献。
				第 3 条(活动内容) 本会为达到上述目的,开展以下活动。 (1)利用计算机网络开展研究讨论会。
				(2)主办或合办学习会,研究会,公开讲座,国际会议等(如每年定期在 CHI 的 结束前后召开 Chinese CHI conference)。
				(3)策划和合办国际间的共同学术研究。
				(4)编辑和发行反映本学科世界科学技术最新动向的学术期刊。
				(5)协助会员在各国大学及研究机关兼职,学术交流及会员创业。
				(6)对会员所在国的科学技术政策献计献策,协助高新科学技术的开发。
				(7)其他,为达到本会目的所需的相关活动。
				</pre>
				</div>
				<a href="" class="button section-readmore pull-right">Read more </a>
			</section><!-- /.Rule section -->
			
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