document.getElementById('secretaria').addEventListener('change', function(){
    var secretariaId = this.value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            var resposta = JSON.parse(xhr.responseText);
            console.log(resposta);
 
            document.getElementById('setor').innerHTML = "<option> selecione o setor</option>";
            

            for (let i = 0; i < resposta.length; i++) {
                var option = document.createElement('option');
                option.value = resposta[i].codigo_setor;
                option.text = resposta[i].nome;
                document.getElementById('setor').add(option);
            }
            
        }
    }

    xhr.open('GET', 'public/js/functionRegisters/consulta_ajax.php?secretaria_id=' + secretariaId, true );
    xhr.send();

})