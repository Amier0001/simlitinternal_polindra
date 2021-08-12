<option value="">--Status Luaran--</option>
@foreach($status as $data)
<option value="{{$data->status_luaran_id}}" @if($old_status==$data->status_luaran_id){{'selected'}}@endif>{{$data->status_luaran_label}}</option>
@endforeach