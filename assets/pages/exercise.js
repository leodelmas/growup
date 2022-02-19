document.addEventListener('DOMContentLoaded', (event) => {
    let recordedExerciceType = document.getElementById("exercise_recorded_exercise")
    let exerciceNameType = document.getElementById("exercise_name")
    if (null !== recordedExerciceType) {
        recordedExerciceType.addEventListener("change", function() {
            exerciceNameType.value = this.options[this.selectedIndex].text
        }, false)
    }
})