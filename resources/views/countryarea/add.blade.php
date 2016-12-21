@extends('layout.adminlte')
@section('content')

  <style>
	input{width:80%;}
  </style>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">添加区域</h3>
  </div>
  <br>
  <form class="form-horizontal" id="FormView" action="/countryarea/save" method="post">
	<div class="form-group">
		<label class="col-sm-1 control-label">区域名称</label>
		<div class="col-sm-10">
			<input type="text" name="AreaName" placeholder="区域名称" nullmsg="不可空" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">备注</label>
		<div class="col-sm-10">
			<input type="text" name="AreaDesc" placeholder="备注"  nullmsg="不可空" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">国家区域对应</label>
		<div class="col-sm-10">
		     @foreach( $country_list as $ak=>$av )
			 <div style="width:170px;height:35px;border:1px solid silver;margin:1px;float:left;">
		     <label>
                 <input type="checkbox" name="countries[]" value="{{$av->CountryID}}" style="width:30px;">
                 <!--<img src="{{asset('/img/flags/'.strtolower($av->EnglishName).'.gif')}}" class="hidden" >--> {{$av->CountryName }}
             </label>
			 </div>
		     @endforeach
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label"></label>
		<div class="col-sm-10">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<button class="btn btn-primary" type="submit">提交</button>
		</div>
	</div>
	<div class="hr-line-dashed"></div>
  </form>
</div>
@include('message')
@stop