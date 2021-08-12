<option value="">--Kabupaten / Kota--</option>
@foreach($kabupaten as $data)
<option value="{{$data->id}}" @if($old_kabupaten==$data->id){{'selected'}}@endif>{{$data->nama}}</option>
@endforeach