const listSkynimasA = document.querySelector('#listSkynimasA');
const listSkynimasM = document.querySelector('#listSkynimasM');
const buttonSkintiA = document.querySelector('[name=skintiA]');
const buttonSkintiVisusA = document.querySelector('[name=skintiVisusA]');
const buttonSkintiM = document.querySelector('[name=skintiM]');
const buttonSkintiVisusM = document.querySelector('[name=skintiVisusM]');
const buttonSkintiViskaA = document.querySelector('[name=skintiViska]');
const buttonSkintiViskaM = document.querySelector('[name=skintiViska]');
const errorMsg = document.querySelector('#error');


document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrlS + '/listSkynimasA', {})
        .then(function(response) {

           
            listSkynimasA.innerHTML = response.data.listSkynimasA;
            errorMsg.innerHTML = '';
            // augurku klases nodai, is naujo pasetint trinimo mygtuko eventus
            skintiA();
            skintiVisusA();
            
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });

});


document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrlS + '/listSkynimasM', {})
        .then(function(response) {

            console.log(response.data.listSkynimasM);
            listSkynimasM.innerHTML = response.data.listSkynimasM;
            errorMsg.innerHTML = '';
            // augurku klases nodai, is naujo pasetint trinimo mygtuko eventus
            skintiM();
            skintiVisusM();
            
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });

});


const skintiA = () => {
    const agurkai = document.querySelectorAll('.agurkas');
    agurkai.forEach(agurkas => {
        agurkas.querySelector('[type=button]').addEventListener('click', () => {
                const id = agurkas.querySelector('[name=skintiA]').value;
                const countA = moliugas.querySelector('[name=kiekis]').value;
                axios.post(apiUrlS + '/listSkynimasA', {
                    'id': id,
                    'kiekis': countA,
                })
                    .then(function (response) {
                        console.log(response);
                        listSkynimasA.innerHTML = response.data.listSkynimasA;
                        skintiA();
                        skintiVisusA();
                    })
                    .catch(function (error) {
                        console.log(error);
                        errorMsg.innerHTML = error.response.data.msg;
                    });
            });
    })
}

const skintiVisusA = () => {
    const agurkai = document.querySelectorAll('.agurkas');
    agurkai.forEach(agurkas => {
        agurkas.querySelector('[type=button]').addEventListener('click', () => {
                const id = agurkas.querySelector('[name=skintiVisusA]').value;
                axios.post(apiUrlS + '/listSkynimasA', {
                    id: id,
                })
                    .then(function (response) {
                        console.log(response);
                        listSkynimasA.innerHTML = response.data.listSkynimasA;
                        skintiA();
                        skintiVisusA();
                    })
                    .catch(function (error) {
                        console.log(error);
                        errorMsg.innerHTML = error.response.data.msg;
                    });
            });
        });
}

const skintiM = () => {
    const moliugai = document.querySelectorAll('.moliugas');
    moliugai.forEach(moliugas => {
        moliugas.querySelector('[type=button]').addEventListener('click', () => {
                const id = moliugas.querySelector('[name=skintiM]').value;
                const countM = moliugas.querySelector('[name=kiekis]').value;
                axios.post(apiUrlS + '/listSkynimasM', {
                    'id': id,
                    'kiekis': countM,
                })
                    .then(function (response) {
                        console.log(response);
                        listSkynimasM.innerHTML = response.data.listSkynimasM;
                        skintiM();
                        skintiVisusM();
                    })
                    .catch(function (error) {
                        console.log(error);
                        errorMsg.innerHTML = error.response.data.msg;
                    });
            });
        });
}

const skintiVisusM = () => {
    const moliugai = document.querySelectorAll('.moliugas');
    moliugai.forEach(moliugas => {
        moliugas.querySelector('[type=button]').addEventListener('click', () => {
                const id = moliugas.querySelector('[name=skintiVisusM]').value;
                axios.post(apiUrlS + '/listSkynimasM', {
                    id: id,
                    'skintiVisusM': 1
                })
                    .then(function (response) {
                        console.log(response);
                        listSkynimasM.innerHTML = response.data.listSkynimasM;
                        skintiM();
                        skintiVisusM();
                    })
                    .catch(function (error) {
                        console.log(error);
                        errorMsg.innerHTML = error.response.data.msg;
                    });
            });
        });
}

buttonSkintiViskaA.addEventListener('click', () => {
    axios.post(apiUrlS + '/listSkynimasA' , {
        'skintiViskaA': 1
    })
        .then(function (response) {
            console.log(response);
            listSkynimasA.innerHTML = response.data.listSkynimasA;
            skintiA();
            skintiVisusA();
        })
        .catch(function (error) {
            console.log(error);
            errorMsg.innerHTML = error.response.data.msg;
        });
});

buttonSkintiViskaM.addEventListener('click', () => {
    axios.post(apiUrlS + '/listSkynimasM' , {
        'skintiViskaM': 1
    })
        .then(function (response) {
            console.log(response);
            listSkynimasM.innerHTML = response.data.listSkynimasM;
            skintiM();
            skintiVisusM();
        })
        .catch(function (error) {
            console.log(error);
            errorMsg.innerHTML = error.response.data.msg;
        });
});