document.addEventListener('DOMContentLoaded', function()
{
  let baseUrl = document.getElementById('baseUrl').getAttribute('data-url');
  let unitSelect = document.getElementById('unit');
  let clearUnitButton = document.getElementById('clearUnitButton');

  //sends id of selected unit to be emptied
  clearUnitButton.addEventListener('click', function(event) {
    event.preventDefault();

    let selectedValue = unitSelect.value;
    if (selectedValue)
      {
      let url = baseUrl + "enturmar/limpar/" + selectedValue;
      window.location.href = url;
    }
  });
});