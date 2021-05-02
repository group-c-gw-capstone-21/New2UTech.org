<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>New2UTech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="New2UTech-Format.v1.css" />
  </head>
  <body>
    <header>
      <div class="topHeaderRow">
      </div>
        <!-- end topHeaderRow -->
      <nav class="navbar-default ">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="New2UTech-Homepage.php"><br><span> &#160; New2UTech</a>
          </div>
          <br>
          <div id="menu-outer">
            <div class="table">
              <ul id="horizontal-list">
                <li><a class="nav-links" href="New2UTech-Homepage.php">Home</a></li>
                <li<span>&#160;<span> &#160;<span> &#160;<span> &#160;<a class="nav-links" href="New2UTech-AboutUs.php">About Us</a></li>
                <li<span>&#160;<span> &#160;<span> &#160;<span> &#160;<a class="nav-links" href="New2UTech-Donate.php">Donate</a></li>
                <li<span>&#160;<span> &#160;<span> &#160;<span> &#160;<a class="nav-links" href="New2UTech-login.php">Log In</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- Page Content -->
    <main>
      <br>
      <h2 style="text-align:center">Donate</h2>
      <br>
      <div class="about-us">
        <h3>Please consider making a donation today. <br>
          Donations made to New2UTech go directly to cost associated with maintaining the site<br>
          When you click on the donate button below, you will be redirected to New2UTech's third party electronic payments services provider (PayPal). <br>
          Your support is greatly appreciated.
        <h2 style="text-align:center"> To contact us, please send an email to: <a href="mailto:info@New2U.Tech">info@New2U.Tech</a></h2>

        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr"
            method="post" target="_top">
            <input type='hidden' name='business'value='New2UTech-facilitator@yahoo.com'>
            <input type='hidden' name='item_name' value='New2UTech Donation'>
            <center>
              <label for="amount">Enter Dollar Amount</label><input type='number' name='amount'></input>
            </center>
            <input type='hidden' name='no_shipping' value='1'>
            <input type='hidden' name='currency_code' value='USD'>
            <input type='hidden' name='notify_url' value='https://www.new2u.tech/Final-Code/New2UTech-PayPalNotify.php'>
            <input type='hidden' name='cancel_return' value='https://www.new2u.tech/Final-Code/New2UTech-PayPalCancel.php'>
            <input type='hidden' name='return' value='https://www.new2u.tech/Final-Code/New2UTech-PayPalReturn.php'>
            <input type="hidden" name="cmd" value="_xclick"><br>
            <input type="submit" name="pay_now" class="donate-btn" style="color:#ffffff" id="pay_now" Value="Donate">
        </form>
      </div>
  </main>
  <div class="separator"></div>
  <footer>
    <div class="homepage-footer">
      <a href="New2UTech-Homepage.php">New2UTech</a>
    </div>
  </footer>
  </body>
</html>
