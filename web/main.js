'use strict';

const SIGNAL_TYPE_JOIN = "join";
const SIGNAL_TYPE_RESP_JOIN = "resp-join";
const SIGNAL_TYPE_LEAVE = "leave";
const SIGNAL_TYPE_NEW_PEER = "new-peer";
const SIGNAL_TYPE_PEER_LEAVE = "peer-leave";
const SIGNAL_TYPE_OFFER = "offer";
const SIGNAL_TYPE_ANSWER = "answer";
const SIGNAL_TYPE_CANDIDATE = "candidate";

var localUserId = Math.random().toString(36).substr(2);
var remoteUserId = -1;
var roomId = 0;

var localVideo = document.querySelector('#localVideo');
var remoteVideo = document.querySelector('#remoteVideo');

var localStream = null;
var remoteStream = null;

var pc = null;

var zeroRTCEngine;

function handleIceCandidate(event) {
    if (event.candidate) {
        var jsonMsg = {
            'cmd': 'candidate',
            'roomId': roomId,
            'uid': localUserId,
            'remoteUid': remoteUserId,
            'msg': JSON.stringify(event.candidate)
        };

        var message = JSON.stringify(jsonMsg);
        zeroRTCEngine.sendMessage(message);
        console.info("handleIceCandidate message:");
    } else {
        console.warn("End of candidates");
    }
}

function handleRemoteStreamAdd(event) {
    remoteStream = event.streams[0];
    remoteVideo.srcObject = remoteStream;
}

function handleConnectionStateChange() {
    if (pc != null) {
        console.info("connectionState -> " + pc.connectionState);
    }
}

function handleIceConnectionStateChange() {
    if (pc != null) {
        console.info("IceConnectionStateChange -> " + pc.iceConnectionState);
    }
}

function createPeerConnection() {
    var defaultConfiguration = {
        bundlePolicy: "max-bundle",
        rtcpMuxPolicy: "require",
        iceTransportPolicy: "all",
        iceServers: [
            {
                "urls": [
                    "turn:172.16.204.150:3478?transport=udp",
                    "turn:172.16.204.150:3478?transport=tcp"
                ],
                "username": "root",
                "credential": "9"
            },
            {
                "urls": [
                    "stun:172.16.204.150:3478"
                ]
            }
        ]
    };

    pc = new RTCPeerConnection(defaultConfiguration);
    pc.onicecandidate = handleIceCandidate;
    pc.ontrack = handleRemoteStreamAdd;

    pc.onconnectionstatechange = handleConnectionStateChange;
    pc.oniceconnectionstatechange = handleIceConnectionStateChange;

    localStream.getTracks().forEach((track) => pc.addTrack(track, localStream));
}

function createOfferAndSendMessage(session) {
    pc.setLocalDescription(session)
        .then(function () {
            var jsonMsg = {
                'cmd': 'offer',
                'roomId': roomId,
                'uid': localUserId,
                'remoteUid': remoteUserId,
                'msg': JSON.stringify(session)
            };

            var message = JSON.stringify(jsonMsg);
            zeroRTCEngine.sendMessage(message);
            console.info("send offer message:");
        })
        .catch(function (error) {
            console.error("offer setLocalDescription failed: " + error);
        });
}

function handleCreateOfferError(error) {
    console.error("handleCreateOfferError: " + error);
}

function createAnswerAndSendMessage(session) {
    pc.setLocalDescription(session)
        .then(function () {
            var jsonMsg = {
                'cmd': 'answer',
                'roomId': roomId,
                'uid': localUserId,
                'remoteUid': remoteUserId,
                'msg': JSON.stringify(session)
            };

            var message = JSON.stringify(jsonMsg);
            zeroRTCEngine.sendMessage(message);
            console.info("send answer message");
        })
        .catch(function (error) {
            console.error("answer setLocalDescription failed: " + error);
        });
}

function handleCreateAnswerError(error) {
    console.error("handleCreateAnswerError: " + error);
}

var ZeroRTCEngine = function (wsUrl) {
    this.init(wsUrl)
    zeroRTCEngine = this;
    return this;
}

ZeroRTCEngine.prototype.init = function (wsUrl) {
    this.wsUrl = wsUrl;
    this.signaling = null;
}

ZeroRTCEngine.prototype.createWebsocket = function () {
    zeroRTCEngine = this;
    zeroRTCEngine.signaling = new WebSocket(this.wsUrl);
    zeroRTCEngine.signaling.onopen = function () {
        zeroRTCEngine.onOpen();
    }
    zeroRTCEngine.signaling.onmessage = function (ev) {
        zeroRTCEngine.onMessage(ev);
    }
    zeroRTCEngine.signaling.onerror = function (ev) {
        zeroRTCEngine.onError(ev);
    }
    zeroRTCEngine.signaling.onclose = function (ev) {
        zeroRTCEngine.onClose(ev);
    }
}

ZeroRTCEngine.prototype.onOpen = function () {
    console.log("websocket open");
}

ZeroRTCEngine.prototype.onMessage = function (event) {
    var jsonMsg = null;
    try {
        jsonMsg = JSON.parse(event.data);
    } catch (e) {
        console.warn("onMessage parse Json failed:" + e);
        return;
    }

    switch (jsonMsg.cmd) {
        case SIGNAL_TYPE_NEW_PEER:
            handleRemoteNewPeer(jsonMsg);
            break;
        case SIGNAL_TYPE_RESP_JOIN:
            handleResponseJoin(jsonMsg);
            break;
        case SIGNAL_TYPE_PEER_LEAVE:
            handleRemotePeerLeave(jsonMsg);
            break;
        case SIGNAL_TYPE_OFFER:
            handleRemoteOffer(jsonMsg);
            break;
        case SIGNAL_TYPE_ANSWER:
            handleRemoteAnswer(jsonMsg);
            break;
        case SIGNAL_TYPE_CANDIDATE:
            handleRemoteCandidate(jsonMsg);
            break;
    }
}

ZeroRTCEngine.prototype.onError = function (event) {
    console.log("onError：" + event.data);
}

ZeroRTCEngine.prototype.onClose = function (event) {
    console.log("onClose -> code：" + event.code + ", reason:" + EventTarget.reason);
}

ZeroRTCEngine.prototype.sendMessage = function (message) {
    this.signaling.send(message);
}

function handleResponseJoin(message) {
    remoteUserId = message.remoteUid;
}

function handleRemotePeerLeave(message) {
    remoteVideo.srcObject = null;
    if (pc != null) {
        pc.close();
        pc = null;
    }
}

function handleRemoteNewPeer(message) {
    remoteUserId = message.remoteUid;
    doOffer();
}

function handleRemoteOffer(message) {
    if (pc == null) {
        createPeerConnection();
    }
    var desc = JSON.parse(message.msg);
    pc.setRemoteDescription(desc);
    doAnswer();
}

function handleRemoteAnswer(message) {
    var desc = JSON.parse(message.msg);
    pc.setRemoteDescription(desc);
}

function handleRemoteCandidate(message) {
    var candidate = JSON.parse(message.msg);
    pc.addIceCandidate(candidate).catch(e => {
        console.error("addIceCandidate failed: " + e.name);
    });
}

function doOffer() {
    if (pc == null) {
        createPeerConnection();
    }
    pc.createOffer().then(createOfferAndSendMessage).catch(handleCreateOfferError);
}

function doAnswer() {
    pc.createAnswer().then(createAnswerAndSendMessage).catch(handleCreateAnswerError);
}

function doJoin(roomId) {
    var jsonMsg = {
        'cmd': 'join',
        'roomId': roomId,
        'uid': localUserId,
    };
    var message = JSON.stringify(jsonMsg);
    zeroRTCEngine.sendMessage(message);
    console.info("doIoin message: " + message);
}

function doLeave() {
    var jsonMsg = {
        'cmd': 'leave',
        'roomId': roomId,
        'uid': localUserId,
    };

    var message = JSON.stringify(jsonMsg);
    zeroRTCEngine.sendMessage(message);
    console.info("doLeave message: " + message);

    hangup();
}

function hangup() {
    localVideo.srcObject = null;
    remoteVideo.srcObject = null;
    closeLocalStream();
    if (pc != null) {
        pc.close();
        pc = null;
    }
}

function closeLocalStream() {
    if (localStream != null) {
        localStream.getTracks().forEach((track) => {
            track.stop();
        });
    }
}

function openLocalStream(stream) {
    console.log("open Local Stream");
    doJoin(roomId);
    localVideo.srcObject = stream;
    localStream = stream;
}

function initLocalStream() {
    navigator.mediaDevices.getUserMedia({
        audio: true,
        video: true
    })
        .then(openLocalStream)
        .catch(function (e) {
            alert("getUserMedia() error: " + e.name);
        });
}

zeroRTCEngine = new ZeroRTCEngine("wss://school-fyp-gp3.tech:8080");
zeroRTCEngine.createWebsocket();

document.getElementById('joinBtn').onclick = function () {
    roomId = document.getElementById('zero-roomId').value;
    if (roomId == "" || roomId == "Please enter the room ID") {
        alert("Please enter the room ID");
        return;
    }
    console.log("Join button is clicked, roomId: " + roomId);
    initLocalStream();
    document.getElementById('zero-roomId').readOnly = true;
}

document.getElementById('leaveBtn').onclick = function () {
    console.log("Away button is clicked");
    doLeave();
    document.getElementById('zero-roomId').readOnly = false;
    document.getElementById('zero-roomId').value = "";
}
