<?php
$options = [];
foreach($markups as $key => $name) {
    $options[] = sprintf('<option value="%s">%s</option>', $key, $name);
}
$items = implode('', $options);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Markup translator - example app</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    <style>
        .content-wrapper {
            margin: 0 2em;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <header>
            <h1>Markup translator</h1>
        </header>
        <hr/>
        <div class="content">
            <form class="pure-form pure-form-stacked">
                <label for="from">From</label>
                <select id="from"><?= $items ?></select>
                <label for="text">Markup</label>
                <textarea id="text" rows="5" cols="80"></textarea>
                <label for="to">To</label>
                <select id="to"><?= $items ?></select>
                <button id="translate" class="pure-button pure-button-primary">Translate</button>
                <label for="result">Result</label>
                <textarea id="result" rows="5" cols="80"></textarea>
            </form>
        </div>
    </div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#translate').click(function(event) {
        event.preventDefault();
        $.post('/api/v1/translate', {
            from: $('#from').val(),
            to: $('#to').val(),
            text: $('#text').val(),
        }, function (data) {
            $('#result').val(data.result);
        });
    });
});
</script>
</body>
</html>
