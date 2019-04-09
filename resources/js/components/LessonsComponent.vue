<template>
    <table>
        <tr>
            <td>Предмет      </td>
            <td>
                Оценок <change-component v-model="future_mark"/>
                до <change-component v-model="need_avg"/>
            </td>
            <td>Средний балл </td>
            <td>Оценки       </td>
        </tr>

        <lesson-marks-component
            v-for="(lesson, i) in lessons"
            :name="lesson.name"
            :marks="lesson.marks"
            :key="i"
            :future_mark="future_mark"
            :need_avg="need_avg"
        >
        </lesson-marks-component>
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
