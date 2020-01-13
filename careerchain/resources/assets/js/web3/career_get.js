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

//インストールしたethereum-input-data-decoderを使用
const InputDataDecoder = require('ethereum-input-data-decoder');
const decoder = new InputDataDecoder(abi);

//トランザクションのinputデータを取得して、デコーダーでデコード
async function func() {
	//送られてきたトランザクションIDから内容を取得
	let transaction = await web3.eth.getTransaction(process.argv[2]);
	//送られてきたプロジェクト名と内容をハッシュ化して照合
	let careerHashed = web3.utils.sha3(process.argv[3]);
	let inputData = decoder.decodeData(transaction.input);
	//結果を返す
	if(careerHashed == inputData.inputs){
		console.log(1);
	}else{
		console.log(0);
	}
}
//関数の実行
func();

