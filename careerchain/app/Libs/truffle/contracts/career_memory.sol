pragma solidity >=0.4.25 <0.6.0;

contract careerBase {
    string public careerMemory;

    function setCareer(string memory _str) public returns(string memory) {
        careerMemory = _str;

    }

    function getCareer() public view returns (string memory) {
        return careerMemory;
    }
}