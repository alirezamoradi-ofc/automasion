function time(){

    var d      = new Date();

    let Hour   = d.getHours();
    let Minute = d.getMinutes();
    let Second = d.getSeconds();

    document.querySelector('#clock').innerHTML = Second + ' ' + ':' + ' ' +
    Minute + ' ' + ':' + ' ' + Hour;
}

setInterval(time, 1000);

let date  = d.getDate()     + 9;
let Month = d.getMonth()    - 2;
let Year  = d.getFullYear() - 621;

let getdate = document.querySelector('.date-cell');
getdate.innerHTML = Year + "/" + Month + "/" + date;