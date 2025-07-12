<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>profile</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->


    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css ">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css ">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css ">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css ">

    <link rel="stylesheet" href="assets/fontawesome-free-6.0.0-web/css/all.min.css">
    <script src="assets/fontawesome-free-6.0.0-web/js/all.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<div class="row">
    <div class="col-md-6">
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <span class="glyphicon glyphicon-camera"></span>
                <span>All Photos</span>
                <div class="pull-right">
                    <form class="form-inline" action="media.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn">
                <input type="file" name="file_upload" multiple="multiple" class="btn btn-primary btn-file"/>
             </span>

                                <button type="submit" name="submit" class="btn btn-default">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Photo Name</th>
                            <th class="text-center" style="width: 20%;">Photo Type</th>
                            <th class="text-center" style="width: 50px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="list-inline">
                            <td class="text-center">
                            </td>
                            <td class="text-center">
                                <img src="" class="img-thumbnail" />
                            </td>
                            <td class="text-center">
                            </td>
                            <td class="text-center">
                            </td>
                            <td class="text-center">
                                <a href="delete_media.php?id=" class="btn btn-danger btn-xs" title="Edit">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
            </div>
        </div>
    </div>
</div>