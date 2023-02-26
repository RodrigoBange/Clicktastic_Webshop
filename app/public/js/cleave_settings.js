
var creditCleave = new Cleave('#cc-number', {
    creditCard: true,
    onCreditCardTypeChanged: function(type) {
    }
});

var expCleave = new Cleave('#cc-expiration', {
    date: true,
    datePattern: ['m', 'y']
});

var cvvCleave = new Cleave('#cc-cvv', {
    blocks: [3],
    uppercase: true
});