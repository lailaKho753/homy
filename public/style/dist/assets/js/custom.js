// // Using Normal JS
// function sendLampCommand(lampId, action) {
//     const socket = new WebSocket('ws://192.168.1.18:81');
//     socket.onopen = function() {
//       socket.send(`${lampId}_${action}`);
//     };
//   }
  
//   document.getElementById('lamp2-on').addEventListener('click', function() {
//     sendLampCommand('lamp2', 'on');
//   });
  
//   document.getElementById('lamp2-off').addEventListener('click', function() {
//     sendLampCommand('lamp2', 'off');
//   });
  
//   document.getElementById('lamp3-on').addEventListener('click', function() {
//     sendLampCommand('lamp3', 'on');
//   });
  
//   document.getElementById('lamp3-off').addEventListener('click', function() {
//     sendLampCommand('lamp3', 'off');
//   });

//   document.getElementById('lamp3-on').addEventListener('click', function() {
//     sendLampCommand('stop_kontak', 'on');
//   });
  
//   document.getElementById('lamp3-off').addEventListener('click', function() {
//     sendLampCommand('stop_kontak', 'off');
//   });

// Function to send lamp command through WebSocket
function sendLampCommand(lampId, action) {
    const socket = new WebSocket('ws://192.168.1.16:81');
    socket.onopen = function() {
        socket.send(`${lampId}_${action}`);
    };
}

function saveToggleState(lampId, state) {
    fetch(`/toggle/${lampId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ state: state })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    });
}

// Function to handle toggle change
function handleToggleChange(toggleId, lampId) {
    const toggle = document.getElementById(toggleId);
    const toggleText = document.getElementById(`${toggleId}-text`);

    toggle.addEventListener('change', function() {
        const state = this.checked ? true : false;
        sendLampCommand(lampId, state ? 'on' : 'off');
        saveToggleState(lampId, state);
        
        // Debugging output
        console.log(`Toggle ${lampId} is now ${state ? 'ON' : 'OFF'}`);
    });
}

// Call the handleToggleChange for each toggle
handleToggleChange('lamp2-toggle', 'lamp2');
handleToggleChange('lamp3-toggle', 'lamp3');
handleToggleChange('stop-kontak-toggle', 'stop_kontak');

document.addEventListener('DOMContentLoaded', function() {
    const lampIds = ['lamp2', 'lamp3', 'stop_kontak'];

    lampIds.forEach(lampId => {
        fetch(`/toggle/${lampId}`)
            .then(response => response.json())
            .then(data => {
                const toggle = document.getElementById(`${lampId}-toggle`);
                toggle.checked = data.state;
                toggle.dispatchEvent(new Event('change')); // Trigger change to update text
            });
    });
});

