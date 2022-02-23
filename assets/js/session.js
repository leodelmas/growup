document.addEventListener('DOMContentLoaded', (event) => {
    // Session mood field value
    let allRanges = document.querySelectorAll(".range-wrap")
    allRanges.forEach(wrap => {
        let range = wrap.querySelector("input[type='range']")
        let output = wrap.querySelector("output")
        range.addEventListener("input", () => {
            setOutput(range, output)
        });
        setOutput(range, output)
    });
    function setOutput(range, output) {
        let val = range.value
        let min = range.min ? range.min : 0
        let max = range.max ? range.max : 100
        let newVal = Number(((val - min) * 100) / (max - min))
        output.innerHTML = val
        output.style.left = `calc(${newVal}% + (${8 - newVal * 0.15}px))`
    }
})