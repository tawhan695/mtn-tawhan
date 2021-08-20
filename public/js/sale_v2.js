
function MoveFunction(x) {
    if (x.matches) { // If media query matches
        var source = document.getElementById("source");
        document.getElementById("destination").appendChild(source);
        $("#sub").remove();
        $('#mb-sub').append(`
        <button id="sub" class=" btn btn-success btn-block btn-lg" disabled type="button" data-toggle="modal"
        data-target="#PaymentModalCenter"
                    >ชำระเงิน</button>
        `);
    } else {
        var source = document.getElementById("source");
        document.getElementById("destination2").appendChild(source);
        $("#sub").remove();
        $('#mb-sub').append(`
        <button id="sub" class=" btn btn-success btn-block btn-lg" disabled data-toggle="modal" type="button"
                    data-target="#PaymentModalCenter"
                    >ชำระเงิน</button>
        `);
    }
}

var x = window.matchMedia("(max-width: 991px)")
MoveFunction(x) // Call listener function at run time
x.addListener(MoveFunction) // Attach listener function on state changes



