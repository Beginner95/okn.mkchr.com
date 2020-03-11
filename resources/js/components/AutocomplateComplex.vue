<template>
    <div>
        <input
            type="text"
            name="complex"
            placeholder="Введите название комплекса"
            v-model="queryString"
            v-on:keyup="getResults()"
            class="form-control"
            @focus="modal = true"
            autocomplete="off">
        <div v-if="complexes.length && modal">
            <ul class="list-group">
                <li class="list-group-item" v-for="complex in complexes" @click="setState(complex)">{{ complex.name }}</li>
            </ul>
        </div>

        <div v-if="notComplex" class="alert alert-warning" role="alert" style="margin-top: 5px">
            Ансамбля нет в списке перейдите по ссылке для добавления  <a href="#" class="alert-link">Добавить ансамбл</a>
        </div>
    </div>
</template>
<script>
    export default{
        data() {
            return {
                queryString: '',
                modal: false,
                notComplex: null,
                complexes: [],
            }
        },
        methods: {
            getResults() {
                this.complexes = [];
                if (this.queryString.length > 2) {
                    axios.get('/autocomplete-complex',{params: {queryString: this.queryString}}).then(response => {
                        if (response.data.length === 0) {
                            this.notComplex = true;
                        } else {
                            this.notComplex = false;
                        }
                        this.complexes = response.data;
                    });
                }
            },
            setState(state) {
                this.queryString = state.name;
                this.modal = false;
            }
        }
    }
</script>