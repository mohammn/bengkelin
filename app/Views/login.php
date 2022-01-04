<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bengkelin | Log in </title>

    <!-- Bootstrap -->
    <link href="<?= base_url() ?>/public/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url() ?>/public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>/public/css/custom.min.css" rel="stylesheet">
</head>

<body class="login" style="background :url(<?= base_url() . "/public/images/login.jpg" ?>); height:100%; background-position:center; background-size: cover; no-repeat;">
    <div>
        <div class="login_wrapper" style="background-color: aliceblue; padding:20px;">
            <form method="post" action="<?= base_url() ?>/login/auth">
                <h1>Login Bengkelin</h1>
                <?php echo session()->getFlashdata('message'); ?>
                <h3></h3>
                <div class="form-group row">
                    <select class="form-control" id="nama" name="nama">
                        <?php for ($i = 0; $i < count($user); $i++) : ?>
                            <option value="<?= $user[$i]["id"] ?>"><?= $user[$i]["id"] . ". " . $user[$i]["nama"] ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group row">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                </div>
                <div class="form-group row">
                    <input type="submit" class="btn btn-secondary" value="Log in" />
                </div>

                <div class="clearfix"></div>

                <div class="separator">

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1><i class="fa fa-car"></i> Bengkelin!</h1>
                        <p>©2022 All Rights Reserved. <br /> <a href="http://mn-belajarweb.blogspot.com">MN-Belajarweb.blogspot.com</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>