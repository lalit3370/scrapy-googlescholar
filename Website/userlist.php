<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="userlist.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Results</title>
    <script>
        var uid = "<?php echo $_GET["uid"]; ?>";
        // console.log(uid);
        url1="https://scholar.google.com/citations?user="+uid;
        var urlfinal = encodeURIComponent(url1);
        // console.log(urlfinal);
        apiurl='http://localhost:3000/crawl.json?start_requests=true&spider_name=page1&url='+urlfinal
        fetch(apiurl)
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                document.getElementById("cardname").innerText=data.items["name"];
                document.getElementById("cardimg").src=data.items["imgsrc"];
                document.getElementById("resultpagelink").href="http://localhost/Website/result.php?uid="+uid;
            });
    </script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
            <p>Google Scholar API</p>
            <a href="main.html">Home</a>
          </nav>
    <div class="container-fluid ">
        <h1 class="display-3">User Found:</h1>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="..." id="cardimg">
            <div class="card-body">
              <h5 class="card-title" id="cardname"></h5>
              <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              <a href="" class="btn btn-primary" id="resultpagelink"></a>
            </div>
          </div>
    </div>

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>          
</body>
</html>