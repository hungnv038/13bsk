<html>
<header>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</header>
<body>
<span id="idresult"></span>
<span id="allDate"><script language="javascript" type="text/javascript" defer="defer"></script></span>
<script type="text/javascript">
    function LoadLiveFile()
    {
        var allDate=document.getElementById("allDate");
        var  s=document.createElement("script");
        s.type="text/javascript";
        s.src="http://www.nowgoal.com/data/bf_vn.js?" +Date.parse(new Date());
        allDate.removeChild(allDate.firstChild);
        allDate.appendChild(s,"script");
    }
    function ShowBf() {
        var data={a_array:A,b_array:B,c_array:C,matchcount:matchcount,sclasscount:sclasscount};

        data_json="data="+JSON.stringify(data);

        $.ajax({
            url:'matchs',
            data: {data:data_json},
            dataType: 'json',
            type: "POST",
            success:function(result) {
                $('#idresult').append("Success");
            },
            error: function(jqXHR){
                $('#idresult').append("Error");
            }
        });
    }
    LoadLiveFile();
</script>
</body>
</html>