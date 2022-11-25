function addRow()
{  var tab = document.getElementById('table2');


   var tr1 = document.createElement('tr');


    var titreniv = document.getElementById('titreniveau');

    var selectniv = document.getElementById('selectniv');
    
    var titredip = document.getElementById('tdtitre');

    var inputtitredip = document.getElementById('inputdip');


    var tr2 = document.createElement('tr');

    var titreecole = document.getElementById('tdecole');

    var inputecole = document.getElementById('inputecole');

    var titredate = document.getElementById('tddate');

    var inputdate = document.getElementById('inputdate');

    tab.appendChild(tr1);
    var td1 = document.createElement('td');
    tr1.appendChild(td1);
    var c1 = titreniv.cloneNode(true);
    td1.appendChild(c1);

    var td2 = document.createElement('td');
    tr1.appendChild(td2);
    var c2 = selectniv.cloneNode(true);
    td2.appendChild(c2);

    var td3 = document.createElement('td');
    tr1.appendChild(td3);
    var c3 = titredip.cloneNode(true);
    td3.appendChild(c3);

    var td4 = document.createElement('td');
    tr1.appendChild(td4);
    var c4 = inputtitredip.cloneNode(true);
    td4.appendChild(c4);
    tr1.style.height="80px";
    /***** */
    tab.appendChild(tr2);

    var td5 = document.createElement('td');
    tr2.appendChild(td5);
    var c5 = titreecole.cloneNode(true);
    td5.appendChild(c5);

    var td6 = document.createElement('td');
    tr2.appendChild(td6);
    var c6 = inputecole.cloneNode(true);
    td6.appendChild(c6);

    var td7 = document.createElement('td');
    tr2.appendChild(td7);
    var c7 = titredate.cloneNode(true);
    td7.appendChild(c7);

    var td8 = document.createElement('td');
    tr2.appendChild(td8);
    var c8 = inputdate.cloneNode(true);
    td8.appendChild(c8);
    tr2.style.height="80px"; 
}