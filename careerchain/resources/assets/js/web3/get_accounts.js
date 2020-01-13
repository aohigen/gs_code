const Web3 = require("web3");  
const url = "http://localhost:7545";
var web3 = new Web3();
web3.setProvider(new web3.providers.HttpProvider(url));

async function func() {
    let accounts = await web3.eth.getAccounts();
    console.log(process.argv[2]+process.argv[4]+process.argv[3]);
    let val = [];
    val.push = process.argv[2];
    val.push = process.argv[3];
    val.push = process.argv[4];
    console.log(accounts);
}

func();
