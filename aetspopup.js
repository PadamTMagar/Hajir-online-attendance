

const openpopup = document.getElementById('openpopup');
const popup = document.getElementById('popup');
const background = document.getElementById('background');

openpopup.addEventListener('click', () =>{
    popup.style.display = 'block';
    background.style.display = 'block'; 
});

function close(){
    popup.style.display = 'none';
    background.style.displau = 'none';
}

background.addEventListener('click' , close);


