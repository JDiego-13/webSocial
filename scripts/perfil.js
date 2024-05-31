document.getElementById('foto_usuario').onclick = function(){
    document.getElementById('foto').click();
};

document.getElementById('foto').onchange = function(event){
    const [file] = event.target.files;
    if(file){
        document.getElementById('foto_usuario').src = URL.createObjectURL(file);
    }
};