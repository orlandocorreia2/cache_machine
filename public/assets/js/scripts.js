let availableMoneyBulls = [];

document.getElementById('btnAdd').addEventListener('click', function(event) {
    event.preventDefault();
    addAvailableMoneyBulls();
})

function addAvailableMoneyBulls() {
    const availableMoney = document.getElementById('addAvailableMoneyBulls').value;

    if (availableMoney && !availableMoneyBulls.includes(availableMoney)) {
        availableMoneyBulls.push(availableMoney);
        document.getElementById('notes').value = availableMoneyBulls;
        document.getElementById('availableMoney').innerHTML = availableMoneyBulls.join(',');
    }
}
