<option value="">--Kecamatan--</option>
@foreach($kecamatan as $data)
<option value="{{$data->id}}" @if($old_kecamatan==$data->id){{'selected'}}@endif>{{$data->nama}}</option>
@endforeach