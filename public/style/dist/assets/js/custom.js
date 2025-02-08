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

// // Function to send lamp command through WebSocket
// function sendLampCommand(lampId, action) {
//     const socket = new WebSocket('ws://192.168.1.16:81');
//     socket.onopen = function() {
//         socket.send(`${lampId}_${action}`);
//     };
// }

// function saveToggleState(lampId, state) {
//     fetch(`/toggle/${lampId}`, {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({ state: state })
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log(data);
//     });
// }

// // Function to handle toggle change
// function handleToggleChange(toggleId, lampId) {
//     const toggle = document.getElementById(toggleId);
//     const toggleText = document.getElementById(`${toggleId}-text`);

//     toggle.addEventListener('change', function() {
//         const state = this.checked ? true : false;
//         sendLampCommand(lampId, state ? 'on' : 'off');
//         saveToggleState(lampId, state);
        
//         // Debugging output
//         console.log(`Toggle ${lampId} is now ${state ? 'ON' : 'OFF'}`);
//     });
// }

// // Call the handleToggleChange for each toggle
// handleToggleChange('lamp2-toggle', 'lamp2');
// handleToggleChange('lamp3-toggle', 'lamp3');
// handleToggleChange('stop-kontak-toggle', 'stop_kontak');

// document.addEventListener('DOMContentLoaded', function() {
//     const lampIds = ['lamp2', 'lamp3', 'stop_kontak'];

//     lampIds.forEach(lampId => {
//         fetch(`/toggle/${lampId}`)
//             .then(response => response.json())
//             .then(data => {
//                 const toggle = document.getElementById(`${lampId}-toggle`);
//                 toggle.checked = data.state;
//                 toggle.dispatchEvent(new Event('change')); // Trigger change to update text
//             });
//     });
// });

// Connect to your MQTT broker via WebSockets.
// Ensure your Mosquitto broker is configured to accept WebSocket connections (see mosquitto.conf above)
const mqttBrokerURL = "ws://192.168.1.8:9001"; // Replace with your broker's WebSocket URL
const client = mqtt.connect(mqttBrokerURL);

client.on('connect', function() {
    console.log('Connected to MQTT broker');
    client.subscribe('lampu_teras', function(err) {
        if (!err) {
            console.log('Subscribed to lampu_teras topic');
        } else {
            console.error('Failed to subscribe to lampu_teras:', err);
        }
    });

    client.subscribe('temp', function(err) { // Subscribe to the 'temp' topic
        if (!err) {
            console.log('Subscribed to temp topic');
        } else {
            console.error('Failed to subscribe to temp:', err);
        }
    });
});

// Send a command by publishing to the relevant topic
function sendLampCommand(lampId, action) {
    client.publish(lampId, action);
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
    })
    .catch(error => console.error('Error saving toggle state:', error));
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

// On DOM load, set the initial states from the server
document.addEventListener('DOMContentLoaded', function() {
    const lampIds = ['lamp2', 'lamp3', 'stop_kontak'];

    lampIds.forEach(lampId => {
        fetch(`/toggle/${lampId}`)
            .then(response => response.json())
            .then(data => {
                const toggle = document.getElementById(`${lampId}-toggle`);
                if (toggle) {
                    toggle.checked = data.state;
                    toggle.dispatchEvent(new Event('change')); // Trigger change to update text
                }
            })
            .catch(error => console.error('Error fetching initial state:', error));
    });
});

// Handle incoming MQTT messages
client.on('message', function(topic, message) {
    // Handle lampu_teras topic
    if (topic === 'lampu_teras') {
        const status = message.toString().trim(); // Trim any extra whitespace
        console.log(`Received lampu_teras status: ${status}`);

        // Only change the background color if the status has changed
        const lampStatus = document.getElementById('lamp1-status');
        if (lampStatus) {
            lampStatus.style.backgroundColor = status === '1' ? 'green' : 'grey';
        }
    }

    // Handle temp topic
    if (topic === 'temp') { 
        const tempValue = parseFloat(message.toString().trim()); // Parse temperature value from message
        console.log(`Received temperature: ${tempValue}`);
    
        // Get current timestamp in dd-mm-yyyy hh:mm:ss format
        const currentDate = new Date();
        const formattedDate = currentDate.toLocaleString('en-GB', { timeZone: 'Asia/Jakarta' }).replace(',', '');
    
        // Send the data to the server via AJAX (post request)
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Use setTimeout to ensure temperature handling is non-blocking
        setTimeout(() => {
            fetch('/save-temperature', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token, // if needed for auth
                },
                body: JSON.stringify({
                    temperature: tempValue, // Send the actual temperature value
                    created_at: formattedDate // Use the actual timestamp
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Temperature saved:', data);
            })
            .catch((error) => {
                console.error('Error saving temperature data:', error);
            });
        }, 0); // Execute this after a tiny delay to prevent blocking
    }
});


// Function to send the temperature data to Laravel (via an API route)
function saveTemperatureData(tempValue) {
    fetch('/api/save-temperature', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ temperature: tempValue }) // Send the temperature value in the request body
    })
    .then(response => response.json())
    .then(data => {
        console.log('Temperature saved:', data);
    })
    .catch(error => {
        console.error('Error saving temperature data:', error);
    });
}
