<label for="">Provinces</label>
<select name="provCode" class="form-control" id="provCode" required>
    <option value="" default>Select</option>
    @foreach ($province as $data)
        <option value="{{ $data->provCode }}">{{ $data->provDesc }}</option>
    @endforeach
</select>

<script>
    $("#provCode").change(function() {
        var provCode = $(this).val();
        $.post({
            type: "POST",
            url: "/barangay_admin_get_municipality",
            data: 'provCode=' + provCode,
            success: function(data) {
                 console.log(data);
                 $('#show_city').html(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
