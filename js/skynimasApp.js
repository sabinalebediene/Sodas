const listSkynimasA = document.querySelector('#listSkynimasA');
const listSkynimasM = document.querySelector('#listSkynimasM');
const buttonSkintiA = document.querySelector('[name=skintiA]');
const buttonSkintiVisusA = document.querySelector('[name=skintiVisusA]');
const buttonSkintiM = document.querySelector('[name=skintiM]');
const buttonSkintiVisusM = document.querySelector('[name=skintiVisusM]');
const buttonSkintiViska = document.querySelector('[name=skintiViska]');
const errorMsg = document.querySelector('#error');


document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrlS + '/listSkynimasA', {})
        .then(function(response) {

           
            listSkynimasA.innerHTML = response.data.listSkynimasA;
            console.log(listSkynimasA);
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

            console.log(response.data);
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
        if (buttonSkintiA) {
            buttonSkintiA.addEventListener('click', () => {
                const id = agurkas.querySelector('[name=skintiA]').value;
                const count = moliugas.querySelector('[name=kiekis]').value;
                axios.post(apiUrlS + '/listSkynimasA', {
                    'id': id,
                    'kiekis': count,
                    'skintiM': 1
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
        }
    })
}

const skintiVisusA = () => {
    const agurkai = document.querySelectorAll('.agurkas');
    agurkai.forEach(agurkas => {
        if (buttonSkintiVisusA) {
            buttonSkintiVisusA.addEventListener('click', () => {
                const id = agurkas.querySelector('[name=skintiVisusA]').value;
                axios.post(apiUrlS + '/listSkynimasA', {
                    id: id,
                    'skintiVisusA': 1
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
        }
    })
}

const skintiM = () => {
    const moliugai = document.querySelectorAll('.moliugas');
    moliugai.forEach(moliugas => {
        if (buttonSkintiM) {
            buttonSkintiM.addEventListener('click', () => {
                const id = moliugas.querySelector('[name=skintiM]').value;
                const count = moliugas.querySelector('[name=kiekis]').value;
                axios.post(apiUrlS + '/listSkynimasM', {
                    'id': id,
                    'kiekis': count,
                    'skintiM': 1
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
        }
    })
}

const skintiVisusM = () => {
    const moliugai = document.querySelectorAll('.moliugas');
    moliugai.forEach(moliugas => {
        if (buttonSkintiVisusM) {
            buttonSkintiVisusM.addEventListener('click', () => {
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
        }
    })
}

buttonSkintiViska.addEventListener('click', () => {
    axios.post(apiUrlS + '/listSkynimasA' + '/listSkynimasM' , {
        'nuimti-viska': 1
    })
        .then(function (response) {
            console.log(response);
            listSkynimasA.innerHTML = response.data.listSkynimasA;
            listSkynimasM.innerHTML = response.data.listSkynimasM;
            skintiA();
            skintiVisusA();
            skintiM();
            skintiVisusM();
        })
        .catch(function (error) {
            console.log(error);
            errorMsg.innerHTML = error.response.data.msg;
        });
});