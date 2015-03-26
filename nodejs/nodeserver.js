var server_path="/13bsk/public/matchs";
var http=require("http");
http.createServer(function(request,response) {
    var data = "";
    var options = {
        host: "www.nowgoal.com",
        port: 80,
        path: "/data/bf_vn.js?"+Date.parse(new Date())
    };

    callback = function(response) {
        var str = '';

        //another chunk of data has been recieved, so append it to `str`
        response.on('data', function (chunk) {
            str += chunk;
        });

        //the whole response has been recieved, so we just print it out here
        response.on('end', function () {
            onCompleted(str);
        });
    }

    http.request(options, callback).end();

    response.writeHead(200, {'Content-Type': 'text/plain'});
    response.end();
}).listen(8080);

function onCompleted(result) {
    //data_rows=result.split("\r\n");
    var data_json={data:result};

    var qs = JSON.stringify(data_json);

    var length=qs.length;

    var options = {
        host: 'localhost',
        path: server_path,
        //since we are listening on a custom port, we need to specify it by hand
        port: '80',
        //This is what changes the request to a POST request
        method: 'POST',
        headers : {
            'Content-Type' : 'application/json'
        }
    };

    callback = function(response) {
        var str = '';

        //another chunk of data has been recieved, so append it to `str`
        response.on('data', function (chunk) {
            str += chunk;
        });

        //the whole response has been recieved, so we just print it out here
        response.on('end', function () {
            console.log("completed.");
        });
    }

    var reqPost=http.request(options, callback);
    reqPost.write(qs);
    reqPost.end();
}
console.log("The Server started at 127.0.0.1:8080");