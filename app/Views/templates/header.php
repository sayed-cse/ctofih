<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
	<title><?php echo($title); ?></title>
	<meta charset="utf-8"/>
	<meta http-equiv="Content-Security-Policy" content="block-all-mixed-content"/>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Edge"><![endif]-->
	<?php if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')===FALSE){echo("<meta name='viewport' content='width=device-width,minimum-scale=1,initial-scale=1'/>");}else{echo("<meta name='viewport' content='width=device-width'/>");} ?>
	<meta name='description' content="<?php echo($dynadesc); ?>"/>
	<meta name='keywords' content="<?php echo($dynakey); ?>"/>
	<meta name='robots' content="<?php echo($dynarobot); ?>"/>
	<meta name='googlebot' content="<?php echo($dynagbot); ?>"/>	
	<meta http-equiv='x-dns-prefetch-control' content='on'/>
	<meta name='HandheldFriendly' content='true'/>
	<meta name='format-detection' content='telephone=yes'/>
	<meta name='mobile-web-app-capable' content='yes'/>
	<meta name='apple-mobile-web-app-capable' content='yes'/>
	<meta name='rating' content="general"/>
	<meta name='author' content="Webmaster:+8801615577997,+8801915577997"/>
	<meta name="google-site-verification" content=""/>
	<meta property='og:type' content="{{ dynaArticleTitle }}"/>
	<meta property='og:url' content="<?php echo(base_url()); ?>{{ dynaOgUrl }}"/>
	<meta property="og:title" content="<?php echo($title); ?>"/>
	<meta property="og:site_name" content='CTOFH'/>
	<meta property="og:description" content="<?php echo($dynadesc); ?>"/>
	<meta property="og:locale" content="en_US"/>	
	<link rel='dns-prefetch' href='//use.fontawesome.com/'/>
	<link rel='shortcut icon' href="<?php echo(base_url('images/favicon.png')); ?>"/>
	<link rel='shortlink' href="<?php echo(base_url()); ?>"/>
	<link rel="stylesheet" href="<?php echo(base_url('css/style.css')); ?>"/>
	<base href="<?php echo(base_url()); ?>" target='_self'/>
</head>
<body itemscope itemtype="https://schema.org/organization">
	<?php if(session()->has("error")){ echo('<p class="errormsg">'.session()->getFlashdata('error').'</p>'); }elseif(session()->has("success")){ echo('<p class="successmsg">'.session()->getFlashdata('success').'</p>'); } ?>
<header>
	<ul id="bar">
		<li><a href="<?php echo(site_url('challenge/index/')); ?>">Challenge</a></li>
		<li><a href="<?php echo(site_url('challenge/awardInfoForm/')); ?>">Award</a></li>
		<li><a href="<?php echo(site_url('challenge/register/')); ?>">Registration</a></li>
		<li><a href="<?php echo(site_url('challenge/roundinfo/')); ?>">Rounds</a></li>
		<li>
<?php if(session()->has('uname')){echo('<strong>'.session()->get('uname').'</strong> | <a href="'.site_url("auth/logout/").'">Logout</a>');}else{echo('<a href="'.site_url("auth/index/").'">Sign Up</a>');} ?>			
		</li>
	</ul>
	<h1 style="font-size:40px">CTO FORUM<br/> INNOVATION HACKATHON</h1>
</header>