jQuery(document).ready(function() {
    console.log("main.js: loaded");

    const socket = new WebSocket('ws://86.125.214.215:3000');
    socket.onopen = () => socket.send('Hello Server');
    socket.onmessage = e => console.log('Server:', e.data);

    jQuery('#start_hunt').on('click', function() {
        console.log("#start_hunt: clicked");
    });
});

function loadUserInfo(uid) {
    if (!uid.match(/^\d+$/)) {
        document.getElementById('username').textContent = '';
        document.getElementById('xp').textContent = '0';
        document.getElementById('hp').textContent = '0';
        document.getElementById('attack').textContent = '0';
        return;
    }
    fetch('?ajax_user=' + encodeURIComponent(uid))
        .then(r => r.json())
        .then(data => {
            document.getElementById('username').textContent = data.username || '';
            document.getElementById('xp').textContent = data.xp || 0;
            document.getElementById('hp').textContent = data.hp || 0;
            document.getElementById('attack').textContent = data.attack || 0;
        });
}