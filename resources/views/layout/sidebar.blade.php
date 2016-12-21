<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>@if(isset( $user )) {{ $user->account }} @endif</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
      </div>
    </div>

    <div class="hr-line-dashed"></div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <!-- Optionally, you can add icons to the links -->
       @if( Entrust::can(['home']))<li><a href="#"><i class="fa fa-dashboard"></i> <span>后台首页</span></a></li>@endif
	  
      <li @if(isset($controller)&& ($controller == 'App\Http\Controllers\ArticlesController' || $controller == 'App\Http\Controllers\NewTypeController' || $controller == 'App\Http\Controllers\ArchivesInfoController'))class="active"@endif>
        @if( Entrust::can(['news']))<a href="#"><i class="fa fa-edit"></i> <span>新闻管理</span><i class="fa fa-angle-left pull-right"></i></a>@endif
        <ul class="treeview-menu">
          @if( Entrust::can(['news_maintenance']))<li @if($controller == 'App\Http\Controllers\ArticlesController' && isset($action)&& $action == 'index')class="active"@endif><a href="/articles/index">新闻维护</a></li>@endif
          @if( Entrust::can(['news_archive']))<li @if($controller == 'App\Http\Controllers\ArchivesInfoController' && isset($action)&& $action == 'index')class="active"@endif><a href="/archivesinfo/index">新闻档案</a></li>@endif
          @if( Entrust::can(['news_type']))<li @if($controller == 'App\Http\Controllers\NewTypeController' && isset($action)&& $action == 'index')class="active"@endif><a href="/newtype/index">新闻类型</a></li>@endif
        </ul>
      </li>
	  
      <li @if(isset($controller)&& ( $controller == 'App\Http\Controllers\ProductDocumentController' || $controller == 'App\Http\Controllers\DocumentTypeController' || $controller == 'App\Http\Controllers\VideoController'))class="active"@endif>
        @if( Entrust::can(['info']))<a href="#"><i class="fa fa-table"></i> <span>资料管理</span><i class="fa fa-angle-left pull-right"></i></a>@endif
        <ul class="treeview-menu">
          @if( Entrust::can(['info_maintenance']))<li @if($controller == 'App\Http\Controllers\ProductDocumentController' && isset($action)&& $action == 'index')class="active"@endif><a href="/productdocument/index">资料维护</a></li>@endif
          @if( Entrust::can(['video']))<li @if($controller == 'App\Http\Controllers\VideoController' && isset($action)&& $action == 'index')class="active"@endif><a href="/video">视频管理</a></li>@endif
          @if( Entrust::can(['info_type']))<li @if($controller == 'App\Http\Controllers\DocumentTypeController' && isset($action)&& $action == 'index')class="active"@endif><a href="/documenttype/index">资料类型</a></li>@endif
		</ul><!-- /.sidebar-menu -->
      </li>
	  
	  <li @if(isset($controller)&& $controller == 'App\Http\Controllers\JobController')class="active"@endif>
        @if( Entrust::can(['recruit']))<a href="#"><i class="fa fa-bus"></i><span>招聘管理</span><i class="fa fa-angle-left pull-right"></i></a>@endif
        <ul class="treeview-menu">
          @if( Entrust::can(['recruit_info']))<li @if(isset($action)&& $action == 'index')class="active"@endif><a href="/job/index">招聘信息</a></li>@endif
        </ul><!-- /.sidebar-menu -->
      </li>
	  
	  <li @if(isset($controller)&&  ( $controller == 'App\Http\Controllers\SiteSpellController' || $controller == 'App\Http\Controllers\SupplyController' || $controller == 'App\Http\Controllers\ProxyController'))class="active"@endif>
        @if( Entrust::can(['setting']))<a href="#"><i class="fa fa-download"></i><span>网站设置</span><i class="fa fa-angle-left pull-right"></i></a>@endif
        <ul class="treeview-menu">
          @if( Entrust::can(['adSlider']))<li @if($controller == 'App\Http\Controllers\SiteSpellController' && isset($action)&& $action == 'index')class="active"@endif><a href="/sitespell/index">轮显广告</a></li>@endif
          @if( Entrust::can(['repairing']))<li @if($controller == 'App\Http\Controllers\SupplyController' && isset($action)&& $action == 'index')class="active"@endif><a href="/supply/index?servicetype=1">维修网点</a></li>@endif
          @if( Entrust::can(['domestic_agent']))<li @if($controller == 'App\Http\Controllers\SupplyController' && isset($action)&& $action == 'index')class="active"@endif><a href="/supply/index?servicetype=2">国内代理</a></li>@endif
          @if( Entrust::can(['agent']))<li @if($controller == 'App\Http\Controllers\ProxyController' && isset($action)&& $action == 'index')class="active"@endif><a href="/proxy/index">代理商管理</a></li>@endif
        </ul><!-- /.sidebar-menu -->
      </li>
	  
  	  <li>
          @if( Entrust::can(['system']))<a href="#"><i class="fa fa-gear"></i> <span>系统</span> <i class="fa fa-angle-left pull-right"></i></a>@endif
          <ul class="treeview-menu">
            <li @if(isset($controller)&& $controller == 'App\Http\Controllers\AdminsController')class="active lightup"@endif><a href="/admins">管理员</a></li>
            @if( Entrust::can(['role']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\RolesController')class="active lightup"@endif><a href="/roles">角色</a></li>@endif
            @if( Entrust::can(['permission']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\PermissionController')class="active lightup"@endif><a href="/permission">权限</a></li>@endif
          </ul><!-- /.sidebar-menu -->
      </li>
	  
      <li @if(isset($controller)&&  ( $controller == 'App\Http\Controllers\ProductController' || $controller == 'App\Http\Controllers\ProductTypeController' || $controller == 'App\Http\Controllers\BasecolorController' || $controller == 'App\Http\Controllers\LangsController' || $controller == 'App\Http\Controllers\CountryareaController'  || $controller == 'App\Http\Controllers\ProductcolorController' || $controller == 'App\Http\Controllers\ProductTranslateController' ))class="active"@endif>
          @if( Entrust::can(['product']))<a href="#"><i class="fa fa-gear"></i> <span>产品管理</span> <i class="fa fa-angle-left pull-right"></i></a>@endif
          <ul class="treeview-menu">
            @if( Entrust::can(['product_repair']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\ProductController')class="active lightup"@endif><a href="/product">产品维护</a></li>@endif
            @if( Entrust::can(['product_type']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\ProductTypeController')class="active lightup"@endif><a href="/product/producttype_list">产品类型</a></li>@endif
  			@if( Entrust::can(['product_color']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\BasecolorController')class="active lightup"@endif><a href="/basecolor/index">产品颜色</a></li>@endif
            @if( Entrust::can(['product_translate']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\ProductTranslateController')class="active lightup"@endif><a href="/producttranslate">产品翻译</a></li>@endif
			@if( Entrust::can(['country_info']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\LangsController')class="active lightup"@endif><a href="/langs">国家信息管理</a></li>@endif
            @if( Entrust::can(['area_info']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\CountryareaController')class="active lightup"@endif><a href="/countryarea">区域信息维护</a></li>@endif
            @if( Entrust::can(['product_color_map']))<li @if(isset($controller)&& $controller == 'App\Http\Controllers\ProductcolorController')class="active lightup"@endif><a href="/productcolor">产品颜色分布</a></li>@endif
          </ul><!-- /.sidebar-menu -->
      </li>
	  
      <li>
        <a href="/auth/logout"><i class="fa fa-sign-out"></i> <span>退出</span></a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>