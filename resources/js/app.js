//import './bootstrap';
console.log("JS working!");
(async function(){
    console.log('start asnc');
    let response = await fetch(`${window.appData.apiRoot}/todos`, {
        headers: {
            'Accept': 'application/json'
        }
    });

    let data = await response.json();
    console.log(data);
})();