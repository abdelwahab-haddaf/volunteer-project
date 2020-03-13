<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container">

<div class="form-group">
    <form action="" method="post" id="setAdmin">
        <button type="submit" class="btn btn-primary" id="setAdminButton"> Set Admin </button>
    </form>
</div>

    <div class="form-group">
    <form action="" method="post" id="removeAdmin">
        <button type="submit" class="btn btn-primary" id="removeAdminButton"> Remove Admin</button>
    </form>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).on('submit','#setAdmin',function (e) {
        e.preventDefault();
        var that = $(this);

                    $(this).children('button').attr("class","btn btn-outline-danger btn-sm mt-4 removeAdminButton");
                    $(this).children('button').attr("id","removeAdminButton");
                    $(this).children('button').html('إزلةمسؤول');
                    $(this).attr("id","removeAdmin");

    });


    $(document).on('submit','#removeAdmin',function (e) {
        e.preventDefault();
        var that = $(this);

         $(this).children('button').attr("class","btn btn-outline-primary btn-sm mt-4 setAdminButton");
         $(this).children('button').attr("id","setAdminButton");
         $(this).children('button').html('تعيين مسؤول');
         $(this).attr("id","setAdmin");

    });


</script>
</body>
</html>











