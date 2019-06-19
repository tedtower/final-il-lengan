var cols = document.getElementsByClassName('pending');
  for(i=0; i<cols.length; i++) {
    cols[i].style.backgroundColor = '#70CAD6';
    cols[i].style.border = '2px solid white';
    cols[i].style.borderRadius = '7px';
    cols[i].style.color = 'white';
    cols[i].style.textShadow = '1px 1px 1px black';
}

var cols1 = document.getElementsByClassName('in preparation');
  for(i=0; i<cols1.length; i++) {
    cols1[i].style.backgroundColor = '#E0D352';
    cols1[i].style.border = '2px solid white';
    cols1[i].style.borderRadius = '7px';
    cols1[i].style.color = 'white';
    cols1[i].style.textShadow = '1px 1px 1px black';
}

var cols2 = document.getElementsByClassName('finished');
  for(i=0; i<cols2.length; i++) {
    cols2[i].style.backgroundColor = '#69B960';
    cols2[i].style.border = '2px solid white';
    cols2[i].style.borderRadius = '7px';
    cols2[i].style.color = 'white';
    cols2[i].style.textShadow = '1px 1px 1px black';
}