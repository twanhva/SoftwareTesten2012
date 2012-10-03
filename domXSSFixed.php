<div id="header">
    <div id="logo">
        <h1><a href="#">DOM-based XSS</a></h1>
    </div>
</div>
<div id="page">
    <div id="content">

        <div class="box">
            <h2>Welkom</h2>
            <script>
                var message = document.location.href.substring(document.location.href.indexOf("message=")+8);
                if (message.match(/^[a-zA-Z0-9]$/)) {
                    document.write("Uw bericht is: " + message);
                } else {
                    window.alert("Security Error");
                }     
            </script>
        </div>
    </div>
    <br class="clearfix" />
</div>
