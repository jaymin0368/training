define([
        "jquery"
    ], function($){
        "use strict";
        return function(config, element) {
            console.log("Asd");
            var endtime = config.message;
            if(endtime)
            {
                //var deadline = new Date("Apr 15, 2020 15:37:25").getTime();
                var deadline = new Date(endtime).getTime();
                var x = setInterval(function() {
                    var now = new Date().getTime();
                    var t = deadline - now;
                    var days = Math.floor(t / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
                    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((t % (1000 * 60)) / 1000);
                    document.getElementById("timerdiv").innerHTML = days + "d "
                        + hours + "h " + minutes + "m " + seconds + "s ";
                    if (t < 0) {
                        clearInterval(x);
                        document.getElementById("timerdiv").innerHTML = "";  //expired
                    }
                }, 1000);
                //document.getElementById("timerdiv").innerHTML="newtext";
                //alert(config.message);
            }

        }
    }
)