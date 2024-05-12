/* btc-connect-init.js */

document.addEventListener('DOMContentLoaded', function() {
    // Dynamically import the Bitcoin Connect module
    import('https://esm.sh/@getalby/bitcoin-connect@3.4.0')
        .then((BitcoinConnect) => {
            const { init, requestProvider } = BitcoinConnect;

            // Initialize Bitcoin Connect with options
            init({
                appName: 'My WordPress Site',
                showBalance: true // Optional: Display balance if available
            });

            // Event listeners for buttons, assuming they exist in the DOM
            const loginButton = document.getElementById('btc-connect-login-btn');
            const zapButton = document.getElementById('zap-button');

            if (loginButton) {
                loginButton.addEventListener('click', function() {
                    requestProvider()
                        .then(provider => {
                            console.log('Provider requested:', provider);
                            // Simulate a login process
                            alert('Logged in successfully with wallet!');
                        })
                        .catch(error => {
                            console.error('Error requesting provider:', error);
                            alert('Failed to connect wallet.');
                        });
                });
            }

            if (zapButton) {
                zapButton.addEventListener('click', function() {
                    // Placeholder: Replace with actual transaction logic
                    console.log('Attempting to send sats...');
                    alert('Sats sent successfully!');
                });
            }
        })
        .catch(error => {
            console.error('Failed to load Bitcoin Connect:', error);
        });
});
