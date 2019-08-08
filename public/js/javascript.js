var selectedButton = document.getElementsByName('customRadio');

          document.getElementsByName('customRadio').addEventListener("click", (event) => {
            var myValue = "lol";
            console.log(myValue);
            document.getElementById("test").textContent = myValue;
          });

