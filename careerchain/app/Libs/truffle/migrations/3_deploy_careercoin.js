var CCCToken = artifacts.require("CCCToken");
 
module.exports = function(deployer) {
    deployer.deploy(CCCToken);
};
