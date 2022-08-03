

//Number format js
function formatNumber(id) {
    var data = document.getElementById(id).value;

    data = data.replaceAll(',','');
    let num = Number(data);
    document.getElementById(id).value  = num.toLocaleString('en-US');
    //console.log(data);
}

function onlyNumberKey(evt) {
  // Only ASCII character in that range allowed
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  //ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57
  if ((ASCIICode >=48 && ASCIICode <=57) || ASCIICode==44 || ASCIICode == 46)
      return true;
  return false;
}
