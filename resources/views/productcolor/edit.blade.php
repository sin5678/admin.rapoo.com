@extends('layout.adminlte')
@section('content')

  <style>
	input{width:80%;}
  </style>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">编辑产品颜色分布信息</h3>
  </div>
  <br>
  <form class="form-horizontal" id="FormView" action="/productcolor/store" method="post">
	<div class="form-group">
		<label class="col-sm-1 control-label">地域</label>
		<div class="col-sm-10" id="areas">
		     @foreach( $areas as $ak=>$av )
		     <label>
                 <input type="radio" name="areamaping[]" value="{{$av->AreaID}}"  id="{{$av->AreaID}}" areaid="{{$av->AreaID}}" > {{$av->AreaName }}
             </label>
		     @endforeach
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label"></label>
		<div class="col-sm-10" id="countries">
		     @foreach( $country_list as $ak=>$av )

		     <label style="width:150px;height:35px;border:1px solid silver;margin:1px;float:left;">
                 <input class="mycountries" type="checkbox" name="countries[]" value="{{$av->CountryID}}" @foreach( $countryAreaMapping as $mk => $mv ) @if(in_array($av->CountryID,$mv)) area_{{$mk}}="true" @endif @endforeach style="width:30px;" >
				 <!--<img src="{{asset('/img/flags/'.strtolower($av->EnglishName).'.gif')}}" >--> {{$av->CountryName }}
             </label>
		     @endforeach
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">产品型号</label>
		<div class="col-sm-10">
			<select name="ProductID" id="productCode">
				<option value="--">--</option>
		    @foreach( $product_models as $pk=>$pv )
				<option value="{{$pv->PID}}">{{$pv->ProductCode}}</option>
		    @endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">国家产品颜色对应</label>
		<div class="col-sm-10" id="showColors">

		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label"></label>
		<div class="col-sm-10">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="id" value="{{$id}}">
			<button class="btn btn-primary" type="submit">提交</button>
		</div>
	</div>
	<div class="hr-line-dashed"></div>
  </form>
</div>
<script type="text/javascript" src="{{asset('/js/productcolor.js')}}"></script>
<script>
	var url 	= "{{ url('/productcolor/getModelColors') }}";
	var token 	= '{{csrf_token()}}';
</script>
@include('message')
@stop