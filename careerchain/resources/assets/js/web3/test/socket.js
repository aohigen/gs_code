var web3 = new (require("web3"));
//web3.setProvider(new web3.providers.HttpProvider("http://localhost:7545"));
web3.setProvider(new web3.providers.WebsocketProvider("ws://localhost:7545"));

const subscription = web3.eth.subscribe('newBlockHeaders', (err,res) => {
    if (!err) {
        console.log("notice: new Block Created now! (BlockNumber=" + res.number + ")");
    } else {
        console.log(err);
    }
});