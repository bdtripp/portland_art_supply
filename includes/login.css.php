/*
<?php


header('Content-Type: text/css');
?>
*/
/*
 * Login/New Account Form
 */
/* COLOR PALETTE */
html {
  height: 100%;
}
html body {
  height: 100%;
  background-color: #F2F2F2;
  color: #333333;
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
html body div.login.wrapper {
  height: 100%;
  position: relative;
}
html body div.login.wrapper table.center {
  display: block;
  border: 1px solid #DDD;
  border-radius: 5px;
  padding: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
html body div.login.wrapper table.center th.login_form_header {
  text-align: center;
  font-size: 1.5em;
  padding-bottom: 10px;
}
html body div.login.wrapper table.center td {
  padding: 5px;
  text-align: right;
  width: 1rem;
}
html body div.login.wrapper table.center td a {
  padding-right: 10px;
  color: #333333;
}
html body div.login.wrapper table.center td a:visited {
  color: #333333;
}
html body div.login.wrapper table.center td input {
  border: 1px solid #AAA;
}
html body div.login.wrapper table.center td input.login_btn {
  display: block;
  margin: 0 auto;
}
html body div.login.wrapper table.center td.message_td {
  text-align: center;
}
html body div.login.wrapper table.center td.message_td span {
  color: red;
}
html body div.login.wrapper table.center td#links_td {
  text-align: left;
}
html body div.login.wrapper table.center label {
  display: inline-block;
  width: 4.5em;
  padding: 2px 0;
  text-align: right;
  vertical-align: top;
}
