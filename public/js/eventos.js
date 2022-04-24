window.addEventListener('load', () => {
    let a = document.getElementById('cnpj_cantina');
    
    a.addEventListener("input", () => {
        let arr = a.value.split('');
        
        if(arr.length > 2 && arr[2] != "."){
            arr.splice(2,0,'.');
        }
  
        if(arr.length > 6 && arr[6] != "."){
            arr.splice(6,0,'.');
        }
  
        if(arr.length > 10 && arr[10] != "/"){
            arr.splice(10,0,'/');
        }
  
        if(arr.length > 15 && arr[15] != "-"){
            arr.splice(15,0,'-');
        }
  
        a.value = arr.join('');
    });
  });
  
window.addEventListener('load', () => {
    let a = document.getElementById('cpf-responsavel');
    
    a.addEventListener("input", () => {
        let arr = a.value.split('');
        
        if(arr.length > 3 && arr[3] != "."){
            arr.splice(3,0,'.');
        }

        if(arr.length > 7 && arr[7] != "."){
            arr.splice(7,0,'.');
        }

        if(arr.length > 11 && arr[11] != "-"){
            arr.splice(11,0,'-');
        }

        a.value = arr.join('');
    });
});
window.addEventListener('load', () => {
    let a = document.getElementById('resp-cpf-editar');
    
    a.addEventListener("input", () => {
        let arr = a.value.split('');
        
        if(arr.length > 3 && arr[3] != "."){
            arr.splice(3,0,'.');
        }

        if(arr.length > 7 && arr[7] != "."){
            arr.splice(7,0,'.');
        }

        if(arr.length > 11 && arr[11] != "-"){
            arr.splice(11,0,'-');
        }

        a.value = arr.join('');
    });
});


  
window.addEventListener('load', () => {
    let a = document.getElementById('tel_cantina');

    a.addEventListener("input", () => {
        let arr = a.value.split('');
        
        if(arr.length > 0 && arr[0] != "("){
            arr.splice(0,0,'(');
        }

        if(arr.length > 3 && arr[3] != ")"){
            arr.splice(3,0,')');
        }

        if(arr.length > 9 && arr[9] != "-"){
            arr.splice(9,0,'-');
        }

        a.value = arr.join('');
    });
});
window.addEventListener('load', () => {
    let a = document.getElementById('resp-tel-editar');

    a.addEventListener("input", () => {
        let arr = a.value.split('');
        
        if(arr.length > 0 && arr[0] != "("){
            arr.splice(0,0,'(');
        }

        if(arr.length > 3 && arr[3] != ")"){
            arr.splice(3,0,')');
        }

        if(arr.length > 9 && arr[9] != "-"){
            arr.splice(9,0,'-');
        }

        a.value = arr.join('');
    });
});

window.addEventListener('load', () => {
    let a = document.getElementById('recipient-tel');
    
    a.addEventListener("input", () => {
        let arr = a.value.split('');
        
        if(arr.length > 0 && arr[0] != "("){
            arr.splice(0,0,'(');
        }

        if(arr.length > 3 && arr[3] != ")"){
            arr.splice(3,0,')');
        }

        if(arr.length > 9 && arr[9] != "-"){
            arr.splice(9,0,'-');
        }

        a.value = arr.join('');
    });
});