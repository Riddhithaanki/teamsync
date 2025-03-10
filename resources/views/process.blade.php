<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script>
    jQuery(document).ready(function () {
        jQuery('#btn_capture').click(function () {
            jQuery('#btn_capture').hide();
            var t = document.body;

            html2canvas(t).then(canvas => {
                let url_data = canvas.toDataURL(); // Get base64 image data

                jQuery.ajax({
                    url: "{{ route('process.store') }}", // Use Laravel route
                    type: 'get',
                    data: {
                        img: url_data,
                        _token: "{{ csrf_token() }}" // CSRF token for security
                    },
                    dataType: "json",
                    success: function (result) {
                        console.log(result);
                        alert(result.message);
                        jQuery('#btn_capture').show();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        alert("Error saving screenshot!");
                        jQuery('#btn_capture').show();
                    }
                });
            });
        });
    });
</script>
