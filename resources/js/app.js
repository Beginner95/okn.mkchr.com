/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('autocomplete-complex', require('./components/AutocomplateComplex.vue').default);
Vue.component('autocomplete-district', require('./components/AutocomplateDistrict.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        isVisible: false,
        isVisibleFile: false
    },

    methods: {
        deleteObject(id) {
            axios.delete('object/' + id)
                .then(response => {
                    if (response.data === 'ok') {
                        window.location.href = '/';
                    }
                });
        }
    }
});

let complexName = $('#complexName').attr('data-complex-name');
let districtName = $('#districtName').attr('data-district-name');

if (complexName !== 'undefined') {
    $('input[name="complex"]').val(complexName);
}

if (districtName !== 'undefined') {
    $('input[name="district"]').val(districtName);
}

$('#deleteFile').on('click', function () {
    $('#fileName').val('');
});

document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('dataTable');
    const columns = document.getElementById('columns');
    let html = '';
    let fontSize = (localStorage.getItem('fontSize') !== null) ? localStorage.getItem('fontSize') : '10px';
    $(table).css('font-size', fontSize + 'px');
    for(let i = 1; i < columns.cells.length; i++) {
        let column_hide = '';
        if (getStorage() !== null) {
            let columnsHidden = getStorage();
            columnsHidden = columnsHidden.indexOf(String(i));
            if (columnsHidden !== -1) {
                column_hide = 'column-hide';
            }
        }
        html += '<li data-index="' + i + '" class="dropdown-item ' + column_hide + '">' + columns.cells[i].innerText + '</li>';
    }

    const headings = document.getElementsByClassName('headings')[0];
    headings.innerHTML = html;

    function hideColumn(index) {
        for(let i = 0; i < table.rows.length; i++) {
            $(table.rows[i].cells[index]).hide();
        }
        storage(index, 'add');
    }

    function showColumn(index) {
        for (let i = 0; i < table.rows.length; i++) {
            $(table.rows[i].cells[index]).show();
        }
        storage(index, 'remove');
    }

    hideColumnsInStorage();
    function hideColumnsInStorage() {
        let columnsHidden = getStorage();
        if (columnsHidden !== null) {
            for (let i = 0; i < columnsHidden.length; i++) {
                if (+columnsHidden[i] !== 0) {
                    hideColumn(columnsHidden[i]);
                }
            }
        }
    }

    headings.addEventListener('click', function (event) {
        let elem = event.target;
        if (elem.classList.contains('column-hide')) {
            elem.classList.remove('column-hide');
            showColumn(elem.dataset.index);
        } else {
            elem.classList.add('column-hide');
            hideColumn(elem.dataset.index);
        }
    });

    function storage(index, action) {
        let columnsHidden = getStorage();
        if (columnsHidden === null) {
            let indexesColumn = [];
            indexesColumn.push(index);
            localStorage.setItem('columns', indexesColumn);
        } else {
            if (columnsHidden.indexOf(String(index)) === -1) {
                columnsHidden.push(index);
            }

            if (action === 'remove') {
                columnsHidden.splice(columnsHidden.indexOf(String(index)), 1);
            }

            localStorage.setItem('columns', columnsHidden);
        }
    }

    function getStorage() {
        return (localStorage.getItem('columns') !== null) ? localStorage.getItem('columns').split(',') : null;
    }

    $(document)
        .on('click', '#upFont', e => {
            e.preventDefault();
            changeFontSize('inc');
        })
        .on('click', '#downFont', e => {
            e.preventDefault();
            changeFontSize('dec');
        });

    const changeFontSize = operation => {
        let step = 2;
        if (operation === 'inc') {
            fontSize = parseInt(fontSize) + step;
            $(table).css('font-size', `${fontSize}px`);
        } else {
            fontSize = parseInt(fontSize) - step;
            $(table).css('font-size', `${fontSize}px`);
        }
        localStorage.setItem('fontSize', fontSize);
    }
});
