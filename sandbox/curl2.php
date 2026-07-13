<?php
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://dev.dreamjo.bs/api/items");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch); 
//$list = $jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
print_r('<pre>');
var_dump(json_decode($output));
//print_r($output);
?>
<!DOCTYPE html>
<html>
<body>

<h1>My First Web Page</h1>
<p>My First Paragraph</p>

<p id="demo"></p>
<script>
/*
  fetch(url)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      let authors = data;
    })
*/
/*
(async () => {
  try {
    const res = await fetch('https://dev.dreamjo.bs/api/items')
    const out = await res.json()
    console.log(out);
  } catch (err) {
    throw err
  }
})()
*/

/*
fetch("https://dev.dreamjo.bs/api/items")
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      let name = data;
    })
*/
/*
const url = new URL(
    "https://dev.dreamjo.bs/api/items"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

const obj = fetch(url, {
    method: "GET",
    headers,
})
.then(response => response.json());
*/

/*
let url = 'https://dev.dreamjo.bs/api/items';

fetch(url)
.then(res => res.json())
.then((out) => {
  console.log('Checkout this JSON! ', out);
})
.catch(err => { throw err });
*/

        fetch('https://dev.dreamjo.bs/api/items')
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                appendData(data);
            })
            .catch(function (err) {
                console.log('error: ' + err);
            });
        function appendData(data) {
            var mainContainer = document.getElementById("myData");
            for (var i = 0; i < data.length; i++) {
                var div = document.createElement("div");
                div.innerHTML = 'Name: ' + data[i].firstName + ' ' + data[i].lastName;
                mainContainer.appendChild(div);
            }
        }

/*
alert(
fetch('https://dev.dreamjo.bs/api/items')
  .then((response) => {
    return response.json();
  })
  .then((myJson) => {
    console.log(myJson);
  })
);

alert(
fetch('https://dev.dreamjo.bs/api/items', {
    method: 'get'
}).then(function(response) {

}).catch(function(err) {
    // Error :(
})
);
*/
//document.getElementById("demo").innerHTML = name;
</script>
</body>
</html>
<?php
?>