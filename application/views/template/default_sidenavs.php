<div class="col-md-3 left_col menu_fixed">
	<div class="left_col scroll-view">
 		<div class="navbar nav_title" style="border: 0;">
			<a href="<?php echo base_url(); ?>" class="site_title"><i class="fas fa-paw"></i> <span style="font-size: 20px;"><?php echo 'CI with Gentelella' ?></span></a>
		</div>

		<div class="clearfix"></div>
		<!-- menu profile quick info -->
		<div class="profile clearfix">
			<div class="profile_pic">
				<img src="<?php echo $this->session->userdata('user_info')['profile_picture'] ?: base_url('assets/images/user.png') ?>" alt="..." class="img-circle profile_img">
			</div>
			<div class="profile_info">
				<span><?php echo lang('greetings_sidebar') ?></span>
				<h2><?php echo $this->session->userdata('user_info')['name'] ?></h2>
			</div>
		</div>
		<!-- /menu profile quick info -->
		<br>
		<!-- Sidebar Menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<h3>General</h3>
				<ul class="nav side-menu">
					<li><a href="<?php echo base_url('dashboard') ?>"><i class="fas fa-tachometer-alt"></i> <?php echo lang('dashboard') ?></a></li>
					<li><a><i class="fas fa-user-secret"></i> <?php echo lang('master') ?> <span class="fas fa-chevron-down pull-right"></span></a>
						<ul class="nav child_menu">
							<!-- <li><a href="<?php echo base_url('user') ?>"><?php echo lang('user') ?></a></li>
							<li><a href="<?php echo base_url('menu') ?>"><?php echo lang('menu') ?></a></li>
							<li><a href="<?php echo base_url('group') ?>"><?php echo lang('groups') ?></a></li>
							<li><a href="<?php echo base_url('user/read_type') ?>"><?php echo lang('user_type') ?></a></li> -->
							<li>
								<a href="<?php echo base_url('store') ?>">
									<i class="fas fa-store-alt"></i>
									<?php echo lang('store') ?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('category') ?>">
									<i class="fas fa-tags"></i>
									<?php echo lang('category') ?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('product') ?>">
									<i class="fas fa-shopping-cart"></i>
									<?php echo lang('product') ?>
								</a>
							</li>
						</ul>
					</li>
					<li><a href="<?php echo base_url('order') ?>"><i class="fas fa-cart-arrow-down"></i> <?php echo lang('order') ?></a></li>
					<li><a href="<?php echo base_url('report') ?>"><i class="fas fa-clipboard-check"></i> <?php echo lang('report') ?></a></li>
					<li><a><i class="fas fa-percentage"></i> <?php echo lang('percentage') ?> <span class="fas fa-chevron-down pull-right"></span></a>
						<ul class="nav child_menu">
							<li>
								<a href="<?php echo base_url('percentage') ?>">
									<i class="fas fa-store-alt"></i>
									<?php echo lang('product') ?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('percentage/order') ?>">
									<i class="fas fa-shopping-cart"></i>
									<?php echo lang('order') ?>
								</a>
							</li>
						</ul>
					</li>
					<!-- <li><a><i class="fas fa-edit"></i> Home <span class="fas fa-chevron-down pull-right"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?php echo base_url('main/simple_template') ?>">Simple Page</a></li>
						</ul>
					</li>
					<li><a><i class="fas fa-edit"></i> Forms <span class="fas fa-chevron-down pull-right"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?php echo base_url('main/form_ex') ?>">General Form</a></li>
							<li><a href="<?php echo base_url('main/table_ex') ?>">Table</a></li>
							<li><a href="<?php echo base_url('main/table_dyn_ex') ?>">Table Dynamics</a></li>
						</ul>
					</li>
					<li><a><i class="fas fa-sitemap"></i> Multilevel Menu <span class="fas fa-chevron-down pull-right"></span></a>
						<ul class="nav child_menu">
							<li><a href="#level1">Menu 1</a></li>
							<li><a>Menu 2 <span class="fas fa-chevron-down pull-right"></span></a>
								<ul class="nav child_menu">
									<li class="sub_menu"><a href="#level2_1">Menu 2.1</a></li>
									<li><a href="#level2_2">Menu 2.2</a></li>
									<li><a href="#level2_3">Menu 2.3</a></li>
								</ul>
							</li>
							<li><a href="#level3">Menu 3</a></li>
						</ul>
					</li>
					<li><a href="https://github.com/puikinsh/gentelella"><i class="fas fa-external-link-square"></i> Gentelella <span class="label label-info pull-right">Learn More</span></a></li> -->
				</ul>
			</div>
		</div>
		<!-- /Sidebar Menu -->

		<!-- menu footer buttons -->
		<div class="sidebar-footer hidden-small">
			<a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="FullScreen">
				<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Lock">
				<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div>
		<!-- /menu footer buttons -->
	</div>
</div>