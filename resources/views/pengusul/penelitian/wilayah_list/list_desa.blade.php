<option value="">--Desa--</option>
@foreach($desa as $data)
<option value="{{$data->id}}" @if($old_desa==$data->id){{'selected'}}@endif>{{$data->nama}}</option>
@endforeach