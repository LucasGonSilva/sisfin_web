<!DOCTYPE html>
<!--
Created using JS Bin
http://jsbin.com

Copyright (c) 2019 by anonymous (http://jsbin.com/ozeyag/19/edit)

Released under the MIT license: http://jsbin.mit-license.org
-->
<meta name="robots" content="noindex">
<html>
    <head>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <meta charset=utf-8 />
        <title>JS Bin</title>
        <!--[if IE]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <style>
            article, aside, figure, footer, header, hgroup, 
            menu, nav, section { display: block; }
        </style>
    </head>
    <body>
        <form onSubmit='validate(); return false;'>
            <p>Enter an email address:</p>
            <input id='email'>
            <button type='submit' id='validate'>Validate!</button>
        </form>

        <br/>
        <h2 id='result'></h2>
        <script id="jsbin-javascript">
            function validateEmail(email) {
                // http://stackoverflow.com/a/46181/11236

                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }

            function validate() {
                $("#result").text("");
                var email = $("#email").val();
                if (validateEmail(email)) {
                    $("#result").text(email + " is valid :)");
                    $("#result").css("color", "green");
                } else {
                    $("#result").text(email + "is not valid :(");
                    $("#result").css("color", "red");
                }
                return false;
            }

            $("form").bind("submit", validate);
        </script>
    </body>
</html>