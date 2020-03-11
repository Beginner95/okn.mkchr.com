<template>
    <div>
        <input
            type="text"
            name="district"
            placeholder="Введите название района"
            v-model="queryString"
            v-on:keyup="getResults()"
            class="form-control"
            @focus="modal = true"
            autocomplete="off">
        <div v-if="districts.length && modal">
            <ul class="list-group">
                <li class="list-group-item" v-for="district in districts" @click="setState(district)">
                    {{ district.name }}
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default{
        data() {
            return {
                queryString: '',
                modal: false,
                districts: [],
            }
        },
        methods: {
            getResults() {
                this.districts = [];
                if (this.queryString.length > 2) {
                    axios.get('/autocomplete-district',{params: {queryString: this.queryString}}).then(response => {
                        this.districts = response.data;
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