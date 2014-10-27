		        	<div class="ch-container">
		                <div class="row">

		                    <!-- left menu starts -->
					        <div class="col-sm-2 col-lg-2">
					            <div class="sidebar-nav">
					                <div class="nav-canvas">
					                    <div class="nav-sm nav nav-stacked">

					                    </div>
					                    <ul class="nav nav-pills nav-stacked main-menu">
					                        <li class="nav-header">&nbsp&nbsp&nbsp&nbsp&nbsp操作</li>
					                        <li><a class="ajax-link" href="#"><i class="glyphicon glyphicon-plus"></i><span> 增加问卷</span></a>
					                        </li>
					                        <li><a class="ajax-link" href="#"><i class="glyphicon glyphicon-list"></i><span>问卷列表</span></a>
					                        </li>
					                  
					                    </ul>

					                </div>
					            </div>
					        </div>
					        <!--/span-->
		                    <!-- left menu ends -->
		                </div>
		            </div><!-- /.ch-container -->







		            <div class="wrap">
			<!-- <div class="panel-heading">
				<div class="panel-title">
			            		菜单栏
			    </div>
			</div>
			<div class="panel-body"> -->
		    
		    <div class="panel panel-default">
		        <div class="panel-heading">
		            <div class="panel-title">
		            		菜单栏
		            </div>
		        </div>
			    <div class="panel-body">
			        <div class="col-sm-2 col-lg-2">
				    
				    <!-- sidebar-offcanvas -->
				        <!-- <section class="sidebar"> -->
				                <!-- left menu starts -->
							        <!-- <div class="col-sm-12 col-lg-12"> -->
							            <div class="sidebar-nav">
							                <div class="nav-canvas">
							                    <ul class="nav nav-pills nav-stacked main-menu">
							                        <li class="nav-header">
							                           首页
							                        </li>
							                        <li>
							                            <a class="ajax-link" href="<?php echo site_url('admin/pannel_form/index');?>" target="main-content">
							                                <i class="glyphicon glyphicon-home"></i><span> 首页</span>
							                            </a>
							                        </li>
							                    </ul>

							                    <ul class="nav nav-pills nav-stacked main-menu">
							                        <li class="nav-header">
							                           操作
							                        </li>
							                        <li>
							                            <a class="ajax-link" href="<?php echo site_url('admin/pannel_form/add');?>" target="main-content">
							                                <i class="glyphicon glyphicon-plus"></i><span> 增加问卷</span>
							                            </a>
							                        </li>
							                        <li>
							                            <a class="ajax-link" href="<?php echo site_url('admin/pannel_form/form_list');?>" target="main-content">
							                                <i class="glyphicon glyphicon-list"></i><span>问卷列表</span>
							                            </a>
							                        </li>
							                        
							                    </ul>


							                </div>
							            </div>
							        <!-- </div> -->
							    <!--/span-->
				                <!-- left menu ends -->

				        <!-- </section> -->
				    </div>
				</div>
		    </div>

            <div class="panel panel-info">
		        <div class="panel-heading">
		            <div class="panel-title">
		            		内容
		            </div>
		        </div>
			    <div class="panel-body">
				    <div class="col-sm-10 col-lg-10">   
				        <!-- <div class="row">
		                    <div class="content-header">
			                <ol class="breadcrumb" id = "location">
			                    <li><a href="#"><i class="fa fa-home"></i> i Home</a></li>
			                    <li class="active" id="first_loc">起始页</li>
			                </ol>
			                </div>
		                </div>             
		                 -->
		                <!-- main content -->
		                

			            <div class="row" >
			                <div>
				                <iframe src="<?php echo site_url('admin/pannel_form');?>" name="main-content" 
				                 width="100%" height="690px" id="main-content" scrolling="auto" frameborder="0">
				                </iframe>
			                </div>
			            </div>
		            </div>
		        </div>
		    </div>
        </div><!--./wrapper-->
        <script type="text/javascript">
	            function iframe_fix() {
	            var height = $(window).height() - $("body > .header").height();
	            var iframe_height = height - $('.content-header').outerHeight();
	            $('#main-content').outerHeight(iframe_height-40-5);
	        }

        </script>





        <div class="wrap">
			<ul class="nav nav-tabs nav-stacked" role="tablist">
			  <li class="active"><a href="#home" role="tab" data-toggle="tab">Home</a></li>
			  <li><a href="#profile" role="#prifile" data-toggle="tab">Profile</a></li>
			  <li><a href="#profile" role="#messages" data-toggle="tab">Messages</a></li>
			</ul>

		    <!-- Tab panes -->
			<div class="tab-content">
			  <div class="tab-pane active" id="home">home</div>
			  <div class="tab-pane" id="profile">profile</div>
			  <div class="tab-pane" id="messages">message</div>
			  <div class="tab-pane" id="settings">...</div>
			</div>

		</div>

			    
	
