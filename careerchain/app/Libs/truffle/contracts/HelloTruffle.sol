pragma solidity ^0.5.0;

contract HelloTruffle {
    string name;

    constructor(string memory _str) public {
        name = _str;
    }

    function getName() public view returns (string memory) {
        return name;
    }
    
    function setName(string memory _str) public {
        name = _str;
    }
}
