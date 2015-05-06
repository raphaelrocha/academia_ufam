<html>
    <head>
        <title>Documento sem t&iacute;tulo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script language="javascript" type="text/javascript">
            function Hab() {
                if (document.getElementById("Travar").checked==true) {
                    document.getElementById("Campo").disabled=true;
                } else {
                    document.getElementById("Campo").disabled=false;
                    document.getElementById("Campo").focus();
                }
            }
        </script>
    </head>

    <body>
        <form>
            <input type="checkbox" id="Travar" name="Travar" value="1" onClick="Hab();">Travar/Destravar Campo<br>
            <input type="text" id="Campo" name="Campo">
        </form>
    </body>
</html>
