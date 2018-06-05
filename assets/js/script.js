var inpF = document.querySelector('#inpfile');

console.log(inpF);

document.querySelector('#btnaddfile').addEventListener('click', function () {
inpF.click();
// console.log('coucou');
});

function getfile() {
    if  (inpF.style.display === "none") {
        inpF.style.display = "block";
    } else {  
        console.log('fail');
    }

}