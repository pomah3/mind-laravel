<template>
    <tr>
        <td>{{ name }}</td>
        <td>{{ need_marks }}</td>
        <td>{{ avg }}</td>
        <td><change-component v-model="marks_list"/></td>
    </tr>
</template>

<script>
    import {get_need_marks} from '../marks_utils';

    export default {
        props: ["name", "marks", "need_avg", "future_mark"],
        mounted: function() {
            this.marks_list = this.marks.join(" ");
        },
        data: function() {
            return {
                marks_list: ""
            };
        },
        computed: {
            avg: function() {
                let avg = this.marks_arr.mean();
                return Math.floor(avg*100 + 0.5)/100
            },
            marks_arr: function() {
                return this.marks_list.split(" ").map(a => parseInt(a)).filter(a => !isNaN(a));
            },
            need_marks: function() {
                return get_need_marks(
                    this.future_mark,
                    this.need_avg,
                    this.marks_arr
                );
            }
        }
    }
</script>
