

document.addEventListener('DOMContentLoaded', function () {
    const form1 = document.getElementById("enc");
    const form2 = document.getElementById("dec");
    const success = document.getElementById("success");
    const error = document.getElementById("error");
    const title = document.getElementById("p");

    form1.addEventListener('submit', function (event) {
        event.preventDefault();

        const plain = document.getElementById("plain").value;
        const key = document.getElementById("key").value;


        fetch("process.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                plain: plain,
                key: key,
                action: "encrypt"
            }),
        })
            .then(response => response.json())
            .then(data => {
                console.log("Your Encrypted is:  " + data.m);
                if(data.s === 1) {
                    success.innerHTML = "<i> Your Encrypted is: <br> </i><b style='font-size: 30px'> " + data.m + "</b>";
                    error.style.display = 'none';
                } else {
                    error.innerHTML = "<i> Error: <br> </i><b style='font-size: 30px'> " + data.m + "</b>";
                    success.style.display = 'none';
                }
            })
            .catch(error => {
                console.log(error);
            });

    });

    form2.addEventListener('submit', function (event) {
        event.preventDefault();

        const cipher = document.getElementById("cipher").value;
        const key = document.getElementById("dkey").value;


        fetch("process.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                cipher: cipher,
                key: key,
                action: "decrypt"
            }),
        })
            .then(response => response.json())
            .then(data => {
                console.log("Your Encrypted is:  " + data.m);
                if(data.s === 1) {
                    success.innerHTML = "<i> Your Encrypted is: <br> </i><b style='font-size: 30px'> " + data.m + "</b>";
                    error.style.display = 'none';
                } else {
                    error.innerHTML = "<i> Error: <br> </i><b style='font-size: 30px'> " + data.m + "</b>";
                    success.style.display = 'none';
                }
            })
            .catch(error => {
                console.log(error);
            });

    });

    const encButton = document.getElementById("encrypt");
    const decButton = document.getElementById("decrypt");

    decButton.addEventListener('click', function (event) {
        event.preventDefault();
        if(form2.style.display == "none") {
            form2.style.display = 'block';
            title.textContent = "Decryption to Plain Text";
            form1.style.display = 'none';
        }

    });

    encButton.addEventListener('click', function (event) {
        event.preventDefault();
        if(form1.style.display == "none") {
            form1.style.display = 'block';
            title.textContent = "Text Encryption";
            form2.style.display = 'none';
        }

    });
});