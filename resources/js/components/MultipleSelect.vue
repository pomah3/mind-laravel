<template>
    <div class="user-select">
        <input type="text" v-model="search" :placeholder="placeholder" class="form-control">
        <select ref="select" v-on:change="add()" class="form-control">
            <option
                v-for="variant in searched_variants"
                :value="variant.value"
            >
                {{ variant.name }}
            </option>
        </select>
        <div v-on:click="add()" class="user-select-add">Добавить</div>
        <div
            v-for="(select, id) in selected"
            class="user-select-item"
        >
            <input type="hidden" :name="name + '[]'" :value="select.value">
            <div class="user-select-name">
                {{ select.name }}
                <span v-on:click="remove(id)" class="user-select-delete">
                    &times;
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["variants", "name", "placeholder", "defaultSelect"],
        data: function() {
            let selected = [];
            if (this.defaultSelect)
                selected = this.variants.filter(x =>
                    this.defaultSelect.includes(x.value)
                );

            return {
                selected,
                search: "",
            };
        },
        computed: {
            searched_variants: function() {
                let r = new RegExp(this.search.trim(), 'i');
                return this.variants.filter(a => r.test(a.name));
            }
        },
        methods: {
            add: function() {
                let select = this.$refs.select;
                let {value, selectedIndex} = select;
                let name = select[selectedIndex].innerText.trim();
                this.selected.push({name, value});
            },
            remove: function(id) {
                this.selected.splice(id, 1);
            }
        }
    }
</script>
