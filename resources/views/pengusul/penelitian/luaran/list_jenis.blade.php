<option value="">--Jenis Luaran--</option>
@foreach($jenis as $data)
<option value="{{$data->jenis_luaran_id}}" @if($old_jenis==$data->jenis_luaran_id){{'selected'}}@endif>{{$data->jenis_luaran_label}}</option>
@endforeach