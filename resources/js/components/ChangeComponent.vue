<template>
    <span v-on:click="set_active()">
        <input
            type="text"
            v-if="is_active"
            v-bind:value="value"
            v-on:input="$emit('input', $event.target.value)"
            v-on:blur="set_not_active()"
            ref="input"
            v-bind:style="{width: width + 'px'}"
        >
        <span v-if="!is_active">{{ value }}</span>
    </span>
</template>

<script>
    export default {
        props: ["value"],
        data: function() {
            return {
                is_active: false
            };
        },
        methods: {
            set_active: function() {
                if (this.is_active)
                    return;

                this.is_active = true;
                this.$nextTick(() => this.$refs.input.focus())
            },
            set_not_active: function() {
                this.is_active = false;
            }
        },
        computed: {
            width: function() {
                return 8*((''+this.value).length + 1);
            }
        }
    }
</script>

<style>

</style>
