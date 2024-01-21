

const inputFile = document.getElementById('hsp_teptin');
console.log(inputFile)
const defalut = document.getElementById('default-img');
    inputFile.addEventListener('change', (e) =>{
        defalut.src = URL.createObjectURL(inputFile.files[0])
})

console.log(inputFile)