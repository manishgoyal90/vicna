<html>
       <head>
             <title>show-hide-div-on-click-using-jquery</title>
             <script src="http://code.jquery.com/jquery-latest.js"></script>
             <script type="text/javascript">
                 $(document).ready(function () {
                    $('#id_radio1').click(function () {
                       $('#div2').hide('fast');
                       $('#div1').show('fast');
                });
                $('#id_radio2').click(function () {
                      $('#div1').hide('fast');
                      $('#div2').show('fast');
                 });
               });
</script>
</head>
 
<body>
     <center>
             <h2>show hide div on click using jquery</h2>
              <div style="padding:25px;width: 100px;">
                   <input id="id_radio1" type="radio" name="name_radio1" value="value_radio1" />Radio1
                   <input id="id_radio2" type="radio" name="name_radio1" value="value_radio2" />Radio2
              </div>
              <div align="center" style="padding:25px;width: 300px;">
                   <div id="div1">This is First (1st) division</div>
                   <div id="div2">This is Second (2nd) division</div>
              </div>
     </center>
</body>
</html>