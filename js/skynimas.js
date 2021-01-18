const listSkynimasA = document.querySelector('#listSkynimasA');
const listSkynimasM = document.querySelector('#listSkynimasM');
const errorMsg = document.querySelector('#error');


document.addEventListener('DOMContentLoaded', () => {
    axios.post(apiUrlS + '/listSkynimasA', {})
        .then(function(response) {

            console.log(response.data);
            listSkynimasA.innerHTML = response.data.listSkynimasA;
            errorMsg.innerHTML = '';
            // augurku klases nodai, is naujo pasetint trinimo mygtuko eventus
            
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
            
        })
        .catch(function(error) {
            console.log(error.response.data.msg);
            errorMsg.innerHTML = error.response.data.msg;
        });

});