@extends('layout.adminlte')
@section('content')

  <style>
	input{width:80%;}
  </style>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">编辑国家信息</h3>
  </div>
  <br>
  <form class="form-horizontal" id="FormView" action="/langs/store" method="post">
	<div class="form-group">
		<label class="col-sm-1 control-label">国家名称</label>
		<div class="col-sm-10">
			<input type="text" name="CountryName" value="{{$dataInfo->CountryName}}" placeholder="语言名字" nullmsg="不可空" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">所属区域</label>
		<div class="col-sm-10">
			<select name="AreaID" nullmsg="不可空" datatype="*">
			     <option>--</option>
			     @foreach( $areas as $ak=>$av )
			         <option value="{{$av->AreaID}}" @if( $av->AreaID == $dataInfo->AreaID ) selected @endif >{{$av->AreaName }}</option>
			     @endforeach
			</select>
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">英文名称</label>
		<div class="col-sm-10">
			<input type="text" name="EnglishName" value="{{$dataInfo->EnglishName}}" placeholder="EnglishName"  nullmsg="不可空" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">英文简称</label>
		<div class="col-sm-10">
			<input type="text" name="EnglishShort" value="{{$dataInfo->EnglishShort}}" placeholder="EnglishShort"  nullmsg="不可空" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">Facebook</label>
		<div class="col-sm-10">
			<input type="text" name="Facebook" value="{{$dataInfo->Facebook}}" placeholder="Facebook">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">YouTube</label>
		<div class="col-sm-10">
			<input type="text" name="YouTube" value="{{$dataInfo->YouTube}}" placeholder="YouTube">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">Twitter</label>
		<div class="col-sm-10">
			<input type="text" name="Twitter" value="{{$dataInfo->Twitter}}" placeholder="Twitter">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">备注</label>
		<div class="col-sm-10">
			<input type="text" name="Remark" value="{{$dataInfo->Remark}}" placeholder="Remark">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group hidden">
		<label class="col-sm-2 control-label">是否发布</label>
		<div class="col-sm-10">
			<label class="radio-inline" for="ispublic1">发布：<input type="radio" name="state" value="1" id="ispublic1" @if(1 == 1 ) checked @endif></label>
			<label class="radio-inline" for="ispublic2">关闭：<input type="radio" name="state" value="0" id="ispublic2" @if(1 == 0 ) checked @endif></label>
		</div>
	</div>
	<div class="hr-line-dashed hidden"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">国家区域对应</label>
		<div class="col-sm-10">
		     @foreach( $areas as $ak=>$av )
		     <label>
                 <input type="checkbox" name="areamaping[]" @if(in_array( $av->AreaID,$areamapping)) checked  @endif  value="{{$av->AreaID}}" > {{$av->AreaName }}
             </label>
		     @endforeach
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label"></label>
		<div class="col-sm-10">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="id" value="{{$dataInfo->CountryID}}">
			<button class="btn btn-primary" type="submit">提交</button>
		</div>
	</div>
	<div class="hr-line-dashed"></div>
  </form>
</div>
@include('message')
@stop