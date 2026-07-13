<div id="sticky-header">
	<div class="header-holder"></div>
    <header>
		<nav id="myNavbar" class="navbar navbar-default navbar-inverse " role="navigation">
			<div class="container">
				<div class="row">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarCollapse">
						  <span class="text"><?php echo $data['content']['menu_Label']; ?></span>
						  <span class="icon-bar top-bar"></span>
						  <span class="icon-bar middle-bar"></span>
						  <span class="icon-bar bottom-bar"></span>
						</button>
						<a href="<?echo ROOT; ?>" class="navbar-brand page-scroll"><div class="text-hide"><?php echo $data['content']['siteTitle_Label']; ?></div></a>
					</div>
					<div class="htop">
						<ul>
							<?php
							if (isset($data['content']['facebook_Link'])) {
							?>
							<li class=""><a href="<?php echo $data['content']['facebook_Link']; ?>" class="facebook"><i class="fa fa-facebook-f"></i></a></li>
							<?php
							}
							if (isset($data['content']['googleplus_Link'])) {
							?>
							<li class=""><a href="<?php echo $data['content']['googleplus_Link']; ?>" class="google"><i class="fa fa-google-plus"></i></a></li>
							<?php
							}
							?>
						</ul>
						<div class="text">
							<?php echo $data['content']['address_Text']; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<ul class="nav navbar-nav">
							<li class=""><a href="<?php echo $data['content']['menuRoot']; ?>#rolunk" class="page-scroll"><?php echo $data['content']['topMenuOur_Label']; ?></a></li>
							<li class=""><a href="<?php echo $data['content']['menuRoot']; ?>#szolgaltatasok" class="page-scroll"><?php echo $data['content']['topMenuService_Label']; ?></a></li>
							<li class=""><a href="<?php echo $data['content']['menuRoot']; ?>#markak" class="page-scroll"><?php echo $data['content']['topMenuBrands_Label']; ?></a></li>
							<li class=""><a href="<?php echo $data['content']['menuRoot']; ?>#hirek" class="page-scroll"><?php echo $data['content']['topMenuNews_Label']; ?></a></li>
							<li class=""><a href="<?php echo $data['content']['menuRoot']; ?>#partnereink" class="page-scroll"><?php echo $data['content']['topMenuPartners_Label']; ?></a></li>
							<li class=""><a href="<?php echo $data['content']['menuRoot']; ?>#kapcsolat" class="page-scroll"><?php echo $data['content']['topMenuContact_Label']; ?></a></li>
							
							<li class="maddress">
								<i class="mlogo"></i>
								<?php echo $data['content']['address_Text']; ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>
</div>
