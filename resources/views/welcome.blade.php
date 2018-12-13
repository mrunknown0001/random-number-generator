<html>
    <head>
        <title>Random Number Generator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <style>

            body {
              font-family: monospace;
            }

            #random1, #random2, #random3, #number1, #number2, #number3 {
              font-size: 300px;
              overflow: hidden;
            }


            body {
              background-color: #F24236;
              width: 100%;
              color: #fff;
              font-family: 'Cookie', cursive;
            }


            #days {
              font-size: 50px;
              color: #FFF;
              text-align: center;
              letter-spacing: 3px;
            }

            .drop {
                position: absolute;
                top: 0; 
                z-index: -1;
              opacity: 0;
            }
            .snow {
                height: 8px;
                width: 8px;
                border-radius: 100%;
                background-color: #FFF;
              box-shadow: 0 0 10px #FFF
            }


            .animate {
                animation: falling 8.5s infinite ease-in;   
            }


            @keyframes falling {
                0% {top: 0; opacity: 1;}
                100% {top: 1500px; opacity: 0}
            }



        </style>

    </head>

    <body>

      <div style="float: left; margin: 0 auto">
        <!-- <img src="{{ asset('/images/logo.png') }}" class="img-responsive" height="100px"> -->
      </div>

        <div id="display" class="container text-center">

            <div class="row">
              <div class="col-md-4" id="random1"></div>
              <div class="col-md-4" id="random2"></div>
              <div class="col-md-4" id="random3"></div>
            </div>

            <div class="row">
              <div class="col-md-4" id="number1" style="display: none;"></div>
              <div class="col-md-4" id="number2" style="display: none;"></div>
              <div class="col-md-4" id="number3" style="display: none;"></div>
            </div>

            <div id="buttons">
             <button id="pause" class="btn btn-primary btn-lg" onclick="myFunction()">Pick Lucky Number</button>
             <!-- <button onclick="location.reload()" class="btn btn-success btn-lg">Pick Another</button> -->
             <button onclick="reloadMe()" class="btn btn-success btn-lg">Pick Another</button>
             <a href="{{ route('winners.page') }}" target="_blanik" class="btn btn-warning btn-lg">View Winners</a>
            </div>

            <div class="text-center" style="font-size: 25px; font-family: 'Lucida Console';">
              Created By IT Team
            </div>
        </div>


        <script>

          $(document).ready(function () {

            randomNumbers();

          });

          
          function reloadMe() {

            $('#number1').hide();
            $('#number2').hide();
            $('#number3').hide();

            $('#random1').show();
            $('#random2').show();
            $('#random3').show();

            randomNumbers();

            $('#pause').prop('disabled', false);


          }


          // FUNCTION ALL
          function myFunction() {

            $('#random1').hide();
            $('#random2').hide();
            $('#random3').hide();

            var num = null;
            var res = null;

            num = getGeneratedNumber();

            var res = null;

            $.ajax({
                type: "get",
                contentType: "application/json; charset=utf-8",
                url: "/check-number/" + num,
                data: '',
                datatype: 'json',
                async: false,
                success: function (data) {
                  
                  res = data;

                }
            }); 

            console.log(res);

            if(res === "false") {
              myFunction();
            }
            else {

              // save number to database -- ok
              $.ajax({
                url: "/save-number/" + num,
                type: "get"
              });

              displayNumber(num);

            }

          }

          // SHOW RANDOM NUMBERS
          function randomNumbers() {

            setInterval(function(){
               var t = Math.round(Math.random() * 5 - 1) + 1;
               document.getElementById("random1").innerHTML = t;
            }, 100);

            setInterval(function(){
               var t = Math.round(Math.random() * 9 - 1) + 1;
               document.getElementById("random2").innerHTML = t;
            }, 100);

            setInterval(function(){
               var t = Math.round(Math.random() * 9 - 1) + 1;
               document.getElementById("random3").innerHTML = t;
            }, 100);

          }

          // FUNCTION TO GET RANDOM NUMBER IN UNIQUE SEQUECE WITH DATABASE
          function getGeneratedNumber() {
            $('#buttons').hide();

            var num;

            $('#random1').hide();
            $('#random2').hide();
            $('#random3').hide();
          
            num =  Math.floor((Math.random() * 557 ) + 1);
            
            $('#number').html( num);

            var str = num.toString();

            return str;
          }


          // DISPLAY WINNING NUMBER
          function displayNumber(str)
          {

            if(str.length > 2) {
                    $('#number1').html( str[0]);
                    $('#number2').html( str[1]);
                    $('#number3').html( str[2]);
            }
            else if(str.length >= 2) {
                    $('#number1').html( 0 );
                    $('#number2').html( str[0]);
                    $('#number3').html( str[1]);
            }
            else {
                    $('#number1').html( 0 );
                    $('#number2').html( 0);
                    $('#number3').html( str[0]);
            }


            $('#number1').delay(500).fadeIn(400);
            $('#number2').delay(800).fadeIn(400);
            $('#number3').delay(1000).fadeIn(400);
        
            $('#buttons').delay(1500).fadeIn(500);

            $('#pause').prop('disabled', true);

          }

        </script>




        <script>
            // SCRIPT FOR DESIGN FOR THE BACKGROUND

            //make snow
            snowDrop(150, randomInt(1035, 1280));
            snow(150, 150);

            function snow(num, speed) {
                    if (num > 0) {
                        setTimeout(function () {
                            $('#drop_' + randomInt(1, 250)).addClass('animate');
                            num--;
                            snow(num, speed);
                        }, speed);
                    }
                };

                function snowDrop(num, position) {
                    if (num > 0) {
                        var drop = '<div class="drop snow" id="drop_' + num + '"></div>';

                        $('body').append(drop);
                        $('#drop_' + num).css('left', position);
                        num--;
                        snowDrop(num, randomInt(60, 1280));
                    }
                };

            function randomInt(min, max) {
                    return Math.floor(Math.random() * (max - min + 1) + min);
                };
        </script>

    </body>
</html>