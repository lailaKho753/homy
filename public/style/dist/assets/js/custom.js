// Using Normal JS
function sendLampCommand(lampId, action) {
    const socket = new WebSocket('ws://192.168.1.18:81');
    socket.onopen = function() {
      socket.send(`${lampId}_${action}`);
    };
  }
  
  document.getElementById('lamp2-on').addEventListener('click', function() {
    sendLampCommand('lamp2', 'on');
  });
  
  document.getElementById('lamp2-off').addEventListener('click', function() {
    sendLampCommand('lamp2', 'off');
  });
  
  document.getElementById('lamp3-on').addEventListener('click', function() {
    sendLampCommand('lamp3', 'on');
  });
  
  document.getElementById('lamp3-off').addEventListener('click', function() {
    sendLampCommand('lamp3', 'off');
  });

  document.getElementById('lamp3-on').addEventListener('click', function() {
    sendLampCommand('stop_kontak', 'on');
  });
  
  document.getElementById('lamp3-off').addEventListener('click', function() {
    sendLampCommand('stop_kontak', 'off');
  });
