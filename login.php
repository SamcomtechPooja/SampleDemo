<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
          rel="stylesheet" type="text/css">

</head>

<body>
<div class="container">
    <div class="row" style=" margin-top: 10%">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <div class="form-horizontal" role="form" >
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">User name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group" style="text-align: center">
                            <div class="col-md-6 col-md-offset-4" style=" text-align: center;">
                                <button type="submit" class="btn btn-primary" id="login">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
    $(document).keypress(function(event) {
        var keycode = event.keyCode || event.which;
        // When the DOM is ready, attach the event handler.
        console.log("ready!");
        if(keycode == '13')
        {
            var email = "doctor";//$("#email").val();
            var password = "doctorlogin123";//$("#password").val();

            console.log("email:-- "+email);
            console.log("password:-- "+password);
            if(email == ""){
                alert("Please enter email");
            }
            else if(password == ""){
                alert("Please enter password");
            }
            else {
                location.href = 'Videochat.php';
                /*$.ajax({
                    type: 'POST',
                    data: {email:email,password:password,value:"login"},
                    url: 'registerpage.php',
                    success: function (data)
                    {
                        console.log("data --- "+data);
                        if(data == 'admin'){
                            location.href = 'adminView.php?id=1';
                        }
                        else if (data==1){
                            alert("Please enter correct emailid and password");
                        }
                        else{
                            location.href = 'Videochat.php';
                        }
                    }
                });*/
            }
        }
    }); 

    $("#login").click(function()
    {
        var email = "doctor";//$("#email").val();
        var password = "doctorlogin123";//$("#password").val();

        console.log("email:-- "+email);
        console.log("password:-- "+password);
        if(email == ""){
            alert("Please enter email");
        }
        else if(password == ""){
            alert("Please enter password");
        }
        else {
            location.href = 'Videochat.php';
            /*$.ajax({
             type: 'POST',
             data: {email:email,password:password,value:"login"},
             url: 'registerpage.php',
             success: function (data)
             {
             console.log("data --- "+data);
             if(data == 'admin'){
             location.href = 'adminView.php?id=1';
             }
             else if (data==1){
             alert("Please enter correct emailid and password");
             }
             else{
             location.href = 'Videochat.php';
             }
             }
             });*/
        }
    });
</script>

</body>

</html>
