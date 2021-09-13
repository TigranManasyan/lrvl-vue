<template>
    <b-container class="mt-2">
        <b-row>
            <b-col cols="12">
                <router-link :to="{name: 'CreateProduct'}" class="btn btn-outline-success float-right mb-5">Create Product</router-link>
            </b-col>
        </b-row>
        <b-row>
            <b-col cols="12">
                <b-table striped hover :items="items" :fields="fields">
                    <template #cell(action)>
                        <b-button class="btn btn-info"> View</b-button>
                        <b-button class="btn btn-danger"> Delete</b-button>
                    </template>
                </b-table>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    data() {
        return {
            fields: [
                {
                    key: 'last_name',
                },
                {
                    key: 'first_name',
                },
                {
                    key: 'age',
                    label: 'Person age',
                },
                {
                    key: 'action'
                }
            ],
            items: [
                { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
                { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
                { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
                { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
            ]
        }
    }
}
</script>

<style scoped>

</style>
