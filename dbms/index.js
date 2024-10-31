let username;
let address;
let age;
document.getElementById("mySubmit").onclick = function(){
    username = document.getElementById("myText").value;
    address = document.getElementById("my1").value;
    age = document.getElementById("age").value;
    document.getElementById("myH1").textContent = "Details of patient";
    document.getElementById("p1").textContent = `Name of patient: ${username}`;
    document.getElementById("p2").textContent = `Address of patient: ${address}`;
    document.getElementById("p3").textContent = `Age: ${age}`;
    
}