    function increment() {
        document.getElementById("quantity").stepUp();
        var data = document.getElementById('quantity').value;
        if (data >= 10) {
            alert("You can add maximum 10 item");
        }
    }

    function decrement() {
        document.getElementById("quantity").stepDown();
    }
