const listAuginimasA = document.querySelector('#listAuginimasA');
const listAuginimasM = document.querySelector('#listAuginimasM');
const errorMsg = document.querySelector('#error');


document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrlA, {

        listAuginimasA: 1,

        })
        .then(function(response) {

            console.log(response.data);
            listAuginimasA.innerHTML = response.data.listAuginimasA;
            errorMsg.innerHTML = '';
            // augurku klases nodai, is naujo pasetint trinimo mygtuko eventus
            
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });

});

document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrlA, {

        listAuginimasM: 1,

        })
        .then(function(response) {

            // console.log(response.data);
            listAuginimasM.innerHTML = response.data.listAuginimasM;
            errorMsg.innerHTML = '';
            // augurku klases nodai, is naujo pasetint trinimo mygtuko eventus
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });

});