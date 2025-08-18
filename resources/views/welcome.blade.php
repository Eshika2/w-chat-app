<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>W-Chat_App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        .body{
            background-color: aquamarine;
        }
        .container{
            margin-left: auto;
            margin-right: auto;
            width: 1000px;
            background-color: whitesmoke;
            padding: 10px;
            border-radius: 10px;
            margin-top: 220px;
        }
        input{
            height: 35px;
            width: 100%;
        }
        #messages{
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        #messages li{
            padding: 5px 10px;
        }
        #message li:nth-child(odd){
            background: #aaa;
        }
    </style>
</head>
<body class="body">
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <div class="container text-center">
        <form class="row" id="messages-form">
            <div class="col-10">
                <input id="chat-input" type="text" placeholder="Enter message here" />
            </div>
            <div class="col-2">
                <input class="btn btn-primary" type="submit" value="Send Message" />
            </div>
        </form>
        <div class="col-12">
            <ul id="messages">
                <!-- Starts empty, populated by Socket.io and JavaScript -->
            </ul>
        </div>        
    </div>
    <script src="/socket.io/socket.io.min.js"></script>
    <script src="scripts.js"></script>    

    <script>
        $(function () {
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);

            // socket.on('connection');

            // let chatInput = $('#chat-input');

            document.getElementById('messages-form').addEventListener('submit',e=>{
                e.preventDefault();
                const newMessage = document.getElementById('chat-input').value;
                document.getElementById('chat-input').value = "";
                // this socket is sending an event to the server...
                socket.emit('messageFromClientToServer',newMessage);
            });

            socket.on('messageFromServerToClient',message=>{
                $('#messages').append(`<li>${message}</li>`);
            });
        })
    </script>
</body>
</html>