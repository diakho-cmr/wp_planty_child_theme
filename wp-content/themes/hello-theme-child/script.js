// Widget order

function inc(flavourNumber) {
    let num = document.querySelector(`[name="${flavourNumber}"]`);
    num.value = parseInt(num.value) + 1;
}
  
function dec(flavourNumber) {
    let num = document.querySelector(`[name="${flavourNumber}"]`);
    if (parseInt(num.value) > 0) {
        num.value = parseInt(num.value) - 1;
    }
}