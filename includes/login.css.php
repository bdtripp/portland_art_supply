/*
<?php


header('Content-Type: text/css');
?>
*/
/*
 * Login/New Account Form
 */
/* COLOR PALETTE */
html body {
  height: 100vh;
  display: grid;
  justify-content: center;
  align-items: center;
}
html body div#error_message_container {
  width: 200px;
  margin: 20px auto;
  border: 1px solid red;
  border-radius: 3px;
  padding: 10px;
}
html body div#error_message_container div#error_header {
  color: red;
}
html body form {
  display: grid;
  gap: 20px;
  justify-items: center;
}
html body form h2 {
  font-size: 2rem;
  text-align: center;
}
html body form div.form_row {
  display: flex;
  flex-direction: column;
}
html body form div.form_row input {
  padding: 10px 16px;
  font-size: 1.1em;
  border: 3px solid #333333;
  color: #333333;
  background-color: white;
  letter-spacing: 1px;
  border-radius: 10px;
  flex: 1 1 0;
  min-width: 0;
}
html body form div.form_row input[type="submit"] {
  padding: 14px 80px;
  font-size: 1.3em;
  color: white;
  border: 3px solid #0AA764;
  border-radius: 40px;
  background-color: #0AA764;
  font-weight: 900;
  letter-spacing: 1px;
  margin: 20px 0 0 0;
}
html body form span {
  color: red;
}
html body form label {
  display: inline-block;
  width: 4.5em;
  padding: 2px 0;
  text-align: right;
  vertical-align: top;
}
