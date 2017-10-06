<?php // common.php
 
function error($msg) {
?>
<html>
<head>
  <script language="JavaScript">
  <!--
  alert("<?php echo $msg?>");
  history.back();
  //-->
  </script>
</head>
<body>
</body>
</html>
<?php
exit;
}
?>