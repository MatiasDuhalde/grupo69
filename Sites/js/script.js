function execQuery(evt) {
  console.log(evt)
  var script = evt.currentTarget.script_name
  var arguments = evt.currentTarget.script_args
  console.log(script)
  console.log(arguments)
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("result-placeholder").innerHTML = this.responseText;
    }
  };
  var url = "queries/" + script + ".php"
  if (arguments) {
    url += "?"

    for (const arg in arguments) {
      url += arg + "=" + arguments[arg] + "&"
    }
  }
  console.log(url)
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function textInputReceived(obj) {
  value = obj.value
  if (value == "") {
    textOutput.innerHTML = "Mejillones"
    return
  }
  obj_id = obj.attributes["aria-labelledby"].nodeValue
  switch (obj_id){
    case "input-query-2":
      textOutput = document.getElementById("text-query-2")
      textOutput.innerHTML = value
      query_buttons[1].script_args["nombre_puerto"] = value
      break
    case "input-query-4":
      textOutput = document.getElementById("text-query-4")
      textOutput.innerHTML = value
      query_buttons[3].script_args["nombre_barco"] = value
      break
    case "input-query-4b":
      textOutput = document.getElementById("text-query-4b")
      textOutput.innerHTML = value
      query_buttons[3].script_args["nombre_ciudad"] = value
      break
  }
}


// GET TOP APP BAR
const topAppBarElement = document.getElementById('app-bar');
const topAppBar = mdc.topAppBar.MDCTopAppBar.attachTo(topAppBarElement);


// BUTTONS
var query_buttons = document.querySelectorAll(".mdc-button")
Array.prototype.map.call(query_buttons, button => mdc.ripple.MDCRipple.attachTo(button))

Array.prototype.map.call(query_buttons, function(button) {
  button.addEventListener("click", execQuery);
})

query_buttons[0].script_name = "query01"

query_buttons[1].script_name = "query02"
query_buttons[1].script_args = {"nombre_puerto" : "Mejillones"}

query_buttons[2].script_name = "query03"

query_buttons[3].script_name = "query04"
query_buttons[3].script_args = {"nombre_barco": "Calypso", "nombre_ciudad": "Arica"}

query_buttons[4].script_name = "query05"

query_buttons[5].script_name = "query06"

// Text fields
const textField1 = mdc.textField.MDCTextField.attachTo(document.getElementById('input-query-2'));
const textField2 = mdc.textField.MDCTextField.attachTo(document.getElementById('input-query-4'));
const textField3 = mdc.textField.MDCTextField.attachTo(document.getElementById('input-query-4b'));


// const list = mdc.list.MDCList.attachTo(document.querySelector('.mdc-list'));
// list.wrapFocus = true;

// DRAWER STUFF
const drawer = mdc.drawer.MDCDrawer.attachTo(document.querySelector('.mdc-drawer'));

// const listEl = document.querySelector('.mdc-drawer .mdc-list');
// const mainContentEl = document.querySelector('.main-content');

// listEl.addEventListener('click', (event) => {
//   mainContentEl.querySelector('input, button').focus();
// });

// document.body.addEventListener('MDCDrawer:closed', () => {
//   mainContentEl.querySelector('input, button').focus();
// });


topAppBar.setScrollTarget(document.getElementById('main-content'));
topAppBar.listen('MDCTopAppBar:nav', () => {
  drawer.open = !drawer.open;
});