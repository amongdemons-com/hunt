jQuery(document).ready(function() {
    console.log("main.js: loaded");

    jQuery('#start_hunt').on('click', function() {
        const uid = jQuery('#user_id').val();
        if (!uid.match(/^\d+$/)) {
            alert('Please enter a valid user ID.');
            return;
        }
        jQuery('#hunt_status').text('Hunting...');
        fetch('?ajax_hunt=' + encodeURIComponent(uid))
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    jQuery('#hunt_status').text('Hunt successful! XP gained: ' + data.xp);
                } else {
                    jQuery('#hunt_status').text('Hunt failed: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error during hunt:', error);
                jQuery('#hunt_status').text('An error occurred during the hunt.');
            });
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