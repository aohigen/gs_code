//最初はweb3でやろうとしたが、Laravelのルーティングと干渉が怖かったのでやめた

// //Express呼び出し
// const express = require('express');
// const app = express();
// //web3呼び出し
// const Web3 = require("web3");  
// //ブロックチェーンを指定
// const url = "http://localhost:7545";
// const web3 = new Web3();
// web3.setProvider(new web3.providers.HttpProvider(url));

// app.get('/web3/get_accounts', function(req, res){
//     async function func() {
//         let accounts = await web3.eth.getAccounts();
//         res.redirect('http://localhost:8000/timeline');
//     }
//     func();
// })

// app.get('/web3/make_account', function(req, res){
//     async function func() {
//         let newAddress = await web3.eth.personal.newAccount("123");
//         res.send(newAddress);
//     }
//     func();
// })

// app.get('/web3/send_transaction', function(req, res){
//     async function func() {
//         let accounts = await web3.eth.getAccounts();
//         let transactionReceipt = await web3.eth.sendTransaction({from:accounts[0],to:accounts[1],value:100});
//         res.send(accounts[1]);
//     }
//     func();
// })

// app.get('/web3/get_blockNumber', function(req, res){
//     async function func() {
//         let blockNumber = await web3.eth.blockNumber;
//         res.send(blockNumber);
//     }
//     func();
// })

// app.get('/web3/get_balance', function(req, res){
//     async function func() {
//         let accounts = await web3.eth.getAccounts();
//         let balance = await web3.eth.getBalance(accounts[0]);
//         res.send(balance);
//     }
//     func();
// })

// app.get('/web3/get_coinbase', function(req, res){
//     async function func() {
//         let coinbase = await web3.eth.coinbase;
//         res.send(coinbase);
//     }
//     func();
// })

// app.get('/web3/eth_all', function(req, res){
//     async function func() {
//         var newAddress = await web3.eth.personal.newAccount("123");
//         var accounts = await web3.eth.getAccounts();
//         var sendTransaction = await web3.eth.sendTransaction({from:accounts[0],to:newAddress,value:10000});
//         var checkBalanceFrom = await web3.eth.getBalance(accounts[0]);
//         var checkBalanceTo = await web3.eth.getBalance(newAddress);
//         // var balanceWei = await web3.eth.getBalance(accounts[0]);
//         // var balanceEth = web3.utils.fromWei(balanceWei, 'ether');
//         res.send('あはは');
//     }
//     func();
// })

// var server = app.listen(3000, function(){
//     console.log("Server runnning...");
// })