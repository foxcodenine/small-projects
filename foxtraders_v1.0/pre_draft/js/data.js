

const binanceSocketADAUSDT = new WebSocket('wss://stream.binance.com:9443/ws/adausdt@kline_1h');


const appData = document.querySelector('#data');

binanceSocketADAUSDT.onmessage = (e) => {
    e.preventDefault()
    let messageObj = JSON.parse(e.data);
    appData.append(messageObj.k.c);
    console.log(messageObj.k.c);
}