var web3 = new (require("web3"));
web3.setProvider(new web3.providers.WebsocketProvider("ws://localhost:7545"));

// LockerEx2
const abi = [
	{
		"constant": false,
		"inputs": [
			{
				"name": "_num",
				"type": "uint256"
			}
		],
		"name": "openLocker",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"name": "_pass",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "_sender",
				"type": "address"
			},
			{
				"indexed": false,
				"name": "_logText",
				"type": "string"
			}
		],
		"name": "openLog",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "_sender",
				"type": "address"
			}
		],
		"name": "errLog",
		"type": "event"
	}
];
const addr = '0x353464aD23497a635CE125238D976a6f79c3E223';
var contract = new web3.eth.Contract(abi, addr);

var t = contract.events.openLog({}, (err,event) => {
    if(!err) {
		var addr = event.returnValues._sender;
		var log = event.returnValues._logText;
        console.log("[notice] Locker Open! (addr:" + addr + " ,log:" + log + ")");
    } else {
        console.log(err);
    }
});

var x = contract.events.errLog({}, (err,event) => {
    if(!err) {
		var addr = event.returnValues._sender;
        console.log("[notice] Locker Invalid Access! (addr:" + addr + ")");
    } else {
        console.log(err);
    }
});

