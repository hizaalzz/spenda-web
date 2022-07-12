const btnMenu = document.querySelector('.menu');
const closeBtn = document.querySelector('.closebtn');


let konten = document.querySelector('#soalContent');
let sidebar = document.querySelector('.sidebar');


let checkboxKecil = document.querySelector('#kecil');
let checkboxSedang = document.querySelector('#sedang');
let checkboxBesar = document.querySelector('#besar');

const settingType = {
    FONTSIZE: 'fontsize',
    ANSWER: 'answer'
}

const fontvariant = {
    KECIL: 'kecil',
    SEDANG: 'sedang',
    BESAR: 'besar'
}

function setFontSize(fontModel) {
    removeAllTextProperty();

    setTextProperty(fontModel);
    saveSettings(fontModel, settingType.FONTSIZE);
}

function removeAllTextProperty() {
    if (konten.classList.contains('kecil')) konten.classList.remove('kecil');

    if (konten.classList.contains('sedang')) konten.classList.remove('sedang');

    if (konten.classList.contains('besar')) konten.classList.remove('besar');

}

function setTextProperty(font) {
    konten.classList.add(font);
}


document.addEventListener('DOMContentLoaded', () => {
    changeFontSize();
});

window.addEventListener('loadFontSettings', () => {
    changeFontSize();
});

function changeFontSize() {
    const fontsize = loadSettings(settingType.FONTSIZE);

    // Set fontsize
    if (fontsize) {
        if (fontsize == 'kecil') {
            checkboxKecil.checked = true;
            setTextProperty(fontvariant.KECIL);

        } else if (fontsize == 'sedang') {
            checkboxSedang.checked = true;
            setTextProperty(fontvariant.SEDANG);

        } else if (fontsize == 'besar') {
            checkboxBesar.checked = true;
            setTextProperty(fontvariant.BESAR);

        }
    }
}

// Events

document.addEventListener('click', (e) => {
    if (e.target != btnMenu && e.target != btnIcon && e.target != sidebar) {
        closeSidebar();
    }
});

btnMenu.addEventListener('click', () => {   
    openSidebar();
});

closeBtn.addEventListener('click', () => {
    closeSidebar();
});

//Disable right click 

// document.addEventListener('contextmenu', (e) => {
//     e.preventDefault();
// });

function saveSettings(data, type) {
    switch (type) {
        case settingType.FONTSIZE:
            localStorage.setItem(settingType.FONTSIZE, data);
    }
}

function loadSettings(key) {
    return localStorage.getItem(key) ?? null;
}


//sidebar 
function openSidebar() {
    sidebar.classList.add('d-block');
    content.classList.add('blur');
    footer.classList.add('blur');
}

function closeSidebar() {
    if(sidebar.classList.contains('d-block')) {
        sidebar.classList.remove('d-block');
    }

    content.classList.remove('blur');
    footer.classList.remove('blur');
}