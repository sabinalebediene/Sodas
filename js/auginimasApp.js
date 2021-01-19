const listAuginimasA = document.querySelector('#listAuginimasA');
const listAuginimasM = document.querySelector('#listAuginimasM');
const buttonGrowA = document.querySelector('[name=augintiA]');
const buttonGrowM = document.querySelector('[name=augintiM]');
const errorMsg = document.querySelector('#error');


document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrlA + '/listAuginimasA', {})
        .then(function(response) {

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
    axios.post(apiUrlA  + '/listAuginimasM', {})
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

buttonGrowA.addEventListener('click', () => {

    axios.post(apiUrlA + '/augintiA', {})
        .then(function (response) {
            console.log(response);
            console.log(response.data);
            listAuginimasA.innerHTML = response.data.listAuginimasA;
        })
        .catch(function (error) {
            console.log(error);
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });
});

buttonGrowM.addEventListener('click', () => {

    axios.post(apiUrlA + '/augintiM', {
    })
        .then(function (response) {
            console.log(response);
            console.log(response.data);
            listAuginimasM.innerHTML = response.data.listAuginimasM;
        })
        .catch(function (error) {
            console.log(error);
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });
});