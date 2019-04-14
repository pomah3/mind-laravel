<template>
    <div>
        <div
            v-for="(select, id) in selected"
        >
            <input type="hidden" :name="name + '[]'" :value="select.value">
            <div>
                {{ select.name }}
                <span v-on:click="remove(id)">
                    &times;
                </span>
            </div>
        </div>
        <select ref="select" v-on:change="add()">
            <option
                v-for="variant in variants"
                :value="variant.value"
            >
                {{ variant.name }}
            </option>
        </select>
        <div v-on:click="add()">Добавить</div>
    </div>
</template>

<script>
    export default {
        props: ["variants", "name"],
        data: function() {
            return {
                selected: []
            };
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
