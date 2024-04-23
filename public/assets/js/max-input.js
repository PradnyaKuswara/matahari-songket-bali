function maxInputValue(input, max) {
    input.addEventListener("input", function () {
        if (input.value.length > max) {
            input.value = input.value.slice(0, max);
        }
    });
}
