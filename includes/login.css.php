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
  font-family: 'Open Sans', sans-serif;
  background-color: white;
  color: #333333;
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
  max-width: 370px;
  border: 3px solid #F34F0E;
  padding: 30px;
  margin: 0 10px;
  background-color: #fcfcfc;
  border-radius: 10px;
  box-shadow: 5px 5px 20px #AAA;
}
html body form h2 {
  font-size: 3rem;
  color: #B83906;
  font-weight: bold;
  text-align: center;
  line-height: 1.2em;
}
html body form div.form_row {
  display: flex;
  flex-direction: column;
  gap: 5px;
}
html body form div.form_row label {
  color: #333333;
  font-size: 1.1em;
  letter-spacing: 1px;
}
html body form div.form_row input {
  padding: 10px 16px;
  font-size: 1.1em;
  border: 3px solid #333333;
  color: #333333;
  background-color: #fcfcfc;
  letter-spacing: 1px;
  border-radius: 10px;
  width: 175px;
}
html body form input.login_btn {
  padding: 14px 80px;
  font-size: 1.3em;
  color: white;
  border: 3px solid #0AA764;
  border-radius: 40px;
  background-color: #F34F0E;
  font-weight: 900;
  letter-spacing: 1px;
  margin: 20px 0 0 0;
  line-height: 1.3rem;
  transition: transform 0.3s;
  line-height: 1;
  border: none;
}
html body form input.login_btn:hover {
  cursor: pointer;
  transform: scale(1.1);
}
html body form input#create_account_btn {
  padding: 14px 80px;
  font-size: 1.3em;
  color: white;
  border: 3px solid #0AA764;
  border-radius: 40px;
  background-color: #F34F0E;
  font-weight: 900;
  letter-spacing: 1px;
  margin: 20px 0 0 0;
  line-height: 1.3rem;
  padding: 16px 30px;
  width: 228px;
  border: none;
}
html body form div.links {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}
html body form div.links a {
  text-decoration: none;
  text-align: center;
  transition: transform 0.3s;
  padding: 10px 16px;
  font-size: 1.1em;
  border: 3px solid #333333;
  color: #333333;
  background-color: #fcfcfc;
  letter-spacing: 1px;
  border-radius: 10px;
}
html body form div.links a:hover {
  cursor: pointer;
  transform: scale(1.1);
}
html body form div.links a:visited {
  color: #333333;
  background-color: #fcfcfc;
}
html body form span {
  color: red;
}
