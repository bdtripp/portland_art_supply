import $ from 'jquery'; 
import React from 'react';
import ReactDOM from 'react-dom';

$(
  function() {
    ReactDOM.render(
      <h1>Hello, world!</h1>,
      document.getElementById('test')
    );
  }
)