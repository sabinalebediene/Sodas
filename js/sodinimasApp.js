const buttonAgurkas = document.querySelector('[name=sodintiA]');
const buttonMoliugas = document.querySelector('[name=sodintiM]');
const listAgurku = document.querySelector('#listAgurku');
const listMoliugu = document.querySelector('#listMoliugu');
const errorMsg = document.querySelector('#error');


// ROVIMAS AGURKA
const addNewListA = () => {
    const agurkai = document.querySelectorAll('.agurkas');
    agurkai.forEach(agurkas => {
        agurkas.querySelector('[type=button]').addEventListener('click', () => {
            const id = agurkas.querySelector('[name=rautiA]').value;
            axios.post(apiUrl+'/removeA', {
                    id: id,
                })
                .then(function(response) {
                    listAgurku.innerHTML = response.data.listAgurku;
                    errorMsg.innerHTML = '';
                    addNewListA();
                })
                .catch(function(error) {
                    errorMsg.innerHTML = error.response.data.msg;
                });
        });
    });
}

// ROVIMAS MOLIUGA
const addNewListM = () => {
    const moliugai = document.querySelectorAll('.moliugas');
    moliugai.forEach(moliugas => {
        moliugas.querySelector('[type=button]').addEventListener('click', () => {
            const id = moliugas.querySelector('[name=rautiM]').value;
            axios.post(apiUrl+'/removeM', {
                    id: id,
                })
                .then(function(response) {
                    listMoliugu.innerHTML = response.data.listMoliugu;
                    errorMsg.innerHTML = '';
                    addNewListM();
// console.log('rado');
                })
                .catch(function(error) {
                    errorMsg.innerHTML = error.response.data.msg;
                });
        });
    });
}


document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrl + '/listAgurku', {})
        .then(function(response) {
            listAgurku.innerHTML = response.data.listAgurku;
            errorMsg.innerHTML = '';
            // augurku klases nodai, is naujo pasetint trinimo mygtuko eventus
            addNewListA();
            
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });

});

document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrl+'/listMoliugu', {})
        .then(function(response) {
            listMoliugu.innerHTML = response.data.listMoliugu;
            errorMsg.innerHTML = '';
            // augurku klases nodai, is naujo pasetint trinimo mygtuko eventus
            addNewListM();
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });

});


buttonAgurkas.addEventListener('click', () => {
    const countA = document.querySelector('[name=kiekisA]').value;
  
    axios.post(apiUrl+'/sodintiA', {
            kiekis: countA,
        })
        .then(function(response) {
           console.log(response.data);
           listAgurku.innerHTML = response.data.listAgurku;
           errorMsg.innerHTML = '';
           addNewListA();
           
        
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });
    
});

buttonMoliugas.addEventListener('click', () => {
    const countM = document.querySelector('[name=kiekisM]').value;
    axios.post(apiUrl + '/sodintiM', {
            kiekis: countM,
        })
        .then(function(response) {
            console.log(response.data);
            listMoliugu.innerHTML = response.data.listMoliugu;
            errorMsg.innerHTML = '';
            addNewListM();
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });
});


