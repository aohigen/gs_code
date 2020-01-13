const Web3 = require("web3");  
const url = "http://localhost:7545";
var web3 = new Web3();
web3.setProvider(new web3.providers.HttpProvider(url));

//独自トークンのコントラクトアドレスを指定
const contractAddress = "0x05DB568c57FDA1be54bCb8deAF956a4D1cB7396c";
//ABIを指定
const abi = [
	{
		"constant": false,
		"inputs": [
			{
				"name": "_str",
				"type": "string"
			}
		],
		"name": "setCareer",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "careerMemory",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getCareer",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	}
]


async function func() {
	//アカウントの一覧を取得
	let accounts = await web3.eth.getAccounts();
    let coinbase = await accounts[0];
    //トークンアドレスからコントラクトを定数に格納（web3 ver1.0以降の呼び出し方）
    const myContract = await new web3.eth.Contract(abi,contractAddress);
	//ブロックチェーンに保存をする前にキャリア情報をハッシュ化
	let careerHashed = web3.utils.sha3(process.argv[2]);
	//ブロックチェーンに保存。ガスリミットに到達してしまったのでガスリミットを指定
	let receipt = await myContract.methods.setCareer(careerHashed).send({from: coinbase,gas: 1000000});
	//トランザクションIDを返却
    console.log(receipt.transactionHash);
}
//関数の実行
func();

