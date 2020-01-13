var HelloTruffle = artifacts.require("HelloTruffle");
 
module.exports = function(deployer) {
    const name = "Truffle TAROU";
    deployer.deploy(HelloTruffle, name);
};
