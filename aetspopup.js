

const openpopuppart = document.getElementById('openpopup');
const popup = document.getElementById('popup');
const background = document.getElementById('background');

openpopuppart.addEventListener('click', () => {
    popup.style.display = 'block';
    background.style.display = 'block'; 
});

function close_btn(){
    popup.style.display = 'none';
    background.style.display = 'none';
}

background.addEventListener('click' , close_btn);


