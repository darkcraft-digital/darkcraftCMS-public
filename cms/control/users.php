<?php
if (!defined('JO_ROOT')) define("JO_ROOT", realpath(__DIR__."/../../"));
//packages
require_once(JO_ROOT."/cms/core/inc/settings.php");
require_once(JO_ROOT."/cms/core/inc/security.php");

jo_session();
if(jo_login_verify() != true){
    header('Location: /cms');
    exit;
}
$error = $JO_LANG['SET_OK'];
try{
  if($_SESSION['cms_user'] != 'admin'){
    header('Location: /cms');
    exit;
  }
  if(isset($_POST['type'])){
    switch ($_POST['type']) {
      case 'users':
        if(isset($_POST['save'])){
          foreach ($_POST as $key => $item) {
            if(gettype($key) == "integer"){
              $type = isset($item['type']) ? $item['type'] : NULL;
              jo_update_users($key, $type);
            }elseif($key == "new"){
              if($item['mail'] != "" AND $item['type'] != ""){
                if(sizeof(jo_get_users($item['mail'], "mail")) >0){
                  throw new Exception($JO_LANG['SET_ERR_MAIM']);
                }
                if(jo_set_user($item['mail'], $item['type'], $JO_S['std_pw']) == false){
                  throw new Exception($JO_LANG['ERR_INP']."1");

                }
              }
            }
          }
        }elseif(isset($_POST['delete'])){
          foreach ($_POST['delete'] as $key => $value) {
            if($key == $_SESSION['cms_id']){
              throw new Exception($JO_LANG['ERR_INP']);
            }
            jo_delete_user($key);
          }
        }else{
          throw new Exception($JO_LANG['ERR_INP']);
        }
        break;
      case 'change_stdpw':
        if(!isset($_POST['std_pw'])){
          throw new Exception($JO_LANG['SET_ERR']);
        }
        $set['std_pw'] = $_POST['std_pw'];
        if(!jo_set_settings($_POST)){
          throw new Exception($JO_LANG['SET_ERR']);
        }
        break;
      default:
        break;
    }
  }else{
    $error = "";
  }
}
catch(Exception $e){
  $error = $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $JO_LANG['SET']; ?> | Darkcraft Digital CMS v.1.1b | Registered to: Bales Technology LLC.</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/cms/core/js/ui.js"></script>
    <script>
      $(document).ready(function(){
        jo_folder_toggle($('.jo_folder'));
      });
    </script>
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
    <link rel="icon" type="image/png" sizes="192x192"  href="/cms/core/style/icons/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/cms/core/style/icons/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/cms/core/style/icons/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/cms/core/style/icons/favicon/favicon-16x16.png">
    <link rel="manifest" href="/cms/core/style/icons/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#494949">
    <meta name="msapplication-TileImage" content="/cms/core/style/icons/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#494949">

</head>
<body >
    <div id="navigation">
    <div id="nav_container">
      <div id="sidebar">
          <a id="attribution" href="https://darkcraft.digital/" title="Darkcraft Digital CMS Beta" style="
    display: block;
    position: fixed;
    top: 10px;
    /* margin-left: 40px; */
    height: 40px !important;
    max-height: 40px;
    left: -20px;
    width: 40px;
    max-width: 40px;
"><img src="/cms/core/style/icons/dclogo.png" style="
    height: 40px;
"></a>
          <div>
              <a href="/cms/control/cms.php" title="<?php echo $JO_LANG['CMS']; ?>"><img src="/cms/core/style/icons/home.svg"/></a>
              <?php echo $_SESSION['cms_user'] == 'admin' ? '<a href="/cms/apps/mask/mask.php" title="'.$JO_LANG['MSK_TITL'].'"><img src="/cms/core/style/icons/mask.svg"/></a>' : '' ?>
              <?php echo $_SESSION['cms_user'] == 'admin' ? '<a href="/cms/control/users.php" id="active" title="'.$JO_LANG['USR'].'"><img src="/cms/core/style/icons/users.svg" /></a>' : ''  ?>
              <a href="/cms/control/settings.php" title="<?php echo $JO_LANG['SET']; ?>"><img src="/cms/core/style/icons/settings.svg"/></a>
              <a href="/cms/control/logout.php" title="<?php echo $JO_LANG['BYE_TITL']; ?>"><img src="/cms/core/style/icons/logout.svg"/></a>
          </div>
      </div>
    </div>
    </div>
	<div id="menu">
	    <style>.jo_form tr:nth-of-type(2){display:none !important;}</style>
	<div>
    <h1 style="color: #494949;
    text-transform: uppercase;
    text-decoration: overline;
    font-family: fantasy;
    font-size: 24px;
    font-weight: 100;"><?php echo $JO_LANG['USR']; ?></h1>
    <?php
    if($error != ""){
      echo '
      <div class="settings" style="background-color: #fc462a; color: white;">
        <span>'.$error.'</span>
      </div>
      ';
    }
     ?>

      <div class="settings">
          <a class="jo_folder jo_folder_active"><?php echo $JO_LANG['USR']; ?></a>
          <div>
            <form class="jo_form" method="post" action="">
              <fieldset>
                <table>
                  <tbody>
                      <tr>
                        <td>
                          <input name="new[mail]" type="email" placeholder="<?php echo $JO_LANG['SET_MAIL_NEW'] ?>" />
                        </td>
                        <td>
                          <select name="new[type]">
                            <option value="standard">
                              <?php echo $JO_LANG['USR_STD'] ?>
                            </option>
                            <option value="admin">
                              <?php echo $JO_LANG['USR_ADM'] ?>
                            </option>
                          </select>
                        </td>
                        <td>
                        </td>
                      </tr>
                      <?php
                        $users = jo_get_users('all', 'type');
                        foreach ($users as $item){
                          $standard = "";
                          $admin = "";
                          $self = false;
                          if($item['id'] == $_SESSION['cms_id']){
                            $self = true;
                          }
                          if($item['type'] == "admin"){
                            $admin = ' selected="selected"';
                          }else{
                            $standard = ' selected="selected"';
                          }
                          echo '  <tr>
                              <td>
                                '.$item['mail'].'
                              </td>
                              <td>
                                <select '.($self ? 'disabled="true"' : '').' name="'.$item['id'].'[type]">
                                  <option  value="standard"'.$standard.'>
                                    '.$JO_LANG['USR_STD'].'
                                  </option>
                                  <option value="admin"'.$admin.'>
                                    '.$JO_LANG['USR_ADM'].'
                                  </option>
                                </select>
                              </td>
                              <td>';
                              if(!$self){
                                echo '<input type="submit" class="jo_btn_gray" value="'.$JO_LANG['FORM_DEL'].'" name="delete['.$item['id'].']"/>';
                              }
                          echo '
                              </td>
                            </tr>';
                        }
                      ?>
                  </tbody>
                </table>
              </fieldset>
              <input type="hidden" name="type" value="users" />
              <input type="submit" value="<?php echo $JO_LANG['FORM_OK'] ?>" name="save"/>
            </form>
          </div>
      </div>
      <div class="settings">
          <a class="jo_folder"><?php echo $JO_LANG['SET']; ?></a>
          <div>
            <form class="jo_form" method="post" action="">
              <fieldset>
                <table>
                  <tbody>
                      <tr>
                        <td>
                          <?php echo $JO_LANG['USR_PW']; ?>
                        </td>
                        <td>
                          <input type="text" value="<?php echo $JO_S['std_pw'] ?>" name="std_pw" />
                        </td>
                        <td>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </fieldset>
              <input type="hidden" name="type" value="change_stdpw" />
              <input type="submit" value="<?php echo $JO_LANG['FORM_OK'] ?>" name="save"/>
            </form>
          </div>
      </div>

	</div>
	</div>

</body>
</html>
