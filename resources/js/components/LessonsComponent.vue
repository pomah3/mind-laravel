<template>
    <table class="table table-sm">
        <tbody>
            <tr>
                <td>
                    <strong>Предмет</strong>
                </td>
                <td>
                    <strong>Количество</strong>
                    <change-component v-model="future_mark"/>
                    <strong>до</strong>
                    <change-component v-model="need_avg"/>
                </td>
                <td>
                    <strong>Средний балл</strong>
                </td>
                <td>
                    <strong>Оценки</strong>
                </td>
            </tr>

            <lesson-marks-component
                v-for="(lesson, i) in lessons"
                :name="lesson.name"
                :marks="lesson.marks"
                :key="i"
                :future_mark="future_mark"
                :need_avg="need_avg"
            />
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ["lessons"],
        data: function() {
            return {
                'future_mark': 5,
                'need_avg': 4.5
            }
        }
    }
</script>
