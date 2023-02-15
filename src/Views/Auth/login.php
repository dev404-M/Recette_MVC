<?php
ob_start();
if(isset($_SESSION['user']['id'])){
  header('Location: /');
}
?>
<body>

<section class="formLogin">
  <h1>S'identifier</h1>
  <div class="separateur"></div>
  <form action="/login/" method="post">

    <div class="blockInput">
      <div class="labelInput">
        <label for="code_client"><i class="fas fa-user-tie"></i></label>
        <input type="text" name="code_client" value="<?php echo old("code_client");?>" placeholder="code_client">
      </div>
      <span class="error"><?php echo error("code_client");?></span>
    </div>

    <div class="blockInput">
      <div class="labelInput">
        <label for="password"><i class="fas fa-key"></i></label>
        <input id="inputPassword" class="inputPassword" type="password" name="password" value="<?php echo old("password");?>" placeholder="password">
        <button id="btnPassword" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
      </div>
      <span class="error"><?php echo error("password");?></span>
    </div>

    <button type="submit" name="button">S'identifier</button>
  </form>

  <div class="more">
    <p>Vous n'avez pas de compte ? <a href="/register">Inscrivez-vous !</a></p>
  </div>
</section>
</body>
<script>
var btnPass = document.getElementById("btnPassword");
var inputPass = document.getElementById("inputPassword");
btnPass.onclick = function() {
    if (inputPass.type === "password") {
        inputPass.type = "text";
    } else {
        inputPass.type = "password";
    }
};
</script>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';