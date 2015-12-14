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
		<img src="./static/images/banner3.png" alt="">
	</figure><!-- /.banner -->
	
	<main class="container">
		<div class="row">
			<section class="col-md-12">
				<h3 class="section-title">加入ICACHI<span> Join ICACHI</span></h3>
				<p>Online payment system: <a href="">https://www.regonline.com/icachimembership</a></p>
				<p>Membership dues:</p>
				<table class="table table-bordered">
					<thead>
						<th>Membership Type</th>
						<th>Membership Dues</th>
						<th>Benefit＊</th>
					</thead>
					<tbody>
						<tr>
							<td>Full Member</td>
							<td>💲45(USD) per year</td>
							<td>Election rights</td>
						</tr>
						<tr>
							<td>Student Member</td>
							<td>💲15(USD) per year</td>
							<td>Priority privilege</td>
						</tr>
						<tr>
							<td>Normal Member Without Fee</td>
							<td>Free of charge</td>
							<td>Subscribe news//updates from
members@icachi.org</td>
						</tr>
					</tbody>
				</table>
				
				<p>*Fore more information, please refer to the membership agreement.</p>
				<p>Note: 1) Membership in ICACHI is for 12 consecutive months.</p>
				<p>Note: 2) The members who registered Chinese CHI 2014 as ICACHI members or student members do not need to pay 2014-2015</p>
				<p>membership dues, as the registration fee already includes the 2014-2015 membership fee.</p>
				<p>To join ICACHI today, please fill in the sections below.  (* required fields )</p>

				<p style="color:red;">Please ensure you have read and agree to the membership agreement before applying.</p>
				
				<form action="" class="join-form">
					<div class="subform">
					<fieldset class="form-group row">
						<label for="joinEnglishName" class="col-md-3 necessary form-control-label">Name(英文)</label>
						<div class="col-md-9"><input type="text" name="" id="joinEnglishName" class="form-control" placeholder="(Surname, First name). E.g., Li, Wei"></div>			
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinChineseName" class="col-md-3 necessary form-control-label">姓名(中文)</label>
						<div class="col-md-9"><input type="text" name="" id="joinChineseName" class="form-control"></div>	
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinEnglishTitle" class="col-md-3 necessary form-control-label">Title(英文)</label>
						<div class="col-md-9"><input type="text" name="" id="joinEnglishTitle" class="form-control" placeholder="e.g., Professor/Ph.D./Master/Bachelor; CEO/Researcher/..."></div>
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinChineseTitle" class="col-md-3 necessary form-control-label">单位(中文)</label>
						<div class="col-md-9"><input type="text" name="" id="joinChineseTitle" class="form-control"></div>
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinIfStudent" class="col-md-3 necessary form-control-label">Are you a student?</label>
						<div class="col-md-9"><input type="radio" name="Ifstudent" id="joinIfStudent"> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Ifstudent" id="joinIfnotStudent"> No</div>
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinType1" class="col-md-3 necessary form-control-label">Registration Type</label>
						<div class="col-md-9">
							<input type="radio" name="joinType" id="joinType1"> Registration with fees. (provide members with eligibility privilege for selection as board members. Payment can be made via https://www.regonline.com/icachimembership or bank. For bank information, please visit here. )
							<br>
							<input type="radio" name="joinType" id="joinType2"> Registration without fee (provide members with option to subscribe members@icachi.org mailing list).
						</div>
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinPost" class="col-md-3 necessary form-control-label">职称(中文)</label>
						<div class="col-md-9"><input type="text" name="" id="joinPost" class="form-control"></div>			
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinAffiliation" class="col-md-3 necessary form-control-label">Affiliation(英文)</label>
						<div class="col-md-9"><input type="text" name="" id="joinAffiliation" class="form-control"></div>			
					</fieldset>	
					<fieldset class="form-group row">
						<label for="joinEmail" class="col-md-3 necessary form-control-label">Email Address</label>
						<div class="col-md-9"><input type="text" name="" id="joinEmail" class="form-control"></div>			
					</fieldset>	
					<fieldset class="form-group row">
						<label for="joinIfSubscribe" class="col-md-3 necessary form-control-label">Subscribe members@icachi.org mailing list?</label>
						<div class="col-md-9"><input type="radio" name="joinIfSubscribe" id="joinIfSubscribe1"> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</nb><input type="radio" name="joinIfSubscribe" id="joinIfSubscribe2"> No
						<p>ICACHI announcements/news/updates will be occasionally sent to members@icachi.org.</p>
						</div>
						
					</fieldset>
					</div>
					
					<div class="subform">
					<fieldset class="form-group row">
						<label for="joinResidence" class="col-md-3 form-control-label">Country of residence</label>
						<div class="col-md-9"><input type="text" name="" id="joinResidence" class="form-control"></div>			
					</fieldset>	
					<fieldset class="form-group row">
						<label for="joinOfficePhone" class="col-md-3 form-control-label">Office Phone</label>
						<div class="col-md-9"><input type="text" name="" id="joinOfficePhone" class="form-control" placeholder="e.g., (+81)8040386291"></div>			
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinMobilePhone" class="col-md-3 form-control-label">Mobile Phone</label>
						<div class="col-md-9"><input type="text" name="" id="joinMobilePhone" class="form-control" placeholder="e.g., (+81)8040386291"></div>			
					</fieldset>	
					<fieldset class="form-group row">
						<label for="joinSkype" class="col-md-3 form-control-label">Skype ID</label>
						<div class="col-md-9"><input type="text" name="" id="joinSkype" class="form-control"></div>			
					</fieldset>
					<fieldset class="form-group row">
						<label for="joinTime" class="col-md-3 form-control-label">Time Zone</label>
						<div class="col-md-9"><input type="text" name="" id="joinTime" class="form-control"></div>			
					</fieldset>
					</div>
					<hr>	
					<button type="submit" class="btn center-block">Apply</button>					
				</form>
			</section><!-- /.Joinus section -->
			
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