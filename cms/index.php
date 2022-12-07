<?php
if (!defined('JO_ROOT')) define("JO_ROOT", realpath(__DIR__."/.."));
$message = "";
$mail = "";
require_once(JO_ROOT.'/cms/control/login.php');
?>

<html>
<head>
<meta charset="utf-8">
<title><?php echo $JO_LANG['LGN']; ?> | DarkcraftCMS</title>
<meta description="Login | DarkcraftCMS" />
    <style>
        body{
            background-color: #111010db;
            background-size:cover;
            background:url('https://source.unsplash.com/1600x900/?galaxies');
        }
        #left{
            background-color: #111010d9;
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            min-width: 290px;
            width: 18%;
            padding: 35px;
            text-align: right;
            display: flex;
            align-items: center;
            box-shadow: #505050 0px -0px 40px;
            font-family: arial;
        }
        .jo_form input[type="submit"] {background-color: #494949!important;
    border-radius: 5px !important;
}
        #left div{
            width: 100%;
        }
        #left input {border-radius:5px;}
        #logo{
            font-size: 60px;
            font-weight: bold;
            font-family: arial;
            color: #494949;

        }
        #logo span{
            color: #494949;
        }
        #logo img{
            width: 200px;
        }
        @media only screen and (max-width: 450px){
            #left{
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>

    <link href="/cms/core/style/css/stylesheet.css" rel="stylesheet" type="text/css"/>
    <link href="/cms/control/css/backend_style.css" rel="stylesheet" type="text/css"/>
    <link rel="apple-touch-icon" sizes="57x57" href="/cms/core/style/icons/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/cms/core/style/icons/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/cms/core/style/icons/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/cms/core/style/icons/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/cms/core/style/icons/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/cms/core/style/icons/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/cms/core/style/icons/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/cms/core/style/icons/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/cms/core/style/icons/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/core/style/cms/icons/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/cms/core/style/icons/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/cms/core/style/icons/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/cms/core/style/icons/favicon/favicon-16x16.png">
    <link rel="manifest" href="/cms/core/style/icons/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#494949">
    <meta name="msapplication-TileImage" content="/cms/core/style/icons/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#494949">
    <meta name="viewport" content="width=device-width" />
    </head>
    <body>
    <div id="left">
        <div>
            <div id="logo">
                <a href="https://cms.darkcraft.digital/" target="_blank" title="<?php echo $JO_LANG['JO_ADV']; ?>" style="display:flex;justify-content:center;"><img id="userBrand" src="/cms/core/style/icons/moon-loader.gif" style="width: 75%;height:auto;"/></a>
            </div>
            <?php echo $message;?>
            <form action="" method="post" class="jo_form">
              <fieldset style="text-align: left;
    color: white;
    text-transform: uppercase;
    font-size: x-small;">
                 📧 Email-Address<input value="<?php echo htmlentities($mail);?>" id="mail" type="text" name="name" placeholder="<?php echo $JO_LANG['LGN_MAIL']; ?>"/>
                 🔐 Password<input type="password" name="password" placeholder="<?php echo $JO_LANG['LGN_PW']; ?>"/>
                <input type="hidden" name="times" value="1"/>
              </fieldset>
                <input class="jo_btn" type="submit" value="<?php echo $JO_LANG['LGN']; ?>"/>
            </form>
            <small style="position: absolute;
    bottom: 10px;
    right: 10%;
    color: white;
    font-size: x-small;
    text-transform: uppercase;">DarkcraftCMS v1.1b</small>
        </div>

    </div>
    <script>
      document.getElementById('mail').focus();
    </script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {   
   
let jsondata;
  fetch("https://sheetsu.com/apis/v1.0bu/508413894c36")
    .then(function (u) {
      return u.json();
    })
    .then(function (json) {
      jsondata = data;
      const forms = json;
    var data = forms;
  
    
 data.forEach(function(obj) {
    if (window.location.href.indexOf("darkcraft") > -1) {
    document.getElementById("userBrand").src= obj.cover;
    }
    else
    window.location = "./core/auth"
  });

 });

  });

</script>

    </body>
    </html>
