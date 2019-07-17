function setac_counter() {
  var YY = 2019;
  var MM = 09;
  var DD = 03;
  var HH = 08;
  var MI = 00;
  var SS = 00; 

  var hoje = new Date();  
  var futuro = new Date(YY,MM-1,DD,HH,MI,SS); 

  var ss = parseInt((futuro - hoje) / 1000);  
  var mm = parseInt(ss / 60);  
  var hh = parseInt(mm / 60);  
  var dd = parseInt(hh / 24);   
  ss = ss - (mm * 60);  
  mm = mm - (hh * 60);  
  hh = hh - (dd * 24);   

  if(dd < 0) {
    dd = 0;
  }

  if(hh < 0) {
    hh = 0;
  }

  if(mm < 0) {
    mm = 0;
  }

  if(ss < 0) {
    ss = 0;
  }
  
  document.getElementById('count_days').innerHTML = dd;
  document.getElementById('count_hours').innerHTML = hh;  
  document.getElementById('count_minutes').innerHTML = mm;  
  document.getElementById('count_seconds').innerHTML = ss;  

  setTimeout(setac_counter,1000);
}
