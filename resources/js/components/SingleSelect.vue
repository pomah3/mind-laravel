<template>
    <div class="user-select">
        <input type="text" v-model="search" :placeholder="placeholder" class="form-control">
        <select ref="select" :name="name" class="form-control">
            <option
                v-for="variant in searched_variants"
                :value="variant.value"
                :selected="variant.selected"
            >
                {{ variant.name }}
            </option>
        </select>

    </div>
</template>

<script>
    export default {
        props: ["variants", "name", "placeholder"],
        data: function() {
            return {
                search: ""
            };
        },
        computed: {
            searched_variants: function() {
                let r = new RegExp(this.search.trim(), 'i');
                return this.variants.filter(a => r.test(a.name));
            }
        }
    }
</script>
