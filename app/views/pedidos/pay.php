<?php
  require_once 'app/views/components/header.php';
  require_once 'app/config.php';

  include "./app/views/components/hero.php";
  echo createHero('Detalles de la orden', 'menu.jpg');
?>

<br><br>
<br>
<section class="counter-section section center-text" id="counter">
  

  <!-- Payment button -->
  <button class="stripe-button" id="payButton">
      <div class="spinner hidden" id="spinner"></div>
      <span id="buttonText">Pay Now</span>
  </button>

  <!-- <form action="index.php?page=storepedido" method="POST" class="credit-card-div">
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">

          <div class="row ">
            <div class="col-md-12">
              <input type="text" required  minlength="16" class="form-control" placeholder="Ingrese su numero de tarjeta" maxlength="16" />
            </div>
          </div>
          <div class="row ">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font"> Mes de expiración</span>
              <input type="text" required maxlength="2"  class="form-control" placeholder="MM"  minlength="2"/>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block  text-muted small-font"> Año de expiración</span>
              <input type="text" required maxlength="2" class="form-control" placeholder="YY" minlength="2" />
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <span class="help-block text-muted small-font"> CCV</span>
              <input type="text" minlength="3" maxlength="3" required class="form-control" placeholder="CCV" />
            </div>
          </div>
          <div class="row ">
            <div class="col-md-12 pad-adjust">
              <input type="hidden" name="id_cliente" value="<?php echo $datos['id_cliente'] ?>" name="id_cliente">
              <input type="hidden" name="total" value="<?php echo $datos['total'] ?>" name="total">
              <input type="hidden" value="<?php echo $datos['cantidad'] ?>" name="cantidad">
              <input type="hidden" name="descripcion" value="<?php echo $datos['descripcion'] ?>" name="descripcion">
              <input type="text" required class="form-control" placeholder="Nombre de quien pertenece la tajeta" />
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 pad-adjust">
              <div class="checkbox">
                <label>
                  <input type="checkbox" required checked class="text-muted"> Estoy de acuerdo con los terminos y condiciones</a>
                </label>
              </div>
            </div>
          </div>
          <div class="row ">
            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
              <input type="submit" class="btn btn-danger" name="cancelar" value="cancelar" />
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
              <input type="submit" class="btn btn-primary d-block w-100" name="registrar" target="_blank" value="Registrar" />
            </div>
          </div>

        </div>
      </div>
  </form> -->
  </div>
</section>

<?php
  require_once 'app/views/components/footer.php';
?>

<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<script>
  // Set Stripe publishable key to initialize Stripe.js
  const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

  // Select payment button
  const payBtn = document.querySelector("#payButton");

  // Payment request handler
  payBtn.addEventListener("click", function (evt) {
      setLoading(true);

      createCheckoutSession().then(function (data) {
          if(data.sessionId){
              stripe.redirectToCheckout({
                  sessionId: data.sessionId,
              }).then(handleResult);
          }else{
              handleResult(data);
          }
      });
  });
      
  // Create a Checkout Session with the selected product
  const createCheckoutSession = function (stripe) {
      return fetch("index.php?page=payment-init", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
          },
          body: JSON.stringify({
              createCheckoutSession: 1,
          }),
      }).then(function (result) {
          return result.json();
      });
  };

  // Handle any errors returned from Checkout
  const handleResult = function (result) {
      if (result.error) {
          showMessage(result.error.message);
      }
      
      setLoading(false);
  };

  // Show a spinner on payment processing
  function setLoading(isLoading) {
      if (isLoading) {
          // Disable the button and show a spinner
          payBtn.disabled = true;
          document.querySelector("#spinner").classList.remove("hidden");
          document.querySelector("#buttonText").classList.add("hidden");
      } else {
          // Enable the button and hide spinner
          payBtn.disabled = false;
          document.querySelector("#spinner").classList.add("hidden");
          document.querySelector("#buttonText").classList.remove("hidden");
      }
  }

  // Display message
  function showMessage(messageText) {
      const messageContainer = document.querySelector("#paymentResponse");
    
      messageContainer.classList.remove("hidden");
      messageContainer.textContent = messageText;
    
      setTimeout(function () {
          messageContainer.classList.add("hidden");
          messageText.textContent = "";
      }, 5000);
  }
</script>