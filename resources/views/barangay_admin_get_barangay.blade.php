<label for="">Barangay</label>
<select name="brgyCode" class="form-control" id="brgyCode" required>
    <option value="" default>Select</option>
    @foreach ($barangay as $data)
        <option value="{{ $data->brgyCode ."-". $data->brgyDesc }}">{{ $data->brgyDesc }}</option>
    @endforeach
</select>


