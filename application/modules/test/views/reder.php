<h3>Render Test</h3>

<?php
foreach ($vars as $value) {
    switch ($value) {
        case 1:case 3: case 5: echo $value .'<br>'; break;
        default: echo 'no<br>'; break;
    }
}
?>

<a href="javascript:void(0);" onclick="loadTest()">Load</a>

<div id="show_load"></div>

<script>
    function loadTest() {
//        $.ajaxPrefilter(function (options) {
//            if (!options.beforeSend) {
//                options.beforeSend = function (xhr) {
//                    xhr.setRequestHeader('RESPOND-CONTENT-TYPE', 'xml');
//                }
//            }
//        });

        $.ajaxSetup(
            {
                headers: {'RESPOND-CONTENT-TYPE': 'json'}
            }
        );

        // Sends your custom header
        $.ajax({url: 'test', success: function(data) {showLoad(data)}});
    }

    function showLoad (data) {
        $('#show_load').html(data);
    }
</script>
