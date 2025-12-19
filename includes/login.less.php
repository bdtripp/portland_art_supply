//<?php
//
//
//header('Content-Type: text/css');
//?>

/*
 * Login/New Account Form
 */
html {
    height: 100%;

    body {
        height: 100%;

        div {

            &#error_message_container {
                width: 200px;
                margin: 20px auto;
                border: 1px solid red;
                border-radius: 3px;
                padding: 10px;

                div {
                    &#error_header {
                        color: red;
                    }
                }
            }

            &.login.wrapper {
                height: 100%;
                position: relative;

                table {

                    &.center {
                        display: block;
                        border: 1px solid #DDD;
                        border-radius: 5px;
                        padding: 20px;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);

                        th {

                            &.login_form_header {
                                text-align: center;
                                font-size: 1.5em;
                                padding-bottom: 10px;
                            }
                        }

                        td {
                            padding: 5px;
                            text-align: right;
                            width: 1rem;


                            a {
                                padding-right: 10px;
                            }

                            input {
                                border: 1px solid #AAA;

                                &.login_btn {
                                    display: block;
                                    margin: 0 auto;
                                }
                            }

                            &.message_td {
                                text-align: center;

                                span {
                                    color: red;
                                }
                            }

                            &#links_td {
                                text-align: left;
                            }
                        }

                        label {
                            display: inline-block;
                            width: 4.5em;
                            padding: 2px 0;
                            text-align: right;
                            vertical-align: top;
                        }
                    }
                }
            }
        }
    }
}

