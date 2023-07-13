<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <style>
        #usermsg {
            width: 400px;
            display: none;
        }
        
        #buttonContainer {
            display: flex;
            align-items: center;
        }
        
        #submitmsg, #clearmsg {
            margin-left: 10px;
        }
        
        #chatContainer {
            display: flex;
            width: 100%;
            margin-top: 15px;
        }
        
        #chatbox {
            flex: 1;
            height: 600px;
            border: 1px solid #000;
            overflow: auto;
            padding: 5px;
        }
        
        #onlineBox {
            width: 20%;
            height: 600px;
            border: 1px solid #000;
            overflow: auto;
            padding: 5px;
        }
        
    </style>
</head>
<body>
    <div id="usernameDiv">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <button id="enterChat">Enter Chat</button>
    </div>
    
    <div id="chatContainer" style="display: none;">
        <div id="chatbox"></div>
        <div id="onlineBox" style="width: 20%;">
            <h2>Online User</h2>
            <div id="userList"></div>
        </div>
    </div>
    
    <br>
    <div id="buttonContainer">
        <input name="usermsg" type="text" id="usermsg" size="63" placeholder="Type your message here..." /> 
        <button name="submitmsg" id="submitmsg" style="display: none;">Send</button>
        <button name="clearmsg" id="clearmsg" onclick="clearChat()" style="display: none;">Clear</button>
    </div>
    
   <script>
        var wsUri = "wss://school-fyp-gp3.tech:8080";
        var websocket = null;
        var username = ""; 

        document.getElementById('enterChat').addEventListener('click', function() {
            username = document.getElementById('username').value;
            if (username) {
                document.getElementById('usernameDiv').style.display = 'none';

                websocket = new WebSocket(wsUri);
                websocket.onopen = function(evt) {
                    console.log("CONNECTED");
                    websocket.send(JSON.stringify({ type: 'username', username: username }));
                };

                websocket.onclose = function(evt) {
                    console.log("DISCONNECTED");
                };

                websocket.onmessage = function(evt) {
                    var msgObj = JSON.parse(evt.data);
                    if (msgObj.type === 'error') {
                        alert(msgObj.message);
                        document.getElementById('usernameDiv').style.display = 'block';
                        websocket.close();
                    } else if (msgObj.type === 'notification' || msgObj.type === 'message') {
                        console.log('RESPONSE: ' + msgObj.message);
                        var chatMessage = msgObj.message;
                        if (msgObj.type === 'message') {
                            chatMessage = msgObj.username + " : " + msgObj.message;
                        }
                        var chatbox = document.getElementById('chatbox');
                        chatbox.innerHTML += '<br>' + chatMessage;
                        chatbox.scrollTop = chatbox.scrollHeight;
                        if (msgObj.type === 'notification') {
                            document.getElementById('chatContainer').style.display = 'flex';
                            document.getElementById('usermsg').style.display = 'block';
                            document.getElementById('submitmsg').style.display = 'block';
                            document.getElementById('clearmsg').style.display = 'block';
                        }
                    } else if (msgObj.type === 'users') {
                        var userList = document.getElementById('userList');
                        userList.innerHTML = '';
                        msgObj.users.forEach(function(user) {
                            var userItem = document.createElement('div');
                            userItem.textContent = user;
                            userList.appendChild(userItem);
                        });
                    }
                };

                websocket.onerror = function(evt) {
                    console.log('ERROR: ' + evt.data);
                };
            }
        });

        document.getElementById('submitmsg').addEventListener('click', function() {
            sendMessage();
        });
        
        document.getElementById('usermsg').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        function sendMessage() {
            var myMessage = document.getElementById('usermsg').value;
            console.log('SENT: ' + myMessage);
            websocket.send(JSON.stringify({ type: 'message', message: myMessage }));
            document.getElementById('usermsg').value = '';
        }
        
        function clearChat() {
            document.getElementById('chatbox').innerHTML = '';
        }
    </script>
</body>
</html>
