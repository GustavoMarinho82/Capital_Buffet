function showPopup(text) {
    var popupOverlay = document.getElementById('popupOverlay');
    var popupText = document.getElementById('popupText');
    popupText.innerText = text;
    popupOverlay.style.display = 'flex';
  }