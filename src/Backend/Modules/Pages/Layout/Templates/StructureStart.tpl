<body id="{$bodyID}" class="{$bodyClass}">
  {include:{$BACKEND_CORE_PATH}/Layout/Templates/Header.tpl}
  <div id="content" class="container">
    <div class="row">
      <div class="col-md-3">
        {include:{$BACKEND_MODULES_PATH}/Pages/Layout/Templates/Tree.tpl}
        {include:{$BACKEND_CORE_PATH}/Layout/Templates/Switch.tpl}
      </div>
      <div class="col-md-9">
