<html>
    <head>
        <title>Test page</title>
    </head>
    <body>
        <h1>Hello</h1>

        <?php
        if(isset($time)) {
            echo $time;
        }
        if(isset($ViewContentHTML)) {
            echo $ViewContentHTML;
        }
        ?>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    </body>
</html>

