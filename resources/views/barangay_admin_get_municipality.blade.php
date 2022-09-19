<label for="">Municipality/City</label>
<select name="citymunCode" class="form-control" id="citymunCode" required>
    <option value="" default>Select</option>
    @foreach ($city as $data)
        <option value="{{ $data->citymunCode }}">{{ $data->citymunDesc }}</option>
    @endforeach
</select>

<script>
    $("#citymunCode").change(function() {
        var citymunCode = $(this).val();
        $.post({
            type: "POST",
            url: "/barangay_admin_get_barangay",
            data: 'citymunCode=' + citymunCode,
            success: function(data) {
                 console.log(data);
                 $('#show_barangay').html(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
